# coding=utf-8
import MySQLdb
from collections import namedtuple

product_data = namedtuple('product_data',['brand','product_name','original_price','sale_price','link','photo'])
data_list = []


gender = 'male'
category = 'shirt'
brand = 'lativ'
product_name = '藍襯衫'
original_price = 129890.3
sale_price = 3
link = 'https://www.lativ.com.tw/Detail/34930041'
photo = 'https://s1.lativ.com.tw/i/34930/34930_D_21_n.jpg'

for i in range(1, 10):
	data_list.append(product_data('lativ', product_name, original_price, i, link, photo))

SQLdb_id = 'python_crawl'
SQLdb_pwd = 'U8teriWxe0ozp0rf'
db = MySQLdb.connect('localhost', SQLdb_id, SQLdb_pwd, 'clothespricecompare', charset='utf8' )
cursor = db.cursor()
for index in data_list:
	sql = ("INSERT INTO `PRODUCT`(`brand`, `product_name`, `original_price`, `sale_price`, `link`, `photo`)\
	 VALUES ('%s', '%s', %f, %f, '%s', '%s')" % \
	(index.brand, index.product_name, index.original_price, index.sale_price, index.link, index.photo))
	cursor.execute(sql)
db.commit()
db.close()