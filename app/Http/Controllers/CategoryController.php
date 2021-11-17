<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function show(News $news, Category $category, string $categoryName): Factory|View|Application
    {
        return view('category.show', [
            'newsList' => $news->getNewsByCategory($categoryName),
            'currentCategory' => $category->getCategorySlug($categoryName)
        ]);
    }
}
