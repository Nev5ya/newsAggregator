<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class ParserController extends Controller
{
    /**
     * @param Resource $resource
     * @param string|null $hash
     * @return RedirectResponse
     * Parsing in manual mode by using link in admin panel
     */
    public function index(Resource $resource, string $hash = null): RedirectResponse
    {
        if ($resource->hash === $hash) {
            foreach ($resource->all() as $item) {
                NewsParsing::dispatch($item->link);
            }
        }

        return redirect()->route('news.index');
    }
}
