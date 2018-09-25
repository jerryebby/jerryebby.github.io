# coding=utf-8
import requests
import re
from selenium import webdriver
from bs4 import BeautifulSoup
import MySQLdb
from collections import namedtuple

def lativ_hrefSearch(url):
	res = requests.get('https://www.lativ.com.tw/' + url)
	
	soup = BeautifulSoup(res.text, 'lxml')
	tmp = soup.select('ul[class="sale_category"] a')
	for t in tmp:
		lativ_categorySearch(t.get('href'), url)

def lativ_categorySearch(url, gender):
	if gender == 'BABY':
		gender = 'KIDS'
	product_data = namedtuple('product_data',['gender','brand','product_name','original_price','sale_price','link','photo'])
	driver = webdriver.PhantomJS(executable_path='/Users/1anmiao/Downloads/phantomjs-2.1.1-macosx/bin/phantomjs')
	wholeUrl = 'https://www.lativ.com.tw/' + url
	driver.get(wholeUrl)
	pageSource = driver.page_source
	driver.close()
	"""
	fileName = 'HTML/laitv' + url.replace('/', '_') + '.html'
	file = open(fileName, "w")
	file.write(pageSource.encode('utf8'))
	file.close()
	"""
	fileName = 'TXT/lativ' + url.replace('/', '_') + '.txt'
	soup = BeautifulSoup(pageSource, 'lxml')
	tmp = soup.find_all(class_=re.compile('product-info'))
	id_list = []
	data_list = []
	for t in tmp:
		id = t['name']
		if id not in id_list:
			id_list.append(id)
			link = 'https://www.lativ.com.tw/' + t.find('a')['href']
			photo = t.find('img')['data-prodpic']
			product_name = t.find('div', class_='productname').text.strip()
			sale = t.find('span', class_='activities')
			if sale:
				i = t.find_all(class_='currency symbol')
				original_price = int(i[0].text)
				sale_price = int(i[1].text)
			else:
				original_price = int(t.find('span', class_='currency symbol').text)
				sale_price = -1
			data_list.append(product_data(gender, 'lativ', product_name, original_price, sale_price, link, photo))
	insertToDB(data_list)

def insertToDB(data_list):
	for index in data_list:
		print(type(index.gender))
		print(index.gender)
	"""
	SQLdb_id = 'python_crawl'
	SQLdb_pwd = 'U8teriWxe0ozp0rf'
	db = MySQLdb.connect('localhost', SQLdb_id, SQLdb_pwd, 'clothespricecompare', charset='utf8' )
	cursor = db.cursor()
	for index in data_list:
		sql = ("INSERT INTO `PRODUCT`(`gender`, `brand`, `product_name`, `original_price`, `sale_price`, `link`, `photo`)\
		 VALUES ('%s', '%s', '%s', %f, %f, '%s', '%s')" % \
		(index.gender, index.brand, index.product_name, index.original_price, index.sale_price, index.link, index.photo))
		cursor.execute(sql)
	db.commit()
	db.close()
	"""

urls = ['WOMEN', 'MEN', 'KIDS', 'BABY', 'SPORTS']
for url in urls:
	lativ_hrefSearch(url)
