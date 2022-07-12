from tkinter.messagebox import NO
from bs4 import BeautifulSoup
import urllib.request
import json
import requests
import pymysql

mydb = pymysql.connect(
  host="localhost",
  port = 3306,
  user="root",
  password="",
  db="gr2"
)

def get_URL(mydb):
    for i in range(1, 25):
        url =  'https://www.nhaccuatui.com/bai-hat/thieu-nhi-moi.'+ str(i)+'.html'
        page = urllib.request.urlopen(url)
        soup = BeautifulSoup(page, 'html.parser')
        get_url(soup, mydb)

# link tác giả
def get_url(soup, mydb):
    getUrl = soup.find_all('div', class_='name_sing_under');
    for link in getUrl:
        linksong = link.find_all('a')
        for links in linksong:
            namesinger = links.text
            if links['href'].find("nghe-si"):
                Data(links['href'], mydb, namesinger)


def Data(url, mydb, name):
    page = requests.get(url)
    soup = BeautifulSoup(page.content, "html.parser")
    print("=======================================", url)
    cur = mydb.cursor()
    val = [name]
    sql = "SELECT * FROM singers where name = %s"
    cur.execute(sql, val)
    record = cur.fetchall()
    if (len(record) == 0):
        sql = "INSERT INTO singers (name, birthday, url, sex, story, nationality) VALUES (%s, %s, %s, %s, %s, %s)"
        val = [name, get_sn(soup), url, get_gt(soup), get_ts(soup), get_qt(soup) ]
        cur.execute(sql, val)
        mydb.commit()

#Lấy sinh nhật 
def get_sn(soup):
    sn = soup.find('div', class_="singer-left-avatar")
    if (sn != None) :
        sn = sn.find_all("p")
        if len(sn) > 1:
            for i in sn:
                a = i.text.split(':')
                if a[0] == 'Sinh nhật':
                    return a[1]
                else:
                    return None
                # if len(i.text) > 1:
                #     bd = sn[0].text.split(':')
                #     if bd[0].find("Sinh nhật"):
                #         return bd[1]
                #     else:
                #         return None
    return None
def get_gt(soup):
    gt = soup.find('div', class_="singer-left-avatar")
    if (gt != None) :
        gt = gt.find_all("p")
        if len(gt) > 1:
            for i in gt:
                a = i.text.split(':')
                if a[0] == 'Giới tính':
                    return a[1]
    return None

def get_qt(soup):
    sn = soup.find('div', class_="singer-left-avatar")
    if (sn != None) :
        sn = sn.find_all("p")
        if len(sn) > 1:
            for i in sn:
                a = i.text.split(':')
                if a[0] == 'Quốc gia':
                    return a[1]
    return None
def get_ts(soup):
    tieusu = None
    ts = soup.find("div", id="divDescription")
    if (ts != None) :
        ts = ts.find("p")
        if (ts != None):
            tieusu = " ".join(ts.text.split())
    return tieusu

if __name__ == '__main__':
    get_URL(mydb)