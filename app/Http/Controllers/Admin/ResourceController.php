<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Models\Resource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ResourceController extends Controller
{
    public function index(Resource $resource): Factory|View|Application
    {
        return view('admin.resource.index')->with([
            'resources' => $resource->query()->paginate(9)
        ]);
    }

    public function create(): Renderable
    {
        return view('admin.resource.create');
    }

    public function store(ResourceRequest $request, Resource $resource): RedirectResponse
    {
        $data = $request->validated();

        $resource->fill($data);
        $resource->save();

        return redirect()
            ->route('admin.resource.index')
            ->with(['type' => 'success', 'message' => 'Ссылка добавлена!']);
    }

    /**
     * Remove the specified resource
     * @param Resource $resource
     * @return RedirectResponse
     */
    public function destroy(Resource $resource): RedirectResponse
    {
        $resource->delete();
        return redirect()
            ->route('admin.resource.index')
            ->with(['type' => 'success', 'message' => 'Ресурс удалён!']);
    }
}
