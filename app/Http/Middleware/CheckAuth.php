<?php

namespace App\Http\Middleware;

use App\Objects;
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
            // $allMenu = Objects::with('childMenu')->get();
            // $menulist = $allMenu[0]->childMenu;
            if (!$request->session()->exists('menu')) {
                $request->session()->put('menu', $user->accessMenu());
                $request->session()->regenerate();
            }
            return $next($request);
        } else {
            return redirect()->to("/login");
        }
    }
}
