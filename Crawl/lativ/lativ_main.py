# coding=utf-8
import requests
import re
from selenium import webdriver
from bs4 import BeautifulSoup
import MySQLdb
from collections import namedtuple
from time import localtime, strftime

# 進入男、女、童裝總頁面取得各商品別url
def lativ_hrefSearch(url):
	res = requests.get('https://www.lativ.com.tw/' + url)
	
	soup = BeautifulSoup(res.text, 'lxml')
	tmp = soup.select('ul[class="sale_category"] a')
	for t in tmp:
		lativ_categorySearch(t.get('href'))

# 進入各商品別頁面取得產品資訊
def lativ_categorySearch(url):
	url = 'https://www.lativ.com.tw/' + url
	banned_list = ['/sweatshirt', '/FLEECE', '/pima', '/Chiffon', '/COOL', '/Heatup', '/heatup', \
	 '/room-wear', '/bodysuit']
	for i in banned_list:
		if i in url:
			return
	gender = getGender(url)
	product_data = namedtuple('product_data',['gender','category','brand','product_name', \
	'original_price','sale_price','link','photo'])
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
			link = 'https://www.lativ.com.tw' + t.find('a')['href']
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
			data_list.append(product_data(gender, category, 'lativ', product_name, \
			original_price, sale_price, link, photo))
	insertToDB(data_list)

# 判斷商品性別
def getGender(url):
	if '/BABY/' in url or '/KIDS/' in url or '/SPORT_KIDS/' in url:
		return 'KIDS'
	elif '/WOMEN/' in url or '/SPORT_WOMEN/' in url:
		return 'WOMEN'
	elif '/MEN/' in url or '/SPORT_MEN/' in url:
		return 'MEN'
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
# 由url判斷商品種類，若該頁商品種類繁多則進入 getCategoryByPName
def getCategory(url, product_name):
	category = namedtuple('category',['primary','minor'])
	# women, men, kids
	if '/WOMEN/' in url or '/MEN/' in url or '/KIDS/' in url:
		# 上身
		if '/Tshirt-POLO/' in url: 
			if '/Short-Graphic-TEE' in url or '/short-sleeves' in url:
				return category('UPPER', 'SHORT_SLEEVES')
			elif '/LONG-Graphic-TEE' in url or '/long-sleeves' in url:
				return category('UPPER', 'LONG_SLEEVES')
			elif '/LV-sleeve' in url:
				return getCategoryByPName(product_name, 'UPPER', '')
			elif '/POLO' in url:
				return category('UPPER', 'POLO')
			else: return category('UPPER', '')
		# 襯衫
		elif '/shirts/' in url:
			return category('UPPER', 'SHIRT')
		# 針織衫
		elif '/KNIT/' in url: 
			return getCategoryByPName(product_name, 'UPPER', 'LONG_SLEEVES')
		# 外套
		elif '/Coat_category/' in url:
			return category('UPPER', 'OUTERWEAR')
		# 下身
		elif '/bottoms/' in url:
			if '/LongPants2' in url or '/Widepants' in url or '/joggers' in url:
				return category('BOTTOM', 'TROUSERS')
			elif '/Jeans' in url:
				return category('BOTTOM', 'JEANS')
			elif '/Shorts' in url:
				return category('BOTTOM', 'SHORTS')
			elif '/Skirt' in url or '/Dress' in url:
				return category('BOTTOM', 'SKIRT')
			else: 
				return getCategoryByPName(product_name, 'BOTTOM', '')
		# 家居、內著
		elif '/underwear/' in url:
			if '/brassiere' in url or '/T-Bra' in url or '/T-Bra' in url or '/inner-wear' in url \
			or '/Girls%20bras' in url or '/inner' in url:
				return category('OTHER', 'UNDERWEAR')
			elif '/Leggings' in url or '/leggings' in url:
				return category('BOTTOM', 'TROUSERS')
			elif '/Briefs' in url:
				return category('OTHER', 'UNDERPANTS')
			elif '/socks' in url:
				return category('OTHER', 'ACCESSORIES')
			else:
				return category('OTHER', '')
		# 配件
		elif '/accessories/' in url:
			return category('OTHER', 'ACCESSORIES')
		# 無法判斷
		else:
			return category('OTHER', '')
	# baby
	elif '/BABY/' in url:
		# 上身
		if '/tops/' in url:
			if '/Short-Graphic-TEE' in url or '/Short-sleeved' in url:
				return category('UPPER', 'SHORT_SLEEVES')
			elif '/LONG-Graphic-TEE' in url or '/long-sleeves' in url:
				return category('UPPER', 'LONG_SLEEVES')
			else: return category('UPPER', '')
		# 襯衫
		elif '/shirts/' in url:
			return category('UPPER', 'SHIRT')
		# 外套
		elif '/Coat_category/' in url:
			return category('UPPER', 'OUTERWEAR')
		# 下身
		elif '/bottoms/' in url:
			if '/pants' in url:
				return category('BOTTOM', 'TROUSERS')
			elif '/Jeans' in url:
				return category('BOTTOM', 'JEANS')
			elif '/Shorts' in url:
				return category('BOTTOM', 'SHORTS')
			elif '/skirts' in url or '/Dress' in url:
				return category('BOTTOM', 'SKIRT')
			else: 
				return getCategoryByPName(product_name, 'BOTTOM', '')
		# 家居、配件
		elif '/Home-Set/' in url or '/accessories/' in url:
			return category('OTHER', 'ACCESSORIES')
		# 無法判斷
		else:
			return category('OTHER', '')
	# sport
	elif '/SPORTS/' in url:
		return category('OTHER', 'SPORTS')
	# 無法判斷
	else:
		return category('OTHER', '')

# 由品名判斷商品種類
def getCategoryByPName(product_name, p, m):
	category = namedtuple('category',['primary','minor'])
	if u'外套' in product_name:
		return category('UPPER', 'OUTERWEAR')
	elif u'襯衫' in product_name:
		return category('UPPER', 'SHIRT')
	elif u'裙' in product_name or u'洋裝' in product_name:
		return category('BOTTOM', 'SKIRT')
	elif u'短褲' in product_name:
		return category('BOTTOM', 'SHORTS')
	elif u'背心' in product_name or u'短袖' in product_name:
		return category('UPPER', 'SHORT_SLEEVES')
	elif u'褲' in product_name: 
		return category('BOTTOM', 'TROUSERS')
	else: 
		return category(p, m)
	
# 寫入資料庫
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

# 清除前一批資料
def cleanExpiredData():
	SQLdb_id = 'python_crawl'
	SQLdb_pwd = 'U8teriWxe0ozp0rf'
	db = MySQLdb.connect('localhost', SQLdb_id, SQLdb_pwd, 'clothespricecompare', charset='utf8' )
	cursor = db.cursor()
	date = strftime("%Y-%m-%d", localtime())
	datetime = date + ' 00:00:00'
	sql = ("DELETE FROM `PRODUCT` WHERE `brand` = 'lativ' AND `time` < '%s';" % (datetime))
	cursor.execute(sql)
	print(sql)
	db.commit()
	db.close()

# 程式執行起點
urls = ['WOMEN', 'MEN', 'KIDS', 'BABY', 'SPORTS']
for url in urls:
	lativ_hrefSearch(url)
cleanExpiredData()