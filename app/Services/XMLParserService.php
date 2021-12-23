<?php

namespace App\Services;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XMLParser;

class XMLParserService
{
    public function handle($link)
    {
        $xml = XMLParser::load($link);
        $data = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'news' => [
                'uses' => 'channel.item[title,link,description,pubDate,enclosure::url,category,link]'
            ]
        ]);

        foreach ($data['news'] as $news) {

            if (!$news['category']) {
                $news['slug'] = $data['title'];
                $news['category'] = Str::slug($data['title']);
                $news['image'] = (new News())->pathToImage;
            } else {
                $news['slug'] = $news['category'];
                $news['category'] = Str::slug($news['category']);
                $news['image'] = $news['enclosure::url'];
            }

            $category = (new Category())
                ->query()
                ->firstOrCreate(['category' => $news['category'], 'slug' => $news['slug']]);


            $news['created_at'] = date('Y-m-d H:i:s', strtotime($news['pubDate']));
            $news['category_id'] = $category['id'];

            unset($news['enclosure::url']);
            unset($news['pubDate']);
            unset($news['category']);
            unset($news['slug']);

            //check is unique by link
            News::query()->firstOrCreate(['link' => $news['link']],[
                'title' => $news['title'],
                'description' => $news['description'],
                'image' => $news['image'],
                'created_at' => $news['created_at'],
                'link' => $news['link'],
                'category_id' => $category['id']
            ]);
        }
    }
}
