<?php

namespace App\Http\Controllers\data;

use App\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function getSearchResults(Request $request)
    {

        $start = $request->start;
        $limit = $request->limit;
        
        if(!isset($start))
        {
            $start = 0;
        }

        if(!isset($limit))
        {
            $limit = 100;
        }
        
        if(isset($request->queryString) && $request->queryString != '')
        {
            $temp = Playlist::searchLike($request->queryString, $start, $limit);

            return view('search')->with([
                'Success'  => true,
                'Playlists'=> $temp['Playlists'],
                'Total' => $temp['Total'],
                'queryString' => $request->queryString
            ]);
        }
        else 
        {

            $temp = Playlist::searchLike(null, $start, $limit);

            return view('search')->with([
                'Success'  => true,
                'Playlists'=> $temp['Playlists'],
                'Total' => $temp['Total'],
                'queryString' => $request->queryString
            ]);
        }
     

    }



    public function getSearchResultsSimple(Request $request)
    {

        $start = $request->start;
        $limit = $request->limit;
        
        if(!isset($start))
        {
            $start = 0;
        }

        if(!isset($limit))
        {
            $limit = 100;
        }
        
        if(isset($request->queryString) && $request->queryString != '')
        {
            $temp = Playlist::searchLike($request->queryString, $start, $limit);

            return view('loaders.search')->with([
                'Success'  => true,
                'Playlists'=> $temp['Playlists'],
                'Total' => $temp['Total'],
                'queryString' => $request->queryString
            ]);
        }
        else 
        {

            $temp = Playlist::searchLike(null, $start, $limit);

            return view('loaders.search')->with([
                'Success'  => true,
                'Playlists'=> $temp['Playlists'],
                'Total' => $temp['Total'],
                'queryString' => $request->queryString
            ]);
        }
     

    }
}
