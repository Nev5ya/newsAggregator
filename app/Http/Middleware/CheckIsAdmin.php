<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsAdmin
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
        if (!auth()->user()?->is_admin) {
            return redirect()->route('news.index')->with(['type' => 'danger', 'message' => 'Ты не админ!']);
        }
        return $next($request);
    }
}
