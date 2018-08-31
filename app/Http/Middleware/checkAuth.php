<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class checkAuth
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
        if(!\Session::has('UserInfo'))
        {
            return redirect('/')->withErrors('Middleware You are not signed in');
        }

        return $next($request);
    }
}
