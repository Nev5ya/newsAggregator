<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        User::factory(5)->create();
        $this->call(CategoriesSeeder::class);
        News::factory(10)->create();


//        Category::factory()->create();
//        $this->call(NewsSeeder::class);
    }
}
