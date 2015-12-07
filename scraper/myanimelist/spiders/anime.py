# -*- coding: utf-8 -*-
import scrapy
import re
from myanimelist.items import Anime


class AnimeSpider(scrapy.Spider):
    name = 'anime'
    allowed_domains = ['myanimelist.net']
    start_urls = [
        'http://myanimelist.net/anime.php?letter=.',
        'http://myanimelist.net/anime.php?letter=A',
        'http://myanimelist.net/anime.php?letter=B',
        'http://myanimelist.net/anime.php?letter=C',
        'http://myanimelist.net/anime.php?letter=D',
        'http://myanimelist.net/anime.php?letter=E',
        'http://myanimelist.net/anime.php?letter=F',
        'http://myanimelist.net/anime.php?letter=G',
        'http://myanimelist.net/anime.php?letter=H',
        'http://myanimelist.net/anime.php?letter=I',
        'http://myanimelist.net/anime.php?letter=J',
        'http://myanimelist.net/anime.php?letter=K',
        'http://myanimelist.net/anime.php?letter=L',
        'http://myanimelist.net/anime.php?letter=M',
        'http://myanimelist.net/anime.php?letter=N',
        'http://myanimelist.net/anime.php?letter=O',
        'http://myanimelist.net/anime.php?letter=P',
        'http://myanimelist.net/anime.php?letter=Q',
        'http://myanimelist.net/anime.php?letter=R',
        'http://myanimelist.net/anime.php?letter=S',
        'http://myanimelist.net/anime.php?letter=T',
        'http://myanimelist.net/anime.php?letter=U',
        'http://myanimelist.net/anime.php?letter=V',
        'http://myanimelist.net/anime.php?letter=W',
        'http://myanimelist.net/anime.php?letter=X',
        'http://myanimelist.net/anime.php?letter=Y',
        'http://myanimelist.net/anime.php?letter=Z'
    ]

    def parse(self, response):
        link = response.xpath('(//*[@id="content"]/div[@class="borderClass"])[1]/div/span/a[last()]/@href').extract()
        if "show" not in response.url and link:
            pages_number = int(link[0].split('&show=')[1]) / 50 + 1
            for x in range(0, pages_number):
                yield scrapy.Request(response.url + '&show=' + str(x * 50), callback=self.parse)
        else:
            for link in response.xpath('//div[@class="picSurround"]/a/@href').extract():
                yield scrapy.Request('http://myanimelist.net' + link, callback=self.parse_anime)

    @staticmethod
    def parse_anime(response):
        item = Anime()
        item['title'] = response.xpath('//h1/span/text()').extract()[0]
        item['synopsis'] = re.sub(r'\([^)]*\)', '', response.xpath(
            'string(//h2[text()="Synopsis"]/..)').extract()[0].replace('EditSynopsis', '').replace(
            '\n\n', '\n')).split('EditBackground')[0]
        item['alternative_titles'] = '---div---'.join([x for x in response.xpath(
            '//div[preceding-sibling::h2="Alternative Titles" and following-sibling::h2="Information"]//text()'
        ).extract() if '\n    ' not in x]).replace('---div--- ', '---union---').replace('\n  ', '')
        item['type'] = response.xpath('//span[text()="Type:"]/../text()').extract()[1].strip()
        item['number_of_episodes'] = response.xpath('//span[text()="Episodes:"]/../text()').extract()[1].strip()
        item['status'] = response.xpath('//span[text()="Status:"]/../text()').extract()[1].strip()
        item['dates'] = response.xpath('//span[text()="Aired:"]/../text()').extract()[1].strip().replace('  ', ' ')
        item['producers'] = [response.xpath('//span[text()="Producers:"]/../a/text()').extract()[0].replace(
            'add some', ''
        )]
        item['genres'] = response.xpath('//span[text()="Genres:"]/../a/text()').extract()
        item['duration'] = response.xpath('//span[text()="Duration:"]/../text()').extract()[1].strip()
        item['classification'] = response.xpath('//span[text()="Rating:"]/../text()').extract()[1].strip()
        relations = []
        for relation in response.xpath('//table[@class="anime_detail_related_anime"]/tr'):
            relationship = relation.xpath('td/text()').extract()[0]
            for related in relation.xpath('td/a/@href').extract():
                related = related.split('/')
                relations.extend([relationship + ' ' + related[1] + ' - ' + related[2]])
        item['related'] = relations
        item['mal_id'] = response.xpath('//*[@id="editdiv"]/form/input[1]/@value').extract()[0]
        item['opening'] = '---div---'.join([x for x in response.xpath(
            '//text()[preceding-sibling::h2[text()="Opening Theme"] and following-sibling::h2[text()="Ending Theme"]]'
        ).extract() + response.xpath('//div[@id="opTheme"]/text()').extract() if "<br>" not in x and '\n\t' not in x])
        item['ending'] = '---div---'.join(response.xpath(
            '//text()[preceding-sibling::h2[text()="Ending Theme"] and following-sibling::br[6]]'
        ).extract() + response.xpath('//div[@id="edTheme"]/text()').extract())
        image_url = response.xpath('//div[@style="text-align: center;"]/a/img/@src').extract()
        item['image_url'] = image_url if image_url else \
            response.xpath('//*[@id="content"]/table/tr/td[1]/div[1]/img/@src').extract()
        yield item
