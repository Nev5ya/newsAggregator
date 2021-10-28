<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('news.index', [
            'newsList' => $this->getNews(),
            'categories' => (new Category())->getCategories()
        ]);
    }

    public function show(int $id): Factory|View|Application
    {
        return view('news.show', [
            'id' => $id
        ]);
    }
}