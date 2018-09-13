# coding=utf-8
import requests
import re
from selenium import webdriver
from bs4 import BeautifulSoup

def lativ_hrefSearch(url):
	res = requests.get('https://www.lativ.com.tw/' + url)
	
	soup = BeautifulSoup(res.text, 'lxml')
	tmp = soup.select('ul[class="sale_category"] a')
	for t in tmp:
		#print(t.get('href'))
		lativ_categorySearch(t.get('href'))

def lativ_categorySearch(url):
	driver = webdriver.PhantomJS(executable_path='/Users/1anmiao/Downloads/phantomjs-2.1.1-macosx/bin/phantomjs')
	wholeUrl = 'https://www.lativ.com.tw/' + url
	#print(tmp)
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
	#file = open(fileName, 'w')
	soup = BeautifulSoup(pageSource, 'lxml')
	tmp = soup.find_all(class_=re.compile('product-info'))
	id_list = []
	for t in tmp:
		id = t['name']
		if id not in id_list:
			id_list.append(id)
			link = t.find('a')['href']
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
			print(id)
			print(link)
			print(photo)
			print(product_name)
			print(original_price)
			print(sale_price)





		#file.write(t.encode('utf8'))
		#file.write('\n\n\n')
	#file.close()

lativ_categorySearch('MEN/Tshirt-POLO/long-sleeves')