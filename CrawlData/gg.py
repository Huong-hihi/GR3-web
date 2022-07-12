from bs4 import BeautifulSoup
import urllib.request
import requests
import pymysql
from datetime import datetime
import numpy as np

def get_URL():
    for i in range(2, 3):
        url =  'https://nhac.vn/nghe-si/viet-nam?p='+ str(i)
        page = urllib.request.urlopen(url)
        soup = BeautifulSoup(page, 'html.parser')
        get_url(soup)

# mydb = pymysql.connect(
#   host="localhost",
#   port =3306,
#   user="root",
#   password="",
#   db="gr2",
#   charset='utf8',
#   use_unicode=True
# )
def get_url(soup):
    getUrl = soup.find_all('li', class_='artist-list-large-item');
    for link in getUrl:
        linksong = link.find('a')['href'];
        link = linksong + '/tieu-su'
        Data(link)


def Data(url):
    page = requests.get(url)
    soup = BeautifulSoup(page.content, "html.parser")
    print("=======================================")
    get_prize(soup)
    #print(get_name(soup), get_tenthat(soup), get_nickname(soup), get_sn(soup), get_quequan(soup), get_nation(soup), get_prize(soup), get_information(soup), url)
    
def get_prize(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    if (sn != None) :
        temp = sn.find_all("p")
        # arr = np.array(temp)
        # print(temp)
        # test = '<strong>Thông tin thêm:</strong>''
        for i in temp:
            sss = i.find("strong").text
            print(sss)
            if sss =='Thông tin thêm:':
                buff = 1
            else : 
                buff = 0
            print(buff)
            if buff == 1:
                return sn.text[sn.text.index("Giải thưởng:") + 12:sn.text.index("Thông tin thêm:")]
            else:
                return sn.text[sn.text.index("Giải thưởng:") + 12:len(sn.text)]
    return None
#Lấy thông tin thêm 
def get_information(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    if (sn != None) :
        return sn.text[sn.text.index("Thông tin thêm:") + 15:len(sn.text)]
    return None

if __name__ == '__main__':
    get_URL()