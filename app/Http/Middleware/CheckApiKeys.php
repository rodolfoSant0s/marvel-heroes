<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiKeys
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (env('MARVEL_PUBLIC_KEY') == null || env('MARVEL_PRIVATE_KEY') == null || env('MARVEL_END_POINT') == null) {
            return response(['status' => 'error', 'msg' => 'Api key is required'], 401);
        }

        return $next($request);
    }
}
