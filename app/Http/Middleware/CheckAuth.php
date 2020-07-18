<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Auth;

class CheckAuth
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
        // neu nguoi dung da login 
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $request->session()->put('menu', $user->accessMenu());
            $request->session()->regenerate();
            return $next($request);
        } else {
            return redirect()->to("/login");
        }
    }
}
