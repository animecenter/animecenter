# -*- coding: utf-8 -*-
import scrapy
from myanimelist.items import Character


class CharacterSpider(scrapy.Spider):
    name = 'character'
    allowed_domains = ['myanimelist.net']
    start_urls = [
        'http://myanimelist.net/character.php?letter=#',
        'http://myanimelist.net/character.php?letter=A',
        'http://myanimelist.net/character.php?letter=B',
        'http://myanimelist.net/character.php?letter=C',
        'http://myanimelist.net/character.php?letter=D',
        'http://myanimelist.net/character.php?letter=E',
        'http://myanimelist.net/character.php?letter=F',
        'http://myanimelist.net/character.php?letter=G',
        'http://myanimelist.net/character.php?letter=H',
        'http://myanimelist.net/character.php?letter=I',
        'http://myanimelist.net/character.php?letter=J',
        'http://myanimelist.net/character.php?letter=K',
        'http://myanimelist.net/character.php?letter=L',
        'http://myanimelist.net/character.php?letter=M',
        'http://myanimelist.net/character.php?letter=N',
        'http://myanimelist.net/character.php?letter=O',
        'http://myanimelist.net/character.php?letter=P',
        'http://myanimelist.net/character.php?letter=Q',
        'http://myanimelist.net/character.php?letter=R',
        'http://myanimelist.net/character.php?letter=S',
        'http://myanimelist.net/character.php?letter=T',
        'http://myanimelist.net/character.php?letter=U',
        'http://myanimelist.net/character.php?letter=V',
        'http://myanimelist.net/character.php?letter=W',
        'http://myanimelist.net/character.php?letter=X',
        'http://myanimelist.net/character.php?letter=Y',
        'http://myanimelist.net/character.php?letter=Z'
    ]

    def parse(self, response):
        for link in response.xpath("//div[@class='picSurround']/a/@href").extract():
            yield scrapy.Request('http://myanimelist.net' + link, callback=self.parse_character)

    @staticmethod
    def parse_character(response):
        item = Character()
        name = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/text()').extract()[0]
        item['alias'] = response.xpath("//h1/text()").extract()[0].replace('   ', ' ').replace('  ', ' ').strip()
        item['japanese'] = japanese = response.xpath(
            '//*[@id="content"]/table/tr/td[2]/div[2]/span/small/text()').extract()
        item['synopsis'] = ''.join(response.xpath(
            '//*[@id="content"]/table/tr/td[2]/descendant-or-self::text()').extract()).split(
            'Voice Actors', 1)[0].split('\n\t\t\t\t\n\t\t\n\t  ', 1)[1].replace(name + japanese[0], '')
        item['name'] = name.replace('  ', ' ').strip()
        voices = response.xpath(
            '//*[@id="content"]/table/tr/td[2]/table/tr/td[2]/div/small/text() | //*[@id="content"]/table/tr/td[2]/table/tr/td[2]/a/text()'
        ).extract()
        item['voices'] = '---div---'.join([i + ' language = ' + j for i, j in zip(voices[::2], voices[1::2])])
        animes = response.xpath(
            '//*[@id="content"]/table/tr/td[1]/table[1]/tr/td[2]/a/text() | //*[@id="content"]/table/tr/td[1]/table[1]/tr/td[2]/div/small/text()'
        ).extract()
        item['animes'] = '---div---'.join([i + ' personaje = ' + j for i, j in zip(animes[::2], animes[1::2])])
        mangas = response.xpath(
            '//*[@id="content"]/table/tr/td[1]/table[2]/tr/td[2]/a/text() | //*[@id="content"]/table/tr/td[1]/table[2]/tr/td[2]/div/small/text()'
        ).extract()
        item['mangas'] = '---div---'.join([i + ' personaje = ' + j for i, j in zip(mangas[::2], mangas[1::2])])
        item['mal_id'] = response.xpath('//*[@id="horiznav_nav"]/ul/li[1]/a/@href').extract()[0].replace(
            '/character/', '').split('/')[0]
        item['image_url'] = response.xpath("//div[@style='text-align: center;']/img/@src").extract()[0].replace(
            'http://cdn.myanimelist.net/images/na.gif', '')
        yield item
