# -*- coding: utf-8 -*-
import scrapy
from myanimelist.items import Mirror


class MirrorSpider(scrapy.Spider):
    name = "mirror"
    allowed_domains = ["animerush.tv"]
    start_urls = [
        'http://www.animerush.tv/anime-series-list/',
    ]

    def parse(self, response):
        for anime in response.xpath('//div[@class="amin_box2"]/div[2]/div/a/@href').extract():
            yield scrapy.Request(anime, callback=self.parse_anime)

    def parse_anime(self, response):
        for episode in response.xpath('//div[@class="episode_list"]/a/@href').extract():
            yield scrapy.Request(episode, callback=self.parse_episode)

    def parse_episode(self, response):
        for mirror in response.xpath('//*[@id="episodes"]/div/div/span/a/@href').extract():
            yield scrapy.Request(mirror, callback=self.parse_mirror)

    @staticmethod
    def parse_mirror(response):
        item = Mirror()
        website = response.xpath('//div[@class="episode_on"]/div/h3/a/text()').extract()
        if (website and any(word in website[0] for word in ['Dailymotion', 'Goplayer', 'COM'])) or not website:
            yield item
        else:
            item['url'] = response.xpath(
                '//div[@id="embed_holder"]/div/iframe/@src | //div[@id="embed_holder"]/div/embed/@src | ' +
                '//div[@id="embed_holder"]/div/center/iframe/@src | //div[@id="embed_holder"]/div/div/embed/@src'
            ).extract()[0]
            if 'animerush' not in item['url']:
                item['website'] = website[0].replace('s Video', '').replace('HD Video', '').replace(' Video', '')
                item['anime'] = response.xpath('//*[@id="left-column"]/div[2]/div/div[1]/a/text()').extract()[0]
                item['episode'] = response.xpath('//h1/text()').extract()[0].split(' Episode ')[1]
                item['translation'] = response.xpath('//div[@class="episode_on"]/div/span[2]/text()').extract()[0].lower()
                item['date'] = response.xpath('//div[@class="episode_on"]/div/span[3]/text()').extract()[0]
                if response.xpath('//div[@class="episode_on"]/div/div/img/@alt').extract():
                    item['quality'] = 'HD'
                else:
                    item['quality'] = 'SD'
                yield item
            else:
                yield item
