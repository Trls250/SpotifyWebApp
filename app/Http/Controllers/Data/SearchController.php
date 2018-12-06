<?php

namespace App\Http\Controllers\data;

use App\Playlist;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function getStats(Request $request){
        
        

//        $playlists = Playlist::orderBy('created_at', 'DESC')->take(10)->get();
//        $playlistsTop = Playlist::orderBy('rating', 'DESC')->take(10)->get();
        //$users = User::orderBy('followers', 'DESC')->take(10)->get(); 
        $sql = "select A.name as Users, A.followers as Followers, round(SUM( B.rating )/count(B.rating)) as AvgPlaylistRating, A.name as UsersPlaylists from users A inner join playlists B on A.id = B.added_by group by A.id  ";
        $users = DB::select($sql);

        return [
            //'Title' => 'Statistics',
            
            'data' => $users 
//            'PlaylistsNew' => $playlists,
//            'PlaylistsTop' => $playlistsTop
        ];

    }
    public function getStatsPlaylists(Request $request){
        
       
        //$users = User::orderBy('followers', 'DESC')->take(10)->get(); 
        $sql = "select title as Name, popularity as Popularity, danceability as Danceability, energy as Energy, valence as Valence, instrumentalness as Instrumentalness, liveness as Liveness, loudness as Loudness, speechiness as Speechiness, tempo as BPM, acousticness as Acousticness, average_release_year as `Average Release Year` from playlists order by updated_at desc limit 10 ";
        $users = DB::select($sql);

        return [
            //'Title' => 'Statistics',
            
            'data' => $users 
//            'PlaylistsNew' => $playlists,
//            'PlaylistsTop' => $playlistsTop
        ];

    }
    public function getStatsPlaylistsRated(Request $request){
        
        $playlists = Playlist::orderBy('created_at', 'DESC')->take(10)->get();
        $playlistsTop = Playlist::orderBy('rating', 'DESC')->take(10)->get();
        //$users = User::orderBy('followers', 'DESC')->take(10)->get(); 
        $sql = "select title as Name, popularity as Popularity, danceability as Danceability, energy as Energy, valence as Valence, instrumentalness as Instrumentalness, liveness as Liveness, loudness as Loudness, speechiness as Speechiness, tempo as BPM, acousticness as Acousticness, average_release_year as `Average Release Year` from playlists order by rating desc limit 10 ";
        $users = DB::select($sql);

        return [
            //'Title' => 'Statistics',
            
            'data' => $users 
//            'PlaylistsNew' => $playlists,
//            'PlaylistsTop' => $playlistsTop
        ];

    }
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
