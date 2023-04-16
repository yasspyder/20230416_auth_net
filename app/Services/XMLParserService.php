<?php

namespace App\Services;

use Orchestra\Parser\Xml\Facade as XmlParser;

class XMLParserService
{
       public function getParse($parse_link): array
    {
        $xml = XmlParser::load($parse_link);
            $data = $xml->parse([
                'title' => [
                    'uses' => 'channel.title'
                ],
                'description' => [
                    'uses' => 'channel.description'
                ],
                'link' => [
                    'uses' => 'channel.link'
                ],
                'image' => [
                    'uses' => 'channel.image.url'
                ],
                'news' => [
                    'uses' => 'channel.item[guid,author,title,link,description,pubDate,category]'
                ]
            ]);
            return $data;
    }
}
