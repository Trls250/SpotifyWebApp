<?php

namespace App\Http\Controllers\data;

use App\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function getSearchResults(Request $request)
    {

        if(isset($request->queryString) && $request->queryString != '')
            return view('search')->with([
                'Success'  => true,
                'Playlists'=> Playlist::searchLike($request->queryString, 0, 4) ,
                'queryString' => $request->queryString
            ]);
        else
            return view('errors.custom')->withErrors("Search query empty, can not match any records with empty query.");

    }
}
