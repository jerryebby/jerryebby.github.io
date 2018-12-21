# coding=utf-8
import requests
from selenium import webdriver

driver = webdriver.PhantomJS(executable_path='/Users/1anmiao/Downloads/phantomjs-2.1.1-macosx/bin/phantomjs')
driver.get('https://www.zalora.com.tw/women/clothing/skirts/?from=header')
pageSource = driver.page_source
driver.close()
file = open('test1.html', 'w')
file.write(pageSource.encode('utf-8'))
file.close()