<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getNews());
    }

    public function getNews(): array
    {
        $faker = Factory::create('ru_RU');
        $data = [];

        for ($i = 0; $i < 24; $i++) {
            $categoryIndex = rand(1, Category::all()->count());
            $data[] = [
                'category_id' => $categoryIndex,
                'title' => $faker->realText(rand(10, 15)),
                'description' => $faker->realText(rand(150, 300)),
                'link' => $faker->name(),
                'created_at' => date(now())
            ];
        }
        return $data;
    }
}
