<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //тестовые категории
    protected array $categories = ['Спорт', 'Экономика', 'Наука', 'Политика', 'Культура'];

    public function getCategories(): array
    {
        return $this->categories;
    }
}
