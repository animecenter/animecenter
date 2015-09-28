# -*- coding: utf-8 -*-
"""A downloader middleware to force utf8 encoding for all responses."""

class ForceUTF8Response(object):

    def process_response(self, request, response, spider):
        ubody = response.body_as_unicode().encode('utf8')
        return response.replace(body=ubody, encoding='utf8')
