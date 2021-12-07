<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Contracts\Support\Renderable;

class NewsController extends Controller
{
    /**
     * Show news index page
     * @param News $news
     * @return Renderable
     */
    public function index(News $news): Renderable
    {
        return view('news.index')->with('newsList', $news->paginate(6));
    }

    /**
     * Show only one news page
     * @param News $news
     * @param int $id
     * @return Renderable
     */
    public function show(News $news, int $id): Renderable
    {
        return view('news.show')->with('news', $news->find($id));
    }
}
