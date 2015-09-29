# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html

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

        self.slugger = Slugify(to_lower=True)

    def process_item(self, item, spider):
        if spider.name is 'mirror' or spider.name is 'mirror_home':
            return self.process_mirror(item)
        else:
            return item

    def process_mirror(self, item):
        if 'anime' in item:
            anime_id = self.get_anime_id(item)
            if anime_id:
                if '-' not in item['episode']:
                    episode_id = self.get_episode_id(item, anime_id)
                    if episode_id:
                        mirror_source_id = self.get_mirror_source_id(item)
                        if mirror_source_id:
                            self.save_mirror(item, episode_id, mirror_source_id)
                else:
                    episodes = item['episode'].split('-')
                    for episode in episodes:
                        item['episode'] = episode
                        episode_id = self.get_episode_id(item, anime_id)
                        if episode_id:
                            mirror_source_id = self.get_mirror_source_id(item)
                            if mirror_source_id:
                                self.save_mirror(item, episode_id, mirror_source_id)
        return item

    def save_mirror(self, item, episode_id, mirror_source_id):
        self.cursor.execute(
            'INSERT IGNORE INTO `mirrors` '
            '(`user_id`, `episode_id`, `mirror_source_id`, `language_id`, `url`, `translation`, `quality`, `active`, '
            '`created_at`, `updated_at`) '
            'VALUES (%s, %s, %s, %s, %s, %s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
            (1, episode_id, mirror_source_id, 1, item['url'], item['translation'], item['quality'], 1)
        )
        self.db.commit()

    def get_mirror_source_id(self, item):
        mirror_source_id = None
        try:
            self.cursor.execute(
                'INSERT IGNORE INTO `mirror_sources` (`name`, `created_at`, `updated_at`) '
                'VALUES (%s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)', (item['website'].encode('utf-8'),)
            )
            self.db.commit()

            self.cursor.execute(
                'SELECT `id` FROM `mirror_sources` WHERE `name` = %s LIMIT 1', (item['website'].encode('utf-8'),)
            )
            self.db.commit()
            mirror_source_id = self.cursor.fetchone()[0]
        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])
        return mirror_source_id

    def get_episode_id(self, item, anime_id):
        episode_id = None
        try:
            self.cursor.execute(
                'SELECT `id` FROM `episodes` WHERE `anime_id` = %s and `number` = %s LIMIT 1', (
                    anime_id, item['episode']
                )
            )
            self.db.commit()
            episode_id = self.cursor.fetchone()

            if episode_id:
                episode_id = episode_id[0]
            else:
                self.cursor.execute(
                    'INSERT IGNORE INTO `episodes` '
                    '(`anime_id`, `number`, `status`, `aired_at`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                    (anime_id, item['episode'], 1, item['date'])
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `episodes` WHERE `anime_id` = %s and `number` = %s LIMIT 1', (
                        anime_id, item['episode']
                    )
                )
                self.db.commit()
                episode_id = self.cursor.fetchone()[0]
        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])
        return episode_id

    def get_anime_id(self, item):
        anime_id = None
        try:
            self.cursor.execute(
                'SELECT `id` FROM `animes` WHERE `title` = %s LIMIT 1', (item['anime'].encode('utf-8'),)
            )
            self.db.commit()
            anime_id = self.cursor.fetchone()

            if anime_id:
                anime_id = anime_id[0]
            else:
                self.cursor.execute(
                    'SELECT `titlable_id` FROM `titles` WHERE `title` LIKE %s LIMIT 1',
                    ('%' + item['anime'].encode('utf-8') + '%',)
                )
                self.db.commit()
                anime_id = self.cursor.fetchone()

                if anime_id:
                    anime_id = anime_id[0]
                else:
                    anime_id = None
        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])
        return anime_id
