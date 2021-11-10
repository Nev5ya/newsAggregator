<?php

namespace App\Models;

use Faker\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    //Тестовая генерация новостей
    public function getNews(): array
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        $newsCountNumber = mt_rand(4, 10);
        $category = (new Category())->getCategory();

        for ($i = 0; $i < $newsCountNumber; $i++) {
            $randCategory = rand(0, count($category) - 1);
            $data[] = [
                'id' => rand(0, 1000),
                'category_id' => $randCategory,
                'category_name' => $category[$randCategory]['slug'],
                'title' => $faker->jobTitle(),
                'description' => $faker->sentence(4),
                'author' => $faker->name(),
                'created_at' => date(now())
            ];
        }
        return $data;
    }

    public function getNewsByCategory(string $categoryName): array
    {
        $news = $this->getNews();

        $categoryId = (new Category())->getCategoryIdByName($categoryName);

        return array_filter($news , function ($item) use ($categoryId) {
            return $item['category_id'] === $categoryId;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
