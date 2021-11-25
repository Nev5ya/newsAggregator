<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function show(News $news, string $categoryName): Factory|View|Application
    {
        $currentCategory = $news->getCurrentCategoryByName($categoryName);
        return view('category.show', [
            'newsList' => $currentCategory->news,
            'currentCategory' => $currentCategory->slug
        ]);
    }
}
