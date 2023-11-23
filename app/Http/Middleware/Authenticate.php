<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');
         if(!$request->expectsJson()){
            if($request->route()->middleware('auth', 'verified')){
                session()->flash("fail", "Kamu harus login dulu");
                return route('login', ['fail'=>true, 'returnUrl'=>URL::current()]);
            }
        }
    }
}
