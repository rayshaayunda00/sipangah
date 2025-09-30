<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotRegistered
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Simpan URL tujuan agar setelah register/login diarahkan ke sini
            $request->session()->put('url.intended', $request->url());
            return redirect()->route('register');
        }

        return $next($request);
    }
}
