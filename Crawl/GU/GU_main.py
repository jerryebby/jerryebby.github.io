# coding=utf-8
import requests
import re
from bs4 import BeautifulSoup
import MySQLdb
from collections import namedtuple
from time import localtime, strftime

def GU_categorySearch(url):
    res = requests.get(url)
    soup = BeautifulSoup(res.text, 'lxml')
    gender = getGender(url)
    product_data = namedtuple('product_data',['gender','category','brand','product_name', \
	'original_price','sale_price','link','photo'])
    items = soup.select('dl.info')
    data_list = []
    for i in items:
        tmp = i.select('dt.name > a')
        product_name = tmp[0].text.encode('utf-8')
        link = tmp[0].get('href')
        tmp = i.select('dd.thumb > a > img')
        photo = tmp[0].get('src')
        tmp = i.select('dd.price')
        original_price = stripPrice(tmp[0].text)
        data_list.append(product_data(gender, '', 'GU', product_name, \
		original_price, -1, link, photo))
    insertToDB(data_list)

def stripPrice(str):
    str = str.strip()
    token = 'NT$,'
    for t in token:
        str = str.replace(t, '')
    return float(str)

def getGender(url):
    if '/women/' in url:
        return 'WOMEN'
    elif '/men/' in url:
        return 'MEN'
    elif '/kids/' in url:
        return 'KIDS'
    else:
        return ''

def insertToDB(data_list):
    SQLdb_id = 'python_crawl'
	SQLdb_pwd = 'U8teriWxe0ozp0rf'
	db = MySQLdb.connect('localhost', SQLdb_id, SQLdb_pwd, 'clothespricecompare', charset='utf8' )
	cursor = db.cursor()
	for index in data_list:
		sql = ("INSERT INTO `PRODUCT`(`gender`, `primary_category`, `minor_category`, `brand`, \
		`product_name`, `original_price`, `sale_price`, `link`, `photo`)\
		 VALUES ('%s', '%s', '%s', '%s', '%s', %f, %f, '%s', '%s');" % \
		(index.gender, index.category.primary, index.category.minor, index.brand, \
		index.product_name.encode('utf-8'), index.original_price, index.sale_price, index.link, index.photo))
		cursor.execute(sql)
		print(sql)
	db.commit()
	db.close()

def cleanExpiredData():
	SQLdb_id = 'python_crawl'
	SQLdb_pwd = 'U8teriWxe0ozp0rf'
	db = MySQLdb.connect('localhost', SQLdb_id, SQLdb_pwd, 'clothespricecompare', charset='utf8' )
	cursor = db.cursor()
	date = strftime("%Y-%m-%d", localtime())
	datetime = date + ' 00:00:00'
	sql = ("DELETE FROM `PRODUCT` WHERE `brand` = 'GU' AND `time` < '%s';" % (datetime))
	cursor.execute(sql)
	print(sql)
	db.commit()
	db.close()

url = 'http://www.gu-global.com/tw/'
res = requests.get(url)
soup = BeautifulSoup(res.text, 'lxml')
tmp = soup.select('ul[class="sub2"] a')
for t in tmp:
    GU_categorySearch(t.get('href'))
cleanExpiredData()