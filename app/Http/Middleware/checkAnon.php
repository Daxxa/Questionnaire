<?php

namespace App\Http\Middleware;

use Closure;

class checkAnon
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if ($request->has('poll_id'))
//        dd($request->get('poll_id'));
        return $next($request);
    }
}
