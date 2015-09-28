# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html

from myanimelist.items import Manga
import MySQLdb
from slugify import Slugify


class MySQLStorePipeline(object):

    def __init__(self):
        self.db = MySQLdb.connect(
            user='root', passwd='root', host='localhost', db='myanilist', charset='utf8', use_unicode=True
        )
        self.cursor = self.db.cursor()

        # Enforce UTF-8 for the connection.
        self.cursor.execute('SET NAMES utf8mb4')
        self.cursor.execute('SET CHARACTER SET utf8mb4')
        self.cursor.execute('SET character_set_connection=utf8mb4')

        # Slugify instance
        self.slugger = Slugify(to_lower=True)

    def process_item(self, item, spider):
        if spider.name is 'manga':
            return self.process_manga(item)
        else:
            return item

    def process_manga(self, item):
        return item
