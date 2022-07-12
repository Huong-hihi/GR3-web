from bs4 import BeautifulSoup
import urllib.request
import json
from pymysql import NULL
import requests
import pymysql
from sqlalchemy import null

mydb = pymysql.connect(
  host="localhost",
  port = 3306,
  user="root",
  password="",
  db="gr2"
)

def get_URL(mydb):
    url =  'https://www.nhaccuatui.com/bai-hat/nhac-tre-moi.html'
    page = urllib.request.urlopen(url)
    soup = BeautifulSoup(page, 'html.parser')
    content = soup.find('ul', class_="detail_menu_browsing_dashboard").find_all('li')
    for c in content:
        print("=======================================")
        cur = mydb.cursor()
        sql = "INSERT INTO categories (name, parent_id) VALUES (%s, %s)"
        name = c.find('a')
        if name != None:
            val = (name.text, 1)
            cur.execute(sql, val)
            mydb.commit()

if __name__ == '__main__':
    get_URL(mydb)