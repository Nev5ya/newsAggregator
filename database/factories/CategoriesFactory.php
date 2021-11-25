<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class CategoriesFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(
        [
            'category' => "string",
            'slug' => "string"
        ]
    )]

    public function definition(): array
    {
        return [
            'category' => 'sport',
            'slug' => 'Спорт'
        ];
    }
}
