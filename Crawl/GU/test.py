# coding=utf-8
import requests
from selenium import webdriver
from bs4 import BeautifulSoup

driver = webdriver.PhantomJS(executable_path='/Users/1anmiao/Downloads/phantomjs-2.1.1-macosx/bin/phantomjs')
url = 'http://www.gu-global.com/tw/'
driver.get(url)

pageSource = driver.page_source
driver.close()

fileName = 'HTML/GU_' + url.replace('/', '_') + '.html'
file = open(fileName, "w")
file.write(pageSource.encode('utf8'))
file.close()