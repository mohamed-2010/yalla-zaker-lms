<?php

namespace App\Http\Middleware;

use App\Enums\RolesEnum;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // return dd(Auth::guard($guard)->check());
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/dashboard/home');
        }

        if ($guard == "teacher" && Auth::guard($guard)->check()) {
            return redirect('/dashboard/home');
        }

        if ($guard == "student" && Auth::guard($guard)->check()) {
            return redirect('/student/home');
        }
        
        return $next($request);
    }
}

