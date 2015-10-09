# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

from scrapy.item import Item, Field


class Anime(Item):
    title = Field()
    synopsis = Field()
    alternative_titles = Field()
    type = Field()
    number_of_episodes = Field()
    status = Field()
    dates = Field()
    producers = Field()
    genres = Field()
    duration = Field()
    classification = Field()
    related = Field()
    mal_id = Field()
    opening = Field()
    ending = Field()
    image_url = Field()


class Character(Item):
    alias = Field()
    name = Field()
    japanese = Field()
    synopsis = Field()
    voices = Field()
    animes = Field()
    mangas = Field()
    mal_id = Field()
    image_url = Field()


class Fansub(Item):
    title = Field()
    short = Field()
    website = Field()
    irc = Field()
    language = Field()
    animes = Field()


class Manga(Item):
    mal_id = Field()
    title = Field()
    alternative_titles = Field()
    synopsis = Field()
    type = Field()
    volumes = Field()
    chapters = Field()
    status = Field()
    published = Field()
    genres = Field()
    authors = Field()
    serialization = Field()
    related = Field()
    image_url = Field()


class Mirror(Item):
    anime = Field()
    episode = Field()
    website = Field()
    url = Field()
    translation = Field()
    date = Field()
    quality = Field()


class Person(Item):
    name = Field()
    mal_id = Field()
    given = Field()
    family = Field()
    birthday = Field()
    website = Field()
    more = Field()
    image = Field()
    voices = Field()
    staffs = Field()
    mangas = Field()
