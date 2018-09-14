<?php

namespace App\Http\Controllers\data;

use App\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function getSearchResults(Request $request)
    {
        if(isset($request->queryString))
            return view('search')->with([
                'Success'=>true,
                'Playlists'=> Playlist::searchLike($request->queryString, 0, 4)] );
        else
            return view('search')->withErrors("Search query empty, can not match any records with empty query.");

    }
}
