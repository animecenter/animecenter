# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html

from myanimelist.items import Anime
import datetime
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
        if spider.name is 'anime':
            return self.process_anime(item)
        else:
            return item

    def process_anime(self, item):
        type_id = self.get_type_id(item, 'Anime')
        end_date, release_date = self.get_dates(item)
        season_id = self.get_season_id(release_date)
        classification_id = self.get_classification_id(item)
        duration = self.get_duration(item)
        anime_id = self.get_anime_id(item, type_id, classification_id, duration, release_date, end_date, season_id)
        self.get_genres(item, anime_id)
        self.get_producers(item, anime_id)
        self.get_titles(item, anime_id)
        return item

    def get_titles(self, item, anime_id):
        if item['alternative_titles']:
            titles = item['alternative_titles'].split('---div---')
            for title in titles:
                try:
                    title = title.split(':---union---')
                    self.cursor.execute(
                        'INSERT IGNORE INTO `titles` '
                        '(`title`, `language`, `titlable_id`, `titlable_type`, `created_at`, `updated_at`) '
                        'VALUES (%s, %s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                        (title[1], title[0], anime_id, 'Anime')
                    )
                    self.db.commit()

                except MySQLdb.Error, e:
                    print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_producers(self, item, anime_id):
        for producer in item['producers']:
            try:
                self.cursor.execute(
                    'INSERT IGNORE INTO `producers` (`name`, `created_at`, `updated_at`) '
                    'VALUES (%s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)', (producer,)
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `producers` WHERE `name` = %s LIMIT 1', (producer,)
                )
                self.db.commit()
                producer_id = self.cursor.fetchone()[0]

                self.cursor.execute(
                    'INSERT IGNORE INTO `anime_producer` '
                    '(`anime_id`, `producer_id`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                    (anime_id, producer_id)
                )
                self.db.commit()

            except MySQLdb.Error, e:
                print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_genres(self, item, anime_id):
        for genre in item['genres']:
            try:
                self.cursor.execute(
                    'INSERT INTO `genres` (`name`, `type`) SELECT * FROM (SELECT %s, %s) AS tmp '
                    'WHERE NOT EXISTS (SELECT id from `genres` WHERE `name` = %s and `type` = %s) LIMIT 1',
                    (genre, 'Anime', genre, 'Anime')
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `genres` WHERE `name` = %s and type = %s LIMIT 1', (genre, 'Anime')
                )
                self.db.commit()
                genre_id = self.cursor.fetchone()[0]

                self.cursor.execute(
                    'INSERT IGNORE INTO `genreables` '
                    '(`genre_id`, `genreable_id`, `genreable_type`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                    (genre_id, anime_id, 'Anime')
                )
                self.db.commit()

            except MySQLdb.Error, e:
                print 'Error %d: %s' % (e.args[0], e.args[1])

    @staticmethod
    def get_duration(item):
        if item['duration']:
            if 'hr' in item['duration'] and 'min' in item['duration']:
                duration = item['duration'].split(' hr. ')
                duration = '0' + duration[0] + '-' + duration[1].split(' min.')[0] + '-00'
            elif 'Unknown' in item['duration']:
                duration = None
            elif 'min' not in item['duration']:
                duration = '0' + item['duration'].split(' hr.')[0] + '-00-00'
            else:
                duration = item['duration']
                print duration
        else:
            duration = None
        return duration

    def get_anime_id(self, item, type_id, classification_id, duration, release_date, end_date, season_id):
        anime_id = None
        try:
            self.cursor.execute(
                'INSERT IGNORE INTO `animes` '
                '(`mal_id`, `title`, `slug`, `image`, `synopsis`, `type_id`, `episodes`, `status`, `release_date`, '
                '`end_date`, `duration`, `season_id`, `classification_id`, `created_at`, `updated_at`)'
                ' VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                (
                    item['mal_id'].encode('utf-8'), item['title'].encode('utf-8'),
                    self.slugger(item['title'].encode('utf-8')), item['image_url'], item['synopsis'].encode('utf-8'),
                    type_id, self.get_episodes(item['episodes']), item['status'].encode('utf-8'), release_date,
                    end_date, duration, season_id, classification_id
                )
            )
            self.db.commit()

            self.cursor.execute(
                'SELECT `id` FROM `animes` WHERE `slug` = %s LIMIT 1', [self.slugger(item['title'].encode('utf-8'))]
            )
            self.db.commit()
            anime_id = self.cursor.fetchone()[0]
        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])
        return anime_id

    @staticmethod
    def get_episodes(episodes):
        if 'Unknown' in episodes:
            return None
        else:
            return episodes

    @staticmethod
    def get_dates(item):
        dates = item['dates'].encode('utf-8')
        if 'Not available' not in dates:
            if len(dates) > 4:
                if len(dates) > 13:
                    dates = dates.split(' to ')
                    if len(dates[0]) >= 11:
                        release_date = datetime.datetime.strptime(dates[0], '%b %d, %Y').strftime('%Y-%m-%d')
                    elif len(dates[0]) >= 8:
                        if ',' not in dates[0]:
                            release_date = datetime.datetime.strptime(dates[0], '%b %Y').strftime('%Y-%m') + '-00'
                        else:
                            release_date = datetime.datetime.strptime(dates[0], '%d, %Y').strftime('%Y') + '-00-00'
                    elif len(dates[0]) == 7:
                        release_date = datetime.datetime.strptime(dates[0], '%d, %Y').strftime('%Y') + '-00-00'
                    else:
                        release_date = datetime.datetime.strptime(dates[0], '%Y').strftime('%Y') + '-00-00'
                    if len(dates[1]) >= 11:
                        end_date = datetime.datetime.strptime(dates[1], '%b %d, %Y').strftime('%Y-%m-%d')
                    elif len(dates[1]) >= 8:
                        if ',' not in dates[1]:
                            end_date = datetime.datetime.strptime(dates[1], '%b %Y').strftime('%Y-%m') + '-00'
                        else:
                            end_date = datetime.datetime.strptime(dates[1], '%d, %Y').strftime('%Y') + '-00-00'
                    elif len(dates[1]) == 7:
                        end_date = datetime.datetime.strptime(dates[1], '%d, %Y').strftime('%Y') + '-00-00'
                    elif '?' not in dates[1]:
                        end_date = datetime.datetime.strptime(dates[1], '%Y').strftime('%Y') + '-00-00'
                    else:
                        end_date = None
                else:
                    end_date = None
                    if 'to' in dates:
                        dates = dates.split(' to ')
                        if len(dates[0]) > 4:
                            release_date = datetime.datetime.strptime(dates[0], '%b %Y').strftime('%Y-%m') + '-00'
                        else:
                            release_date = datetime.datetime.strptime(dates[0], '%Y').strftime('%Y') + '-00-00'
                        if len(dates[1]) > 4:
                            end_date = datetime.datetime.strptime(dates[1], '%b %Y').strftime('%Y-%m') + '-00'
                        elif '?' not in dates[1]:
                            end_date = datetime.datetime.strptime(dates[0], '%Y').strftime('%Y') + '-00-00'
                    elif len(dates) >= 11:
                        release_date = datetime.datetime.strptime(dates, '%b %d, %Y').strftime('%Y-%m-%d')
                    elif len(dates) >= 8:
                        release_date = datetime.datetime.strptime(dates, '%b %Y').strftime('%Y-%m') + '-00'
                    elif len(dates) >= 5:
                        release_date = datetime.datetime.strptime(dates, '%d, %Y').strftime('%Y') + '-00-00'
                    else:
                        release_date = datetime.datetime.strptime(dates, '%Y').strftime('%Y') + '-00-00'
            else:
                release_date = datetime.datetime.strptime(dates, '%Y').strftime('%Y') + '-00-00'
                end_date = None
        else:
            release_date = None
            end_date = None
        return end_date, release_date

    def get_classification_id(self, item):
        try:
            if item['classification'] and 'None' not in item['classification']:
                self.cursor.execute(
                    'INSERT IGNORE INTO `classifications` (`name`) VALUES (%s)',
                    [item['classification'].encode('utf-8')]
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `classifications` WHERE `name` = %s LIMIT 1', [
                        item['classification'].encode('utf-8')
                    ]
                )
                self.db.commit()
                classification_id = self.cursor.fetchone()[0]
            else:
                classification_id = None
        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])

        return classification_id

    def get_type_id(self, item, model):
        try:
            if item['type']:
                self.cursor.execute(
                    'INSERT IGNORE INTO `types` (`name`, `model`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)', (item['type'].encode('utf-8'), model)
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `types` WHERE `name` = %s and `model` = %s LIMIT 1',
                    [item['type'].encode('utf-8'), model]
                )
                self.db.commit()
                type_id = self.cursor.fetchone()[0]
            else:
                type_id = None

        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])

        return type_id

    def get_season_id(self, release_date):
        if release_date:
            date = release_date.split('-')
            year = date[0]
            month = int(date[1])
            if month >= 10:
                season = 'Fall '
            elif month >= 7:
                season = 'Summer '
            elif month >= 4:
                season = 'Spring '
            else:
                season = 'Winter '
            season = season + year

            # Create a new season if it doesn't exist
            self.cursor.execute(
                'INSERT IGNORE INTO `seasons` (`name`, `active`, `created_at`, `updated_at`) '
                'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)', (season, 0)
            )
            self.db.commit()

            # Select season id
            self.cursor.execute(
                'SELECT `id` FROM `seasons` WHERE `name` = %s LIMIT 1', [season]
            )
            self.db.commit()
            return self.cursor.fetchone()[0]
        else:
            return None
