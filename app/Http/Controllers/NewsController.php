<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('news.index', [
            'newsList' => (new News())->getNews()
        ]);
    }

    public function show(int $id): Factory|View|Application
    {
        return view('news.show', [
            'id' => $id
        ]);
    }
}
