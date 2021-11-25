<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
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
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('admin.news.index')
            ->with('newsList', News::all())
            ->with('categories', Category::all()->keyBy('id'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(): Application|Factory|View|RedirectResponse
    {
        return view('admin.news.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
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
     * @param News $news
     * @return Application|Factory|View
     */
    public function edit(News $news): View|Factory|Application
    {
        return view('admin.news.create')
            ->with('news', $news)
            ->with('categories', Category::all()->keyBy('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $news
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
