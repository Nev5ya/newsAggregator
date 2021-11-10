<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    /**
     * @param Category $category
     * @return Factory|View|Application
     */
    public function index(Category $category): Factory|View|Application
    {
        return view('admin.download.index', [
            'categories' => $category->getCategory()
        ]);
    }

    /**
     * @param Request $request
     * @param News $news
     * @return BinaryFileResponse
     */
    public function download(Request $request, News $news): BinaryFileResponse
    {
        $params = $request->except('_token');

        if ($params['category'] === 'all') {
            return response()->download(storage_path() . '/app/public/newsJSON/news.json');
        } else {
            $filePath = $news->createNewsForDownload($params['category']);
            return response()->download($filePath)->deleteFileAfterSend();
        }
    }
}
