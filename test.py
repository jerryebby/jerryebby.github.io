# coding=utf-8
import MySQLdb

SQLdb_id = 'root'
SQLdb_pwd = 'aj851226'
db = MySQLdb.connect('localhost', SQLdb_id, SQLdb_pwd, 'clothespricecompare', charset='utf8' )
cursor = db.cursor()

gender = 'male'
category = 'shirt'
brand = 'lativ'
product_name = '藍襯衫'
original_price = 129890.3
sale_price = 3
link = 'https://www.lativ.com.tw/Detail/34930041'
photo = 'https://s1.lativ.com.tw/i/34930/34930_D_21_n.jpg'

sql = ("INSERT INTO `PRODUCT`(`gender`, `category`, `brand`, `product_name`, `original_price`, `sale_price`, `link`, `photo`) VALUES ('%s', '%s', '%s', '%s', %f, %f, '%s', '%s')" % (gender,category,brand,product_name,original_price,sale_price,link,photo))
cursor.execute(sql)
db.commit()
db.close()
