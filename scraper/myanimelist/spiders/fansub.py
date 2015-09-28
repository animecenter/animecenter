# -*- coding: utf-8 -*-
import scrapy
from myanimelist.items import Fansub


class FansubSpider(scrapy.Spider):
    name = 'fansub'
    allowed_domains = ['myanimelist.net']
    start_urls = [
        'http://myanimelist.net/fansub-groups.php?letter=.',
        'http://myanimelist.net/fansub-groups.php?letter=A',
        'http://myanimelist.net/fansub-groups.php?letter=B',
        'http://myanimelist.net/fansub-groups.php?letter=C',
        'http://myanimelist.net/fansub-groups.php?letter=D',
        'http://myanimelist.net/fansub-groups.php?letter=E',
        'http://myanimelist.net/fansub-groups.php?letter=F',
        'http://myanimelist.net/fansub-groups.php?letter=G',
        'http://myanimelist.net/fansub-groups.php?letter=H',
        'http://myanimelist.net/fansub-groups.php?letter=I',
        'http://myanimelist.net/fansub-groups.php?letter=J',
        'http://myanimelist.net/fansub-groups.php?letter=K',
        'http://myanimelist.net/fansub-groups.php?letter=L',
        'http://myanimelist.net/fansub-groups.php?letter=M',
        'http://myanimelist.net/fansub-groups.php?letter=N',
        'http://myanimelist.net/fansub-groups.php?letter=O',
        'http://myanimelist.net/fansub-groups.php?letter=P',
        'http://myanimelist.net/fansub-groups.php?letter=Q',
        'http://myanimelist.net/fansub-groups.php?letter=R',
        'http://myanimelist.net/fansub-groups.php?letter=S',
        'http://myanimelist.net/fansub-groups.php?letter=T',
        'http://myanimelist.net/fansub-groups.php?letter=U',
        'http://myanimelist.net/fansub-groups.php?letter=V',
        'http://myanimelist.net/fansub-groups.php?letter=W',
        'http://myanimelist.net/fansub-groups.php?letter=X',
        'http://myanimelist.net/fansub-groups.php?letter=Y',
        'http://myanimelist.net/fansub-groups.php?letter=Z']

    def parse(self, response):
        for link in response.xpath('//*[@id="content"]/table/tr/td[1]/a/@href').extract():
            yield scrapy.Request('http://myanimelist.net/fansub-groups.php' + link, callback=self.parse_fansub)

    @staticmethod
    def parse_fansub(response):
        item = Fansub()
        item['title'] = response.xpath('//*[@id="content"]/table/tr/td/text()[2]').extract()[0].replace('\n\t\t', '')
        item['short'] = response.xpath('//*[@id="content"]/table/tr/td/text()[4]').extract()[0].replace('\n\t\t', '')
        item['website'] = response.xpath('//*[@id="content"]/table/tr/td/a/@href').extract()[0]
        item['irc'] = response.xpath('//*[@id="content"]/table/tr/td/text()[9]').extract()[0].replace('\n\t\t', '')
        item['language'] = response.xpath('//*[@id="content"]/table/tr/td/text()[11]').extract()[0].replace(
            '\n\t\t', '')
        item['animes'] = '--div--'.join(response.xpath(
            '//div[@style="border-width: 0; margin: 12px 0 0 0;"]/a/strong/text()').extract())
        yield item
