<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;


class OwnerMiddleware
{

    public function handle($request, Closure $next, $role){
        //!$request->user()->hasRole($role))
        if (Auth::guest()) {
            return redirect('/login'); // редирект куда угодно
        }
        return $next($request);
    }

}
