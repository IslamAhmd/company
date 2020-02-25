<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if((Auth::user()->isAdmin() || Auth::user()->isSupervisor()) && Str::contains($request->url(), 'admin')){
                return redirect(route('admin.index'));
            }
            return redirect('/');
        }

        return $next($request);
    }
}
