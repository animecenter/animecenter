# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html

import datetime
import MySQLdb
import os.path
import shutil
import urllib
from slugify import Slugify


class MySQLStorePipeline(object):
    def __init__(self):
        self.db = MySQLdb.connect(
            user='root', passwd='root', host='localhost', db='ac', charset='utf8', use_unicode=True
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
        status_id = self.get_status_id(item)
        end_date, release_date = self.get_dates(item)
        year = self.get_year(release_date)
        calendar_season_id = self.get_calendar_season_id(release_date)
        classification_id = self.get_classification_id(item)
        duration = self.get_duration(item)
        anime_id = self.get_anime_id(item, type_id, year, status_id, classification_id, duration, release_date,
                                     end_date, calendar_season_id)
        self.get_genres(item, anime_id)
        self.get_producers(item, anime_id)
        self.get_titles(item, anime_id)
        self.get_relations(item)
        self.get_image(item, anime_id)

        return item

    def get_image(self, item, anime_id):
        # Get path to current working directory
        path_to_current_folder = os.getcwd()
        # Get anime slug
        anime_slug = self.slugger(item['title'])
        # Get path to new folder regardless of OS folder separator
        if os.sep == '\\':
            path_to_new_folder = path_to_current_folder + '\\..\\public\\uploads\\anime\\' + anime_slug + os.sep
        else:
            path_to_new_folder = path_to_current_folder + '/../public/uploads/anime/' + anime_slug + os.sep

        # Get filename for new anime img
        file_name = anime_slug + '-1.jpg'

        # Check if path to new folder doesn't exists
        if os.path.isdir(path_to_new_folder) is False:
            os.makedirs(path_to_new_folder)

        # Check if file doesn't exist
        if os.path.isfile(path_to_new_folder + file_name) is False:

            # Download image with new file name
            urllib.urlretrieve(item['image_url'].encode('utf-8'), file_name)

            # Check if image was downloaded successfully
            if os.path.isfile(path_to_current_folder + os.sep + file_name):

                # Move downloaded image to new folder
                shutil.move(path_to_current_folder + os.sep + file_name, path_to_new_folder + file_name)

                # Check if image was moved successfully
                if os.path.isfile(path_to_new_folder + file_name):

                    try:
                        # Save image data
                        self.cursor.execute(
                            'INSERT IGNORE INTO `images` '
                            '(`user_id`, `imageable_id`, `imageable_type`, `path`, `active`, `created_at`, '
                            '`updated_at`) '
                            'VALUES (%s, %s, %s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                            (1, anime_id, 'Anime', file_name, 1)
                        )
                        self.db.commit()

                        # Get image id
                        self.cursor.execute(
                            'SELECT `id` FROM `images` '
                            'WHERE `imageable_id` = %s AND `imageable_type` = %s AND `path` = %s LIMIT 1',
                            (anime_id, 'Anime', file_name)
                        )
                        self.db.commit()
                        image_id = self.cursor.fetchone()[0]

                        # Update anime with image_id from downloaded image
                        self.cursor.execute(
                            'UPDATE `animes` SET `image_id` = %s WHERE `id` = %s LIMIT 1', (image_id, anime_id)
                        )
                        self.db.commit()

                    except MySQLdb.Error, e:
                        print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_relations(self, item):
        if item['related']:
            for relation in item['related']:
                try:
                    relationship = relation.split(': ')[0]
                    relationable_type = 'Anime' if ': anime -' in relation else 'Manga'
                    related_id = relation.split(' - ')[1]

                    self.cursor.execute(
                        'INSERT IGNORE INTO `relationships` (`name`, `active`, `created_at`, `updated_at`) '
                        'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)', (relationship, 1)
                    )
                    self.db.commit()

                    self.cursor.execute(
                        'SELECT `id` FROM `relationships` WHERE `name` = %s LIMIT 1', (relationship,)
                    )
                    self.db.commit()
                    relationship_id = self.cursor.fetchone()[0]

                    self.cursor.execute(
                        'INSERT IGNORE INTO `relations` '
                        '(`relationship_id`, `relationable_id`, `relationable_type`, `related_id`, `active`, '
                        '`created_at`, `updated_at`) '
                        'VALUES (%s, %s, %s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                        (relationship_id, item['mal_id'], relationable_type, related_id, 1)
                    )
                    self.db.commit()

                except MySQLdb.Error, e:
                    print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_titles(self, item, anime_id):
        if item['alternative_titles']:
            titles = item['alternative_titles'].split('---div---')
            for title in titles:
                try:
                    title = title.split(':---union---')
                    self.cursor.execute(
                        'INSERT IGNORE INTO `titles` '
                        '(`title`, `language`, `titleable_id`, `titleable_type`, `active`, `created_at`, `updated_at`) '
                        'VALUES (%s, %s, %s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                        (title[1], title[0], anime_id, 'Anime', 1)
                    )
                    self.db.commit()

                except MySQLdb.Error, e:
                    print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_producers(self, item, anime_id):
        for producer in item['producers']:
            try:
                self.cursor.execute(
                    'INSERT IGNORE INTO `producers` (`name`, `active`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)', (producer, 1)
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
                    'INSERT INTO `genres` (`name`, `model`) SELECT * FROM (SELECT %s, %s) AS tmp '
                    'WHERE NOT EXISTS (SELECT id from `genres` WHERE `name` = %s and `model` = %s) LIMIT 1',
                    (genre, 'Anime', genre, 'Anime')
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `genres` WHERE `name` = %s and model = %s LIMIT 1', (genre, 'Anime')
                )
                self.db.commit()
                genre_id = self.cursor.fetchone()[0]

                self.cursor.execute(
                    'INSERT IGNORE INTO `anime_genre` '
                    '(`anime_id`, `genre_id`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                    (anime_id, genre_id)
                )
                self.db.commit()

            except MySQLdb.Error, e:
                print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_anime_id(self, item, type_id, year, status_id, classification_id, duration, release_date, end_date,
                     calendar_season_id):
        anime_id = None
        try:
            self.cursor.execute(
                'INSERT IGNORE INTO `animes` '
                '(`mal_id`, `title`, `slug`, `image`, `synopsis`, `type_id`, `year`, `number_of_episodes`, '
                '`status_id`, `release_date`, `end_date`, `duration`, `calendar_season_id`, `classification_id`, '
                '`active`, `created_at`, `updated_at`) '
                'VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, '
                'CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                (
                    item['mal_id'].encode('utf-8'), item['title'].encode('utf-8'),
                    self.slugger(item['title'].encode('utf-8')), item['image_url'], item['synopsis'].encode('utf-8'),
                    type_id, year, self.get_episodes(item['number_of_episodes']), status_id, release_date, end_date,
                    duration, calendar_season_id, classification_id, 1
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
                            if dates[0].split(',')[0].isdigit():
                                release_date = datetime.datetime.strptime(dates[0], '%d, %Y').strftime('%Y') + '-00-00'
                            else:
                                release_date = datetime.datetime.strptime(dates[0], '%b, %Y').strftime('%Y') + '-00-00'
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
                            if dates[1].split(',')[0].isdigit():
                                end_date = datetime.datetime.strptime(dates[1], '%d, %Y').strftime('%Y') + '-00-00'
                            else:
                                end_date = datetime.datetime.strptime(dates[1], '%b, %Y').strftime('%Y-%m') + '-00'
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
                    elif len(dates) >= 9:
                        release_date = datetime.datetime.strptime(dates, '%b, %Y').strftime('%Y-%m') + '-00'
                    elif len(dates) == 8:
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
                    'INSERT IGNORE INTO `classifications` (`name`, `active`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                    [item['classification'].encode('utf-8'), 1]
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `classifications` WHERE `name` = %s LIMIT 1', [
                        item['classification'].encode('utf-8')
                    ]
                )
                self.db.commit()
                return self.cursor.fetchone()[0]
            else:
                return None
        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_type_id(self, item, model):
        try:
            if item['type'] and 'Unknown' not in item['type']:
                self.cursor.execute(
                    'INSERT IGNORE INTO `types` (`name`, `model`, `active`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)',
                    (item['type'].encode('utf-8'), model, 1)
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `types` WHERE `name` = %s and `model` = %s LIMIT 1',
                    [item['type'].encode('utf-8'), model]
                )
                self.db.commit()
                return self.cursor.fetchone()[0]
            else:
                return None

        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_status_id(self, item):
        try:
            if item['status']:
                self.cursor.execute(
                    'INSERT IGNORE INTO `statuses` (`name`, `active`, `created_at`, `updated_at`) '
                    'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)', (item['status'].encode('utf-8'), 1)
                )
                self.db.commit()

                self.cursor.execute(
                    'SELECT `id` FROM `statuses` WHERE `name` = %s LIMIT 1', (item['status'].encode('utf-8'),)
                )
                self.db.commit()
                return self.cursor.fetchone()[0]
            else:
                return None

        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])

    @staticmethod
    def get_year(release_date):
        try:
            if release_date:
                return release_date.split('-')[0]
            else:
                return None

        except MySQLdb.Error, e:
            print 'Error %d: %s' % (e.args[0], e.args[1])

    def get_calendar_season_id(self, release_date):
        if release_date:
            month = int(release_date.split('-')[1])
            if month >= 10:
                season = ' Fall'
            elif month >= 7:
                season = ' Summer'
            elif month >= 4:
                season = ' Spring'
            else:
                season = ' Winter'

            # Create a new calendar season if it doesn't exist
            self.cursor.execute(
                'INSERT IGNORE INTO `calendar_seasons` (`name`, `active`, `created_at`, `updated_at`) '
                'VALUES (%s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)', (season, 1)
            )
            self.db.commit()

            # Select season id
            self.cursor.execute(
                'SELECT `id` FROM `calendar_seasons` WHERE `name` = %s LIMIT 1', [season]
            )
            self.db.commit()

            return self.cursor.fetchone()[0]
        else:
            return None

    @staticmethod
    def get_duration(item):
        if item['duration']:
            if 'hr' in item['duration'] and 'min' in item['duration']:
                duration = item['duration'].split(' hr. ')
                duration = '0' + duration[0] + ':' + duration[1].split(' min.')[0] + ':00'
            elif 'Unknown' in item['duration']:
                duration = None
            elif 'min' not in item['duration']:
                duration = '0' + item['duration'].split(' hr.')[0] + ':00:00'
            else:
                duration = item['duration'].split(' min')[0]
                if len(duration) == 1:
                    duration = '00:0' + duration + ':00'
                else:
                    duration = '00:' + duration + ':00'
            return duration
        else:
            return None
