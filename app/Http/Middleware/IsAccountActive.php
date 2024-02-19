<?php

namespace App\Http\Middleware;

use Closure;

class IsAccountActive
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

        if ($request->user()->account_status == 'new') {
            return redirect('/new');
        }

        if ($request->user()->account_status == 'ban') {
            return redirect('/ban');
        }
        return $next($request);
    }
}
