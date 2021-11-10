<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    //тестовые категории
    protected array $category = [
        [
            'id' => 0,
            'category' => 'sport',
            'slug' => 'Спорт'
        ],
        [
            'id' => 1,
            'category' => 'economy',
            'slug' => 'Экономика'
        ],
        [
            'id' => 2,
            'category' => 'science',
            'slug' => 'Наука'
        ],
        [
            'id' => 3,
            'category' => 'politics',
            'slug' => 'Политика'
        ],
        [
            'id' => 4,
            'category' => 'culture',
            'slug' => 'Культура'
        ]
    ];

    public function getCategory(): array
    {
        return $this->category;
    }

    public function getCategorySlug(string $categoryName)
    {
        foreach ($this->category as $item) {
            if ($item['category'] === $categoryName)
                return $item['slug'];
        }
    }

    public function getCategoryIdByName(string $name): int|string|null
    {
        $categories = (new Category())->getCategory();
        return key(array_filter($categories, function ($item) use ($name) {
            return $item['category'] === $name;
        }, ARRAY_FILTER_USE_BOTH));
    }
}
