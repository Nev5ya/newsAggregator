<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param News $news
     * @param Category $category
     * @return Renderable
     */
    public function index(News $news, Category $category): Renderable
    {
        return view('admin.news.index')
            ->with('newsList', $news->query()->paginate(5))
            ->with('categories', $category->all()->keyBy('id'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Category $category
     * @return Renderable|RedirectResponse
     */
    public function create(Category $category): Renderable|RedirectResponse
    {
        return view('admin.news.create')->with('categories', $category->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @param News $news
     * @return RedirectResponse
     */
    public function store(NewsRequest $request, News $news): RedirectResponse
    {
        $data = $request->validated();

        $news->fill($data);

        $request->file('image')
            ? $news->image = $news->handleImage(request()->file('image'))
            : $news->image = $news->pathToImage;

        $news->save();

        return redirect()
            ->route('news.show', ['id' => $news->id])
            ->with(['type' => 'success', 'message' => 'Новость добавлена!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @param Category $category
     * @return Renderable
     */
    public function edit(News $news, Category $category): Renderable
    {
        return view('admin.news.create')
            ->with('news', $news)
            ->with('categories', $category->all()->keyBy('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param News $news
     * @return RedirectResponse
     */
    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        $data = $request->validated();

        $news->fill($data);

        $request->file('image')
            ? $news->image = $news->handleImage(request()->file('image'))
            : $news->image = $news->pathToImage;

        $news->save();

        return redirect()
            ->route('news.show', ['id' => $news->id])
            ->with(['type' => 'success', 'message' => 'Новость изменена!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return RedirectResponse
     */
    public function destroy(News $news): RedirectResponse
    {
        $news->delete();
        return redirect()
            ->route('admin.news.index')
            ->with(['type' => 'success', 'message' => 'Новость удалена!']);
    }
}
