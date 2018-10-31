# coding=utf-8
str = 'NT$1,990'
token = 'NT$,'
for t in token:
    str = str.replace(t, '')
print float(str)