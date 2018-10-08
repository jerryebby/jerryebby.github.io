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
	banned_list = ['/sweatshirt', '/FLEECE', '/pima', '/Chiffon', '/COOL', '/Heatup', '/heatup', '/room-wear']
	url = 'https://www.lativ.com.tw/' + url
	for i in banned_list:
		if i in url:
			return
	gender = getGender(url, gender)
	product_data = namedtuple('product_data',['gender','category','brand','product_name','original_price','sale_price','link','photo'])
	driver = webdriver.PhantomJS(executable_path='/home/clothespricecompare/phantomjs-2.1.1-linux-x86_64/bin/phantomjs')
	driver.get(url)
	pageSource = driver.page_source
	driver.close()
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
			category = getCategory(url, product_name)
			sale = t.find('span', class_='activities')
			if sale:
				i = t.find_all(class_='currency symbol')
				original_price = int(i[0].text)
				sale_price = int(i[1].text)
			else:
				original_price = int(t.find('span', class_='currency symbol').text)
				sale_price = -1
			data_list.append(product_data(gender, category, 'lativ', product_name, original_price, sale_price, link, photo))
	insertToDB(data_list)

def getGender(url, gender):
	if gender == 'BABY':
		return 'KIDS'
	elif gender == 'SPORTS':
		if '/SPORT_WOMEN/' in url:
			return 'WOMEN'
		elif '/SPORT_MEN/' in url:
			return 'MEN'
		elif '/SPORT_KIDS/' in url:
			return 'KIDS'
		else:
			return ''

"""
上衣 UPPER
	短袖 SHORT_SLEEVES
	長袖 LONG_SLEEVES
	POLO衫 POLO
	襯衫 SHIRT
	外套  OUTERWEAR
下身 BOTTOM
	短褲 SHORTS
	長褲 TROUSERS
	牛仔褲 JEANS
	裙裝 SKIRT（WOMEN）
其他 OTHER
	運動 SPORTS
	配件 ACCESSORIES
	內衣 UNDERWEAR
	內褲 UNDERPANTS
"""

def getCategory(url, product_name):
	category = namedtuple('category',['primary','minor'])
	if '/WOMEN/' in url or '/MEN/' in url or '/KIDS/' in url or '/BABY/' in url:
		if '/Tshirt-POLO/' in url: 
			if '/Short-Graphic-TEE' in url or '/short-sleeves' in url:
				return category('UPPER', 'SHORT_SLEEVES')
			elif '/LONG-Graphic-TEE' in url or '/long-sleeves' in url:
				return category('UPPER', 'LONG_SLEEVES')
			elif '/LV-sleeve' in url:
				ret = getCategoryByPName(product_name)
				if ret == category('OTHER', ''):
					return category('UPPER', '')
				else: 
					return ret
			elif '/POLO' in url:
				if '長袖' in product_name:
					return category('UPPER', 'LONG_SLEEVES')
				else:
					return category('UPPER', 'SHORT_SLEEVES')
			else: return category('UPPER', '')
		elif '/shirts/' in url:
			return category('UPPER', 'SHIRT')
		elif '/KNIT/' in url: 
			ret = getCategoryByPName(product_name)
			if ret == category('OTHER', ''):
				return category('UPPER', 'LONG_SLEEVES')
			else: return ret
		elif '/Coat_category/' in url:
			return category('UPPER', 'OUTERWEAR')
		elif '/bottoms/' in url:
			if '/LongPants2' in url or '/Widepants' in url or '/joggers' in url:
				return category('BOTTOM', 'TROUSERS')
			elif '/Jeans' in url:
				return category('BOTTOM', 'JEANS')
			elif '/Shorts' in url:
				return category('BOTTOM', 'SHORTS')
			elif '/Skirt' in url or '/Dress' in url:
				return category('BOTTOM', 'SKIRT')
			else: return category('BOTTOM', '')
		elif '/underwear/' in url:
			if '/brassiere' in url or '/T-Bra' in url or '/T-Bra' in url or '/inner-wear' in url:
				return category('OTHER', 'UNDERWEAR')
			elif '/Leggings' in url:
				return category('BOTTOM', 'TROUSERS')
			elif '/Briefs' in url:
				return category('OTHER', 'UNDERPANTS')
			elif '/socks' in url:
				return category('OTHER', 'ACCESSORIES')
		elif '/accessories/' in url:
			return category('OTHER', 'ACCESSORIES')
		return category('OTHER', '')
	elif '/SPORTS/' in url:
		return category('OTHER', 'SPORTS')
	else:
		return category('OTHER', '')

def getCategoryByPName(product_name):
	category = namedtuple('category',['primary','minor'])
	if '外套' in product_name:
		return category('UPPER', 'OUTERWEAR')
	elif '襯衫' in product_name:
		return category('UPPER', 'SHIRT')
	elif '裙' in product_name or '洋裝' in product_name:
		return category('BOTTOM', 'SKIRT')
	elif '短褲' in product_name:
		return category('BOTTOM', 'SHORTS')
	elif '背心' in product_name or '短袖' in product_name:
		return category('UPPER', 'SHORT_SLEEVES')
	elif '褲' in product_name: 
		return category('BOTTOM', 'TROUSERS')
	else: return category('OTHER', '')
	
	
def insertToDB(data_list):
	SQLdb_id = 'python_crawl'
	SQLdb_pwd = 'U8teriWxe0ozp0rf'
	db = MySQLdb.connect('localhost', SQLdb_id, SQLdb_pwd, 'clothespricecompare', charset='utf8' )
	cursor = db.cursor()
	for index in data_list:
		sql = ("INSERT INTO `PRODUCT`(`gender`, `primary_category`, `minor_category`, `brand`, `product_name`, `original_price`, `sale_price`, `link`, `photo`)\
		 VALUES ('%s', '%s', '%s', '%s', '%s', %f, %f, '%s', '%s')" % \
		(index.gender, index.category.primary, index.category.minor, index.brand, index.product_name, index.original_price, index.sale_price, index.link, index.photo))
		cursor.execute(sql)
		print(sql)
	db.commit()
	db.close()


urls = ['WOMEN', 'MEN', 'KIDS', 'BABY', 'SPORTS']
for url in urls:
	lativ_hrefSearch(url)