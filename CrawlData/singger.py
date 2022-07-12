from bs4 import BeautifulSoup
import urllib.request
import requests
import pymysql
from datetime import datetime

def get_URL(mydb):
    for i in range(1, 100):
        url =  'https://nhac.vn/nghe-si/viet-nam?p='+ str(i)
        page = urllib.request.urlopen(url)
        soup = BeautifulSoup(page, 'html.parser')
        get_url(soup, mydb)

mydb = pymysql.connect(
  host="localhost",
  port =3306,
  user="root",
  password="",
  db="gr2",
  charset='utf8',
  use_unicode=True
)
def get_url(soup, mydb):
    getUrl = soup.find_all('li', class_='artist-list-large-item');
    for link in getUrl:
        linksong = link.find('a')['href'];
        link = linksong + '/tieu-su'
        Data(link, mydb)


def Data(url, mydb):
    page = requests.get(url)
    soup = BeautifulSoup(page.content, "html.parser")
    print("=======================================")
    #print(get_name(soup), get_tenthat(soup), get_nickname(soup), get_sn(soup), get_quequan(soup), get_nation(soup), get_prize(soup), get_information(soup), url)
    cur = mydb.cursor()
    sql = "INSERT INTO sing (name, full_name, nickname, birthday, nation, prize, information, url, home_town ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
    val = (get_name(soup), get_tenthat(soup), get_nickname(soup), get_sn(soup), get_nation(soup), get_prize(soup), get_information(soup), url, get_quequan(soup))
    print(val)
    try:
        cur.execute(sql, val)
        mydb.commit()
    except:
        pass
        cur.execute(sql, val)
        mydb.commit()
# lấy tên ca si  
def get_name(soup):
    sn = soup.find('div', class_="awall")
    if (sn != None) :
        temp = sn.find("h1")
        return temp.text
    return None
#Lấy tên thật 
def get_tenthat(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    
    if (sn != None) :
        temp = sn.find_all("p")
        for i in temp:
            a = i.find("strong").text
            if a == 'Tên thật:':
                return i.text.split(':')[1]
    return None

#Lấy nickname 
def get_nickname(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    if (sn != None) :
        temp = sn.find_all("p")
        for i in temp:
            a = i.find("strong").text
            if a == 'Nickname:':
                return i.text.split(':')[1]
    return None

#Lấy ngày sinh 
def get_sn(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    if (sn != None) :
        temp = sn.find_all("p")
        for i in temp:
            a = i.find("strong").text
            if a == 'Ngày sinh:':
                date = i.text.split(':')[1]
                return date
    return None

#Lấy quê quán 
def get_quequan(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    if (sn != None) :
        temp = sn.find_all("p")
        for i in temp:
            a = i.find("strong").text
            if a == 'Quê quán:':
                return i.text.split(':')[1]
    return None

#Lấy quốc gia  
def get_nation(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    if (sn != None) :
        temp = sn.find_all("p")
        for i in temp:
            a = i.find("strong").text
            if a == 'Quốc gia:':
                return i.text.split(':')[1]
    return None
#Lấy giải thưởng  
def get_prize(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    if (sn != None) :
        return sn.text[sn.text.index("Giải thưởng:") + 12:sn.text.index("Thông tin thêm:")]
    return None
#Lấy thông tin thêm 
def get_information(soup):
    sn = soup.find('div', class_="pt20 t-jus")
    if (sn != None) :
        return sn.text[sn.text.index("Thông tin thêm:") + 15:len(sn.text)]
    return None

if __name__ == '__main__':
    get_URL(mydb)