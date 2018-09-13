# coding=utf-8
from selenium import webdriver
from bs4 import BeautifulSoup

def uniqlo_categorySearch(url):
	driver = webdriver.PhantomJS(executable_path='/Users/1anmiao/Downloads/phantomjs-2.1.1-macosx/bin/phantomjs')

	driver.get(url)
	pageSource = driver.page_source

	fileName = 'HTML/uniqlo_' + url.replace('/', '_') + '.html'
	file = open(fileName, "w")
	file.write(pageSource.encode('utf8'))
	file.close()

	driver.close()
	


driver = webdriver.PhantomJS(executable_path='/Users/1anmiao/Downloads/phantomjs-2.1.1-macosx/bin/phantomjs')
url = 'http://www.uniqlo.com/tw/'

driver.get(url)

pageSource = driver.page_source
driver.close()

soup = BeautifulSoup(pageSource, 'lxml')

tmp = soup.select('div[class="gnav_inner"] a')