<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    /**
     * @param News $news
     * @return Factory|View|Application
     */
    public function index(News $news): Factory|View|Application
    {
        return view('news.index', [
            'newsList' => $news->getNews()
        ]);
    }

    /**
     * @param News $news
     * @param int $id
     * @return Factory|View|Application
     */
    public function show(News $news, int $id): Factory|View|Application
    {
        return view('news.show', [
            'news' => $news->getNewsById($id)
        ]);
    }
}
