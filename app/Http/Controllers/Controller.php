<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    //Тестовая генерация новостей
    protected function getNews(): array
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        $newsCountNumber = mt_rand(2, 5);
        $category = new Category();
        for ($i = 0; $i < count($category->getCategories()); $i++) {
            for ($k = 0; $k < $newsCountNumber; $k++) {
                $data[$category->getCategories()[$i]][$k] = [
                    'id' => rand(0, 1000),
                    'category_id' => $i,
                    'title' => $faker->jobTitle(),
                    'description' => $faker->sentence(4),
                    'author' => $faker->name(),
                    'created_at' => date(now())
                ];
            }
        }
        return $data;
    }

    protected function getNewsByCategory(string $category): array
    {
        return $this->getNews()[$category];
    }
}
