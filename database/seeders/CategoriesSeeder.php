<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getCategories());
    }

    public function getCategories(): array
    {
            return [
            [
                'category' => 'sport',
                'slug' => 'Спорт',
                'created_at' => date(now())
            ],
            [
                'category' => 'economy',
                'slug' => 'Экономика',
                'created_at' => date(now())
            ],
            [
                'category' => 'science',
                'slug' => 'Наука',
                'created_at' => date(now())
            ],
            [
                'category' => 'politics',
                'slug' => 'Политика',
                'created_at' => date(now())
            ],
            [
                'category' => 'culture',
                'slug' => 'Культура',
                'created_at' => date(now())
            ]
        ];
    }
}
