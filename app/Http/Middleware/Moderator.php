<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class Moderator
{
    public function handle($request, Closure $next)
    {
        if (Auth::guest())
            return redirect('/home');
        if (!(Auth::user()->getAuthIdentifier() == 1))
            return redirect('/home');
        return $next($request);
    }
}