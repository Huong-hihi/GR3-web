import pandas as pd 
import numpy as np
from numpy import sqrt 
import array
from pymysql import NULL
import math
import sys
#Reading user file:
u_cols =  ['user_id', 'age', 'sex', 'occupation', 'zip_code']
users = pd.read_csv('C:/Users/HuongDT2/WorkSpace/mp3/ml-100k/u.user', sep='|', names=u_cols, encoding='latin-1')
# đọc file csv và trả về 1 dataframe. Mặc định hàm này sẽ phân biệt các trường của file csv theo dấu phẩy. 
# sep: thay đổi dấu ngăn cách giữa các cột thành |
# encoding: chỉ định encoding của file đọc vào. Mặc định là utf-8. - > chuyển thành latin-1
#name : danh sacshteen cột để sử dụng
n_users = users.shape[0]
#print ('Number of users:', n_users)
# users.head() #uncomment this to see some few examples

#Reading ratings file:
r_cols = ['user_id', 'movie_id', 'rating', 'unix_timestamp']

ratings_base = pd.read_csv('C:/Users/HuongDT2/WorkSpace/mp3/ml-100k/ua.base', sep='\t', names=r_cols)
ratings_test = pd.read_csv('C:/Users/HuongDT2/WorkSpace/mp3/ml-100k/ua.test', sep='\t', names=r_cols)

rate_train = ratings_base.to_numpy() # chuyển dữ liệu thành mảng 
rate_test = ratings_test.to_numpy()

#print ('Number of traing rates:', rate_train.shape[0]) #in ra số lượng phần tử của mảng 
#print ('Number of test rates:', rate_test.shape[0])

i_cols = ['song id', 'song name' ,'singer','url', 'musician', 'Viet Nam', 'nhac tre', 'tru tinh', 'Remix', 'rap', 'tien chien','nhac trinh', 'rock việt', 'Cách Mạng', 'ÂU MỸ', 'Pop', 'Rock', 'Châu Á', 'Nhạc hàn', ' Nhạc Hoa', 'Nhạc Nhật','Nhạc Thái','Khác','Thiếu nhi', 'Không lời'] 

items = pd.read_csv('C:/Users/HuongDT2/WorkSpace/mp3/ml-100k/song.data', sep='|', names=i_cols)
n_items = items.shape[0]

X0 = items.to_numpy()


X_train_counts = X0[:, -20:]
# Vì ta đang dựa trên thể loại của phim để xây dựng profile, ta sẽ chỉ quan tâm tới 19 giá trị nhị phân ở cuối mỗi hàng:
#print ('Number of items:', n_items)

#tfidf
from sklearn.feature_extraction.text import TfidfTransformer
transformer = TfidfTransformer(smooth_idf=True, norm ='l2')
tfidf = transformer.fit_transform(X_train_counts.tolist()).toarray()

def get_items_rated_by_user(rate_matrix, user_id):
    """
    in each line of rate_matrix, we have infor: user_id, item_id, rating (scores), time_stamp
    we care about the first three values
    return (item_ids, scores) rated by user user_id
    """
    y = rate_matrix[:,0] # all users
    # item indices rated by user_id
    # we need to +1 to user_id since in the rate_matrix, id starts from 1 
    # while index in python starts from 0
    ids = np.where(y == user_id +1)[0] 
    item_ids = rate_matrix[ids, 1] - 1 # index starts from 0 
    scores = rate_matrix[ids, 2]
    return (item_ids, scores)
from sklearn.linear_model import Ridge
from sklearn import linear_model

d = tfidf.shape[1] # data dimension
W = np.zeros((d, n_users))
b = np.zeros((1, n_users))

for n in range(n_users):    
    ids, scores = get_items_rated_by_user(rate_train, n)
    clf = Ridge(alpha=0.01, fit_intercept  = True)
    Xhat = tfidf[ids, :]
    
    clf.fit(Xhat, scores) 
    W[:, n] = clf.coef_
    b[0, n] = clf.intercept_
# predicted scores
Yhat = tfidf.dot(W) + b

def suggest(n):
    np.set_printoptions(precision=2) # 2 digits after . 
    ids, scores = get_items_rated_by_user(rate_test, n)
    Yhat[n, ids]
    
    return ids
    # print('Rated movies ids :', ids )
    # print('True ratings     :', scores)
    # print('Predicted ratings:', Yhat[ids, n])
#val =  int(input('Enter number: '))
val = int(sys.argv[1])
print(suggest(val), end ="")

# n = 10
# np.set_printoptions(precision=2) # 2 digits after . 
# ids, scores = get_items_rated_by_user(rate_test, n)
# Yhat[n, ids]
# print('Rated movies ids :', ids )
# print('True ratings     :', scores)
# print('Predicted ratings:', Yhat[ids, n])

# def evaluate(Yhat, rates, W, b):
#     se = 0
#     cnt = 0
#     for n in range(n_users):
#         ids, scores_truth = get_items_rated_by_user(rates, n)
#         scores_pred = Yhat[ids, n]
#         e = scores_truth - scores_pred 
#         se += (e*e).sum(axis = 0)
#         cnt += e.size 
#     return sqrt(se/cnt)

# print ('RMSE for training:', evaluate(Yhat, rate_train, W, b))
# print ('RMSE for test    :', evaluate(Yhat, rate_test, W, b))