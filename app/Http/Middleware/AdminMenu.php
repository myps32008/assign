<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;
use Illuminate\Support\Facades\Route;

class AdminMenu
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
        if (Auth::user()->username == "administrator") {
            return $next($request);
        }
        $route = Route::current()->getName();        
        $accessMenu = $request->session()->get('menu');
        if ($accessMenu->contains('object_name', $route)) {
            return $next($request);
        }
        return redirect()->to('/UnAuthenticate');
    }
}
