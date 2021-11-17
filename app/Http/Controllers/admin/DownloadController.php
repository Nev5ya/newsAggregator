<?php

namespace App\Http\Controllers\admin;

use App\Exports\NewsExports;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel as FacadeExcel;
use Maatwebsite\Excel\Excel;
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
        $data = $news->getNewsForDownload($params['category']);

        if ($params['format'] === 'json') {
            $path = storage_path() . $news->pathToTemp . $params['category'] . '.json';

            File::put($path, json_encode(
                $data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
            ));

            return response()->download($path)->deleteFileAfterSend();
        }

        $export = new NewsExports($data);
        return FacadeExcel::download($export, $params['category'] . '.xlsx', Excel::XLSX);
    }
}
