<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRights
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->user()->is_admin || (int)substr($request->path(), -1) === $request->user()->id) {
            return $next($request);
        }
        return redirect()->route('news.index');
    }
}
