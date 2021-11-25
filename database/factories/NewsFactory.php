<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class NewsFactory extends Factory
{
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(
        [
            'category_id' => "int",
            'title' => "string",
            'description' => "string",
            'author' => "string",
            'created_at' => "string"
        ]
    )]

    public function definition(): array
    {
        $categoryIndex = rand(1, Category::all()->count());
        return [
            'category_id' => $categoryIndex,
            'title' => $this->faker->realText(rand(10, 15)),
            'description' => $this->faker->realText(rand(150, 300)),
            'author' => $this->faker->name(),
            'created_at' => date(now())
        ];
    }
}
