<?php

namespace App\Http\Middleware;

use App\Models\Restaurant;
use Closure;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;

class editRestaurant
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
        $id = $request->route()->parameter('restaurant');

        $restaurant = Restaurant::findOrFail($id);

        if (Auth::check()
            && (Auth::user()->id == $restaurant->id)
            || (Auth::user()->is_admin === 1)
        ) {
            return $next($request);
        }

        Flashy::error('Opération non autorisée');
        return redirect('/');
    }
}
