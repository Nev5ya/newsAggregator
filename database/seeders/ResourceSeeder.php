<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert($this->getResources());
    }

    public function getResources(): array
    {
        return [
            [
                'link' => 'https://lenta.ru/rss/news'
            ],
            [
                'link' => 'https://news.yandex.ru/auto.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/auto_racing.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/army.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/gadgets.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/index.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/martial_arts.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/communal.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/health.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/games.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/internet.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/cyber_sport.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/movies.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/cosmos.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/culture.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/championsleague.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/music.rss'
            ],
            [
                'link' => 'https://news.yandex.ru/nhl.rss'
            ],
        ];
    }
}
