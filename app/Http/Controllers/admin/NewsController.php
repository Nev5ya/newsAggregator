<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param News $news
     * @param Category $category
     * @return Application|Factory|View
     */
    public function index(News $news, Category $category): View|Factory|Application
    {
        return view('admin.news.index', [
            'newsList' => $news->getNews(),
            'category' => $category->getCategory()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(Category $category): Application|Factory|View|RedirectResponse
    {
        return view('admin.news.create', [
            'categories' => $category->getCategory()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param News $news
     * @return RedirectResponse
     */
    public function store(Request $request, News $news): RedirectResponse
    {
        //тестовая валидация
        $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'author' => ['required', 'string', 'min:4'],
            'description' => ['required', 'string']
        ]);

        $data = request()->except('_token');

        $id = $news->createNews($data);
        return redirect()->route('news.show', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
