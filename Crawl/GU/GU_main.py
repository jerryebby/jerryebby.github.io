# coding=utf-8
import requests
from bs4 import BeautifulSoup
import MySQLdb
from collections import namedtuple
from time import localtime, strftime
import sys

reload(sys)
sys.setdefaultencoding('utf8')

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
        category = getCategory(url, product_name)
        link = tmp[0].get('href')
        tmp = i.select('dd.thumb > a > img')
        photo = tmp[0].get('src')
        tmp = i.select('dd.price')
        original_price = stripPrice(tmp[0].text)
        data_list.append(product_data(gender, category, 'GU', product_name, \
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
    if '/coat/' in url or '/jacket/' in url or '/cardigan/' in url or '/parka/' in url \
    or '/uvcut/' in url or '/windcoat/' in url or '/girlsouter/' in url or '/boysouter/' in url:
        return category('UPPER', 'OUTERWEAR')
    elif '/sweat/' in url or '/knit/' in url or '/tunic/' in url or '/designtops/' in url \
    or '/printT/' in url or '/poloshirt/' in url or '/innerT/' in url or '/girlstops/' in url \
    or '/boystops/' in url:
        return getCategoryByPName(product_name, 'UPPER', 'LONG_SLEEVES')
    elif '/longsleevetshirts/' in url:
        return category('UPPER', 'LONG_SLEEVES')
    elif '/shirts/' in url:
        return category('UPPER', 'SHIRT')
    elif '/onepiece/' in url:
        return getCategoryByPName(product_name, 'BOTTOM', 'SKIRT')
    elif '/widepants/' in url or '/pants/' in url or '/leggingspants/' in url \
    or '/croppedpants/' in url or '/suitpants/' in url or '/girlsbottoms/' in url \
    or '/boysbottoms/' in url:
        return category('BOTTOM', 'TROUSERS')
    elif '/skirt/' in url:
        return category('BOTTOM', 'SKIRT')
    elif '/jeans/' in url:
        return category('BOTTOM', 'JEANS')
    elif '/relaxedpants/' in url:
        return getCategoryByPName(product_name, 'BOTTOM', 'TROUSERS')
    elif '/shortpants/' in url:
        return category('BOTTOM', 'SHORTS')
    elif '/brafeel/' in url or '/underwear/' in url:
        return category('OTHER', 'UNDERWEAR')
    elif '/guwarm/' in url or '/gudry/' in url or '/undershirts/' in url:
        return getCategoryByPName(product_name, 'UPPER', '')
    elif '/boxers/' in url:
        return category('OTHER', 'UNDERPANTS')
    elif '/roomwear/' in url:
        return getCategoryByPName(product_name, 'OTHER', 'ACCESSORIES')
    elif '/socks/' in url or '/shoes/' in url or '/bag/' in url or '/pierce/' in url \
    or '/accessory/' in url or '/hairaccessory/' in url or '/hat/' in url or '/belt/' in url \
    or '/scarf/' in url or '/goods/' in url:
        return category('OTHER', 'ACCESSORIES')

def getCategoryByPName(product_name, p, m):
    category = namedtuple('category',['primary','minor'])
    if '外套' in product_name:
		return category('UPPER', 'OUTERWEAR')
    elif '裙' in product_name or '洋裝' in product_name:
		return category('BOTTOM', 'SKIRT')
    elif '短褲' in product_name or '1分' in product_name or '3分' in product_name:
		return category('BOTTOM', 'SHORTS')
    elif '褲' in product_name:
		return category('BOTTOM', 'TROUSERS')
    elif '襯衫' in product_name:
		return category('UPPER', 'SHIRT')
    elif '長袖' in product_name or '5分袖' in product_name or u'7分袖' in product_name \
    or u'8分袖' in product_name:
        return category('UPPER', 'LONG_SLEEVES')
    elif '背心' in product_name or '短袖' in product_name or '無袖' in product_name or \
    '細肩帶' in product_name:
        return category('UPPER', 'SHORT_SLEEVES')
    else:
		return category(p, m)

def insertToDB(data_list):
    SQLdb_id = 'python_crawl'
    SQLdb_pwd = 'U8teriWxe0ozp0rf'
    db = MySQLdb.connect('localhost', SQLdb_id, SQLdb_pwd, 'clothespricecompare', charset='utf8' )
    cursor = db.cursor()
    for index in data_list:
        sql = ("INSERT INTO `PRODUCT`(`gender`, `primary_category`, `minor_category`, `brand`, \
        `product_name`, `original_price`, `sale_price`, `link`, `photo`) \
        VALUES ('%s', '%s', '%s', '%s', '%s', %f, %f, '%s', '%s');" % \
        (index.gender, index.category.primary, index.category.minor, index.brand, \
        index.product_name, index.original_price, index.sale_price, index.link, index.photo))
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

res = requests.get('http://www.gu-global.com/tw/')
soup = BeautifulSoup(res.text, 'lxml')
tmp = soup.select('ul[class="sub2"] a')
url_list = []
for t in tmp:
    url = t.get('href')
    if url not in url_list:
        url_list.append(url)
        print url
        GU_categorySearch(t.get('href'))
cleanExpiredData()