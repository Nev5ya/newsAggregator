<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert($this->getCategories());
    }

    public function getCategories(): array
    {
            return [
            [
                'category' => 'sport',
                'slug' => 'Спорт'
            ],
            [
                'category' => 'economy',
                'slug' => 'Экономика'
            ],
            [
                'category' => 'science',
                'slug' => 'Наука'
            ],
            [
                'category' => 'politics',
                'slug' => 'Политика'
            ],
            [
                'category' => 'culture',
                'slug' => 'Культура'
            ]
        ];
    }
}
