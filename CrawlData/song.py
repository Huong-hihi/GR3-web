from bs4 import BeautifulSoup
import urllib.request
import requests
import pymysql

def get_URL(mydb):
    for i in range(1, 25):
        url =  'https://www.nhaccuatui.com/bai-hat/khong-loi-moi.'+ str(i)+'.html'
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
    getUrl = soup.find_all('div', class_='info_song');
    for link in getUrl:
        linksong = link.find('a');
        Data(linksong['href'], mydb)

def Data(url, mydb):
    page = requests.get(url)
    soup = BeautifulSoup(page.content, "html.parser")
    print("=======================================")
    cur = mydb.cursor()
    sql = "INSERT INTO songs (name, singer, url, musician, lyrics, category_id) VALUES (%s, %s, %s, %s, %s, %s)"
    val = (get_namesong(soup), get_namesinger(soup), url, get_nhacsi(soup), get_lyrics(soup), 28 )
    try:
        cur.execute(sql, val)
        mydb.commit()
    except:
        pass
# tên bài hát 
def get_namesong(soup):
    try:
        name = soup.find('div', class_="name_title")
        namesong = name.find('h1').text
        return namesong
    except:
        pass

def get_namesinger(soup):
    try:
        name = soup.find('div', class_="name_title")
        namesinger = name.find('h2').find('a').text
        return namesinger
    except:
        pass

def get_nhacsi(soup):
    try:
        nhacsi = soup.find("div", class_="pd_name_lyric").find_all("p", class_="name_post")
        if (nhacsi != None):
            if len(nhacsi[0].text) > 1:
                ten_nhac_si = nhacsi[0].text.split(':')
                return ten_nhac_si[1].strip()
            else:
                return None
    except:
        pass
def get_lyrics(soup):
    try:
        lyrics = soup.find("div", id="lyrics").find("p").text
        if (lyrics != None):
            loi = " ".join(lyrics.split())
            return loi
        return None
    except:
        pass
if __name__ == '__main__':
    get_URL(mydb)
    #get_URL(mydb)