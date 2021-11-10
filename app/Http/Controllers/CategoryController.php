<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function show(string $category): Factory|View|Application
    {
        return view('category.show', [
            'newsList' => (new News())->getNewsByCategory($category),
            'currentCategory' => (new Category)->getCategorySlug($category)
        ]);
    }
}
