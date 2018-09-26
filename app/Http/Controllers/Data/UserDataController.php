<?php

namespace App\Http\Controllers\Data;

// use App\Traits\UserData;
use App\Artist;
use App\Playlist;
use App\Track;
use App\User_Artist;
use App\User_Genre;
use App\User_Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Genre;
use session;


class UserDataController extends Controller {

    // use UserData {
    //     UserData::getUserProfile as myGetUserProfile;
    // }


    public function getCurrentUser(Request $request) {

        $user = User::find(session::get('UserInfo')['id']);

        $playlist_ratings = Playlist::where('added_by', '=', $user->id)->pluck('rating');

        $temp = 0;
        foreach ($playlist_ratings as $playlist_rating){
            $temp += $playlist_rating;
        }

        $temp = $temp/ count($playlist_ratings);
        $Genres = Genre::all();

        return view('profile')->with([
            'Success' => true,
            'AvgRating' => $temp,
            'UserInfo' => $user,
            'TrackInfo' => $user->track,
            'ArtistInfo' => $user->artist,
            'GenreInfo' => $user->genre,
            'Genres' => $Genres
        ]);
    }


    public function getUser(Request $request) {

        $request->validate([
            'id' => 'required',
        ]);


        if(!User::where('id', '=', $request->id)->exists()){

            return view('errors.404');
        }


        $user = User::find($request->id);

        $playlist_ratings = Playlist::where('added_by', '=', $user->id)->pluck('rating');

        $temp = 0;
        foreach ($playlist_ratings as $playlist_rating){
            $temp += $playlist_rating;
        }

        $temp = $temp/ count($playlist_ratings);
        $Genres = Genre::all();

        return view('profile')->with([
            'Success' => true,
            'AvgRating' => $temp,
            'UserInfo' => $user,
            'TrackInfo' => $user->track,
            'ArtistInfo' => $user->artist,
            'GenreInfo' => $user->genre,
            'Genres' => $Genres
        ]);
    }


    public function addGenre(Request $request) {

        if(isset($request->genre)) {

            $genre = $request->genre;
            $genre = Genre::where('name', '=', $genre)->first();

            if(User_Genre::where([
                'genre_id' => $genre->id,
                'user_id' => session::get('UserInfo')['id']
            ])->exists()){



                return ([
                    'Success' => True,
                    'Status' => 200
                ]);
            }
            else {

                $user_genre = new User_Genre();
                $user_genre->user_id = session::get('UserInfo')['id'];
                $user_genre->genre_id = $genre->id;
                $user_genre->save();
                return ([
                    'Success' => True,
                    'Status' => 200
                ]);

            }




        }else {

            return ([
                'Success' => False,
                'Status' => "500"]);

        }



    }

    public function addArtist(Request $request) {
        $artist = $request->artist_id;
        $artist = explode(':', $artist);
        $artist = end($artist);


        $url = "https://api.spotify.com/v1/artists/".$artist;
        $curl_return = goCurl($url, null, 'GET', False);

        if(!isset($curl_return['ResponseData'])){
            return ([
                'Success' => False,
                'Desc' => 'No artist with this ID exists'
            ]);
        }
        else {



            if(Artist::where('id', '=', $curl_return['ResponseData']['id'])->exists()) {

                $artist = Artist::find($curl_return['ResponseData']['id']);

            }
            else {

                $artist = new Artist();

            }


                $artist->id = $curl_return['ResponseData']['id'];
                $artist->name = $curl_return['ResponseData']['name'];
                $artist->popularity = $curl_return['ResponseData']['popularity'];
                $artist->followers = $curl_return['ResponseData']['followers']['total'];
                $artist->save();



            if(User_Artist::where([
                'user_id' => session::get('UserInfo')['id'],
                'artist_id' => $curl_return['ResponseData']['id']])->exists()){

                return ([
                    'Success' => True,
                    'Status' => 200
                ]);

            }

                $user_artist = new User_Artist();
                $user_artist->artist_id = $curl_return['ResponseData']['id'];
                $user_artist->user_id = session::get('UserInfo')['id'];
                $user_artist->save();


                return ([
                    'Success' => True,
                    'Status' => 200
                ]);



        }

    }


    public function addTrack(Request $request) {
        $track = $request->track_id;
        $track = explode(':', $track);
        $track = end($track);


        $url = "https://api.spotify.com/v1/tracks/".$track;
        $curl_return = goCurl($url, null, 'GET', False);

        if(!isset($curl_return['ResponseData'])){
            return ([
                'Success' => False,
                'Desc' => 'No track with this ID exists'
            ]);
        }
        else {



            if(Track::where('id', '=', $curl_return['ResponseData']['id'])->exists()) {

                $track = Track::find($curl_return['ResponseData']['id']);

            }
            else {

                $track = new Track();

            }


            $track->id = $curl_return['ResponseData']['id'];
            $track->name = $curl_return['ResponseData']['name'];
            $track->preview = $curl_return['ResponseData']['preview_url'];
            $track->save();


            if(User_Track::where([
                'user_id' => session::get('UserInfo')['id'],
                'track_id' => $curl_return['ResponseData']['id']]) ->exists()){

                 return ([
                     'Success' => True,
                     'Status' => 200
                 ]);

            }

            $user_track = new User_Track();
            $user_track->track_id = $curl_return['ResponseData']['id'];
            $user_track->user_id = session::get('UserInfo')['id'];
            $user_track->save();

            return ([
                'Success' => True,
                'Status' => 200
            ]);



        }

    }


    public function test(Request $request) {
        Genre::insertGenres();
    }
}
