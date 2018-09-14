<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class checkAuth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (!\Session::has('UserInfo') || !Session::get('UserInfo') != null) {
            return redirect('/')->withErrors('These pages are accessible by authenticated users only');
        }

        return $next($request);
    }

}
