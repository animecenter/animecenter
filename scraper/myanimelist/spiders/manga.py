# -*- coding: utf-8 -*-
import scrapy
import re
from myanimelist.items import Manga


class MangaSpider(scrapy.Spider):
    name = 'manga'
    allowed_domains = ['myanimelist.net']
    start_urls = [
        'http://myanimelist.net/manga.php?letter=.',
        'http://myanimelist.net/manga.php?letter=A',
        'http://myanimelist.net/manga.php?letter=B',
        'http://myanimelist.net/manga.php?letter=C',
        'http://myanimelist.net/manga.php?letter=D',
        'http://myanimelist.net/manga.php?letter=E',
        'http://myanimelist.net/manga.php?letter=F',
        'http://myanimelist.net/manga.php?letter=G',
        'http://myanimelist.net/manga.php?letter=H',
        'http://myanimelist.net/manga.php?letter=I',
        'http://myanimelist.net/manga.php?letter=J',
        'http://myanimelist.net/manga.php?letter=K',
        'http://myanimelist.net/manga.php?letter=L',
        'http://myanimelist.net/manga.php?letter=M',
        'http://myanimelist.net/manga.php?letter=N',
        'http://myanimelist.net/manga.php?letter=O',
        'http://myanimelist.net/manga.php?letter=P',
        'http://myanimelist.net/manga.php?letter=Q',
        'http://myanimelist.net/manga.php?letter=R',
        'http://myanimelist.net/manga.php?letter=S',
        'http://myanimelist.net/manga.php?letter=T',
        'http://myanimelist.net/manga.php?letter=U',
        'http://myanimelist.net/manga.php?letter=V',
        'http://myanimelist.net/manga.php?letter=W',
        'http://myanimelist.net/manga.php?letter=X',
        'http://myanimelist.net/manga.php?letter=Y',
        'http://myanimelist.net/manga.php?letter=Z'
    ]

    def parse(self, response):
        if "show" not in response.url:
            pages_number = int(
                response.xpath(
                    '//*[@id="content"]/div[2]/div[2]/div/span/a[last()]/@href'
                ).extract()[0].split('&show=')[1]) / 50 + 1
            for x in range(0, pages_number):
                yield scrapy.Request(response.url + '&show=' + str(x * 50), callback=self.parse)
        else:
            for link in response.xpath("//div[@class='picSurround']/a/@href").extract():
                yield scrapy.Request('http://myanimelist.net' + link, callback=self.parse_manga)

    @staticmethod
    def parse_manga(response):
        item = Manga()
        item['title'] = response.xpath("//h1/span/text()").extract()[0].strip()
        item['synopsis'] = re.sub(r'\([^)]*\)', '', response.xpath(
            'string(//h2[text()="Synopsis"]/..)').extract()[0].replace('EditSynopsis', '').replace(
            '\n\n', '\n')).split('EditBackground')[0]
        item['alternative_titles'] = '---div---'.join(response.xpath(
            "//div[preceding-sibling::h2='Alternative Titles' and following-sibling::h2='Information']//text()"
        ).extract()).replace('---div--- ', '---union---')
        item['type'] = response.xpath(
            "//div[@id='content']/table/tr/td/h2[text()='Information']/following-sibling::div[1]/text()"
        ).extract()[0].strip()
        item['volumes'] = response.xpath(
            "//div[@id='content']/table/tr/td/h2[text()='Information']/following-sibling::div[2]/text()"
        ).extract()[0].strip()
        item['chapters'] = response.xpath(
            "//div[@id='content']/table/tr/td/h2[text()='Information']/following-sibling::div[3]/text()"
        ).extract()[0].strip()
        item['status'] = response.xpath(
            "//div[@id='content']/table/tr/td/h2[text()='Information']/following-sibling::div[4]/text()"
        ).extract()[0].strip()
        item['published'] = response.xpath(
            "//div[@id='content']/table/tr/td/h2[text()='Information']/following-sibling::div[5]/text()"
        ).extract()[0].strip().replace('  ', ' ')
        item['genres'] = response.xpath(
            "//div[@id='content']/table/tr/td/h2[text()='Information']/following-sibling::div[6]/a/text()").extract()
        authors = []
        for author in response.xpath('//*[@id="content"]/table/tr/td[1]/div[14]/a'):
            data = author.xpath('@href').extract()[0].split('/')
            relation = author.xpath('following-sibling::text()[1]').extract()[0].replace('  ', '').replace(
                ',', ' ').replace('(', '').replace(')', '').strip()
            authors.extend([relation + ' - ' + data[1] + ' - ' + data[2]])
        item['authors'] = authors
        item['serialization'] = response.xpath(
            "string(//h2[text()='Information']/following-sibling::div[8]/a/text())").extract()
        relations = []
        for relation in response.xpath('//table[@class="anime_detail_related_anime"]/tr'):
            relationship = relation.xpath('td/text()').extract()[0]
            for related in relation.xpath('td/a/@href').extract():
                related = related.split('/')
                relations.extend([relationship + ' ' + related[1] + ' - ' + related[2]])
        item['related'] = relations
        item['mal_id'] = response.xpath('//*[@id="editdiv"]/form/input[1]/@value').extract()[0]
        item['image_url'] = response.xpath("//div[@style='text-align: center;']/a/img/@src").extract()
        yield item
