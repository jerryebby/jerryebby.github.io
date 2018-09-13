from bs4 import BeautifulSoup

soup = BeautifulSoup(open('test.html'), 'lxml')
#print()

"""fileName = 'test.html'
file = open(fileName, "w")
file.write(soup.prettify().encode('utf8'))
file.close()"""

tmp = soup.select('ul[class="sale_category"] a')
#print(tmp)
for t in tmp:
	print(t.get('href'))