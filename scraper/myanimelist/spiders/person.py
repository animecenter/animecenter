# -*- coding: utf-8 -*-
import scrapy
from myanimelist.items import Person


class PersonSpider(scrapy.Spider):
    name = 'person'
    allowed_domains = ['myanimelist.net']
    start_urls = [
        'http://myanimelist.net/people.php?letter=.',
        'http://myanimelist.net/people.php?letter=A',
        'http://myanimelist.net/people.php?letter=B',
        'http://myanimelist.net/people.php?letter=C',
        'http://myanimelist.net/people.php?letter=D',
        'http://myanimelist.net/people.php?letter=E',
        'http://myanimelist.net/people.php?letter=F',
        'http://myanimelist.net/people.php?letter=G',
        'http://myanimelist.net/people.php?letter=H',
        'http://myanimelist.net/people.php?letter=I',
        'http://myanimelist.net/people.php?letter=J',
        'http://myanimelist.net/people.php?letter=K',
        'http://myanimelist.net/people.php?letter=L',
        'http://myanimelist.net/people.php?letter=M',
        'http://myanimelist.net/people.php?letter=N',
        'http://myanimelist.net/people.php?letter=O',
        'http://myanimelist.net/people.php?letter=P',
        'http://myanimelist.net/people.php?letter=Q',
        'http://myanimelist.net/people.php?letter=R',
        'http://myanimelist.net/people.php?letter=S',
        'http://myanimelist.net/people.php?letter=T',
        'http://myanimelist.net/people.php?letter=U',
        'http://myanimelist.net/people.php?letter=V',
        'http://myanimelist.net/people.php?letter=W',
        'http://myanimelist.net/people.php?letter=X',
        'http://myanimelist.net/people.php?letter=Y',
        'http://myanimelist.net/people.php?letter=Z'
    ]

    def parse(self, response):
        for link in response.xpath("//div[@class='picSurround']/a/@href").extract():
            yield scrapy.Request('http://myanimelist.net' + link, callback=self.parse_person)

    @staticmethod
    def parse_person(response):
        item = Person()
        voices = []
        staffs = []
        mangas = []
        if 'add roles here' not in response.xpath('//*[@id="content"]/table/tr/td[2]/a/text()').extract():
            for sel in response.xpath('//*[@id="content"]/table/tr/td[2]/table[1]/tr'):
                a = sel.xpath('td[3]/a/text()').extract()[0].split(', ')
                if len(a) == 2:
                    voice = sel.xpath('td[2]/a/text()').extract()[0] + '---actor---' + a[0] + ' ' + a[1] + '---role---' \
                        + sel.xpath('td[3]/div/text()').extract()[0].strip()
                else:
                    voice = sel.xpath('td[2]/a/text()').extract()[0] + '---actor---' + a[0] + '---role---' + sel.xpath(
                        'td[3]/div/text()').extract()[0].strip()
                voices.append(voice)
        if 'Add anime work' not in response.xpath('//*[@id="content"]/table/tr/td[2]/a/text()').extract():
            if 'add roles here' in response.xpath('//*[@id="content"]/table/tr/td[2]/a/text()').extract():
                for sel in response.xpath('//*[@id="content"]/table/tr/td[2]/table[1]/tr/td[2]'):
                    staff = sel.xpath('a/text()').extract()[0] + '---role---' + sel.xpath(
                        'div/small/text()').extract()[0]
                    staffs.append(staff)
            else:
                for sel in response.xpath('//*[@id="content"]/table/tr/td[2]/table[2]/tr/td[2]'):
                    staff = sel.xpath('a/text()').extract()[0] + '---role---' + sel.xpath(
                        'div/small/text()').extract()[0]
                    staffs.append(staff)
        if 'Add published work' not in response.xpath('//*[@id="content"]/table/tr/td[2]/a/text()').extract():
            if 'add roles here' in response.xpath('//*[@id="content"]/table/tr/td[2]/a/text()').extract() and \
                    'Add anime work' in response.xpath('//*[@id="content"]/table/tr/td[2]/a/text()').extract():
                for sel in response.xpath('//*[@id="content"]/table/tr/td[2]/table[1]/tr/td[2]'):
                    manga = sel.xpath('a/text()').extract()[0] + '---role---' + sel.xpath(
                        'div/small/text()').extract()[0]
                    mangas.append(manga)
            elif 'add roles here' in response.xpath('//*[@id="content"]/table/tr/td[2]/a/text()').extract() or \
                    'Add anime work' in response.xpath('//*[@id="content"]/table/tr/td[2]/a/text()').extract():
                for sel in response.xpath('//*[@id="content"]/table/tr/td[2]/table[2]/tr/td[2]'):
                    manga = sel.xpath('a/text()').extract()[0] + '---role---' + sel.xpath(
                        'div/small/text()').extract()[0]
                    mangas.append(manga)
            else:
                for sel in response.xpath('//*[@id="content"]/table/tr/td[2]/table[3]/tr/td[2]'):
                    manga = sel.xpath('a/text()').extract()[0] + '---role---' + sel.xpath(
                        'div/small/text()').extract()[0]
                    mangas.append(manga)
        item['voices'] = ['---div---'.join(voices)]
        item['staffs'] = ['---div---'.join(staffs)]
        item['mangas'] = ['---div---'.join(mangas)]
        item['name'] = response.xpath('//h1/text()').extract()[0]
        item['mal_id'] = response.xpath('//*[@id="profileRows"]/a[2]/@href').extract()[0].replace(
            "/dbchanges.php?go=voiceactor&do=editva&id=", '')
        if 'Birthday:' not in response.xpath('//*[@id="content"]/table/tr/td[1]/div[4]/span/text()').extract():
            item['given'] = response.xpath('//*[@id="content"]/table/tr/td[1]/div[4]/text()').extract()
            item['family'] = response.xpath(
                '//*[@id="content"]/table/tr/td[1]/span[1]/following-sibling::text()[1]').extract()
            birthday = response.xpath('//*[@id="content"]/table/tr/td[1]/div[5]/text()').extract()
            if birthday:
                item['birthday'] = birthday[0].strip().replace('  ', ' ')
            else:
                item['birthday'] = ''
            item['website'] = response.xpath('//*[@id="content"]/table/tr/td[1]/a[1]/@href').extract()
            item['more'] = [x.replace('\n\t         \n\t\t', '') for x in response.xpath(
                '//*[@id="content"]/table/tr/td[1]/descendant-or-self::node()[preceding-sibling::div[7]]'
            ).extract() if '\n\t\t\t' not in x]
        else:
            item['birthday'] = response.xpath('//*[@id="content"]/table/tr/td[1]/div[4]/text()').extract()
            item['website'] = response.xpath('//*[@id="content"]/table/tr/td[1]/a[1]/@href').extract()
            item['more'] = [x.replace('\n\t         \n\t\t', '') for x in response.xpath(
                '//*[@id="content"]/table/tr/td[1]/descendant-or-self::node()[preceding-sibling::div[6]]'
            ).extract() if '\n\t\t\t' not in x]
        item['image'] = response.xpath("//div[@style='text-align: center; style=']/a/img/@src").extract() + \
            response.xpath("//div[@style='text-align: center; style=']/img/@src").extract()
        yield item
