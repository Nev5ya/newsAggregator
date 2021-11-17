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
        $category = (new Category())->getCategory();
        $data = [];

        for ($i = 0; $i < 24; $i++) {
            $categoryIndex = rand(0, count($category) - 1);
            $data[] = [
                'category_id' => $categoryIndex + 1,
                'category_name' => $category[$categoryIndex]->category,
                'title' => $faker->realText(rand(10, 15)),
                'description' => $faker->realText(rand(150, 300)),
                'author' => $faker->name(),
                'created_at' => date(now())
            ];
        }
        return $data;
    }
}
