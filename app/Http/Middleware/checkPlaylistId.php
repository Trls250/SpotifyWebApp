<?php

namespace App\Http\Middleware;

use Closure;
use App\Playlist;

class checkPlaylistId
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

        if(!Playlist::where('id', '=', $request->id)->exists())
        {
            return redirect('/')->withErrors("This playlist is not in our system, please add it using Add Playlist using Spotify URI first");
        }


        return $next($request);
    }
}
