<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @return Renderable
     */
    public function index(Category $category): Renderable
    {
        return view('admin.category.index', [
            'categories' => $category->query()->paginate(9)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        $data['category'] = strtolower($data['category']);

        $category->fill($data);

        $category->save();

        return redirect()
            ->route('admin.category.index')
            ->with(['type' => 'success', 'message' => 'Категория добавлена!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Renderable
     */
    public function edit(Category $category): Renderable
    {
        return view('admin.category.create')
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        $category->fill($data);

        $category->save();

        return redirect()
            ->route('admin.category.index')
            ->with(['type' => 'success', 'message' => 'Категория изменена!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Request $request, Category $category): RedirectResponse
    {
        if (is_null($request->get('allDelete'))) {
            if(!empty($category->news()->get()->all())) {
                return redirect()
                    ->route('admin.category.index')
                    ->with(['type' => 'danger', 'message' => 'Категория содержит новости!']);
            }
        }
        $category->delete();
        return redirect()
            ->route('admin.category.index')
            ->with(['type' => 'success', 'message' => 'Категория и все новости удалены!']);
    }
}
