<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;

class hasRights
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
        if(Auth::check()
            && (Auth::user()->id == $request->route()->parameter('user'))
            || (Auth::user()->is_admin === 1)) {
            return $next($request);
        }

        Flashy::error('Opération non autorisée');
        return redirect('/');
    }
}
