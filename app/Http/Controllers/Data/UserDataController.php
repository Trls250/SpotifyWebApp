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
use App\user_top_playlist;
use session;


class UserDataController extends Controller {

    // use UserData {
    //     UserData::getUserProfile as myGetUserProfile;
    // }

    public function getUserMatch(Request $request){
        $results = User::searchLike($request['q'], $request['id']);
        return json_encode(['results' => $results] );
    }

    public function getCurrentUser(Request $request) {

        $user = User::find(session::get('UserInfo')['id']);

        $playlist_ratings = Playlist::where('added_by', '=', $user->id)->pluck('rating');

    
        $Genres = Genre::all();

        return view('profile')->with([
            'Success' => true,
            'AvgRating' => $this->getUserAvgRating(session::get('UserInfo')['id']),
            'UserInfo' => $user,
            'TrackInfo' => $user->track,
            'ArtistInfo' => $user->artist,
            'GenreInfo' => $user->genre,
            'PlaylistInfo' => $user->user_top_playlist,
            'PlaylistCount' => count($user->playlist),
            'Genres' => $Genres
        ]);
    }

    public function addPlaylist(Request $request){
        $url = $request->input('playlist_id');
        //Check if URL of a Playlist is received
        if (!isset($url)) {
            $return_array = array(
                "Success" => false,
                "Desc" => "CAN NOT OBTAIN PLAYLIST ID FROM URL",
                "url" => $url

            );

            return $return_array;
        } else {
            // Grab vairiables from request
            $playlist_id = $request->input('url');

            //TODO: CHECK ISSET HERE
            // Grab variables from Sessions


            if (session::has('UserInfo')) {
                $user_info = Session::get('UserInfo');
                $user_id = $user_info['id'];
            } else {
                $return_array = array(
                    "Success" => false,
                    "Desc" => "CAN NOT READ Session INSTANCE : USER PROFILE INFO"
                );

                return $return_array;
            }



            $exploded = explode('/',$request->playlist_id);
            $exploded = explode('?', end($exploded));


            /*
             * CURL Request PUT Data
             */
            $url = "https://api.spotify.com/v1/playlists/" . $exploded[0] ;


            

            $curl_return = goCurl($url, null, "GET", FALSE);
            if ($curl_return['Success'] == false)
                return ([
                            'Success' => false,
                            'curl' => $curl_return,
                            'url' => $url
                        ]);
            else {
            // if(strpos($curl_return['Header'],'200') == false)
            // {
            //     return ([
            //         'Success' => false,
            //         'curl' => $curl_return,
            //         'url' => $url
            //     ]);
            // }
            // else
            // {

                $new_user_top_playlist = new user_top_playlist();
                $new_user_top_playlist->user_id = session::get('UserInfo')['id'];
                $new_user_top_playlist->playlist_id = $exploded[0];
                $new_user_top_playlist->playlist_title = $curl_return['ResponseData']['name'];
                $new_user_top_playlist->followers = $curl_return['ResponseData']['followers']['total'];
                $new_user_top_playlist->preview_url = $curl_return['ResponseData']['external_urls']['spotify'];

                $new_user_top_playlist->save();


                return ([
                    'Success' => true,
                    'status' => 200
                ]);

                
            }
        }
    }
    public function getUsers(Request $request){
        
        $offset = 0;
        $limit = 2;

        if(isset($request['offset']))
        {
           $offset = $request['offset'];

        }

        if(isset($request['items']))
        {
            $limit = $request['items'];

        }

        if(User::count() == 0){
            return ([
                'Success'=>false,
                'Status'=>"404",
                'Message'=>"No records"]);
        }


        $users = User::skip($offset)->take($limit)->get();

        foreach ($users as $key => $user) {
            
            $users[$key]['AvgRating'] = $this->getUserAvgRating($users[$key]->id);
            $users[$key]['PlaylistCount'] = count(Playlist::where('added_by', '=', $users[$key]['id'])->get());

        }



        if($users->count() == 0)
        {
            return ([
                'Success'=>false,
                'Status'=>"204",
                'Message'=>"No further records"]);
        }


        

        return view('loaders.people_loader')->with([
            'Status' => "200",
            'Success'=>true,
            'Users'=> $users,
             ]);
        
    }

    private function getUserAvgRating($user_id){

        $playlist_ratings = Playlist::where('added_by', '=', $user_id)->pluck('rating');
        $temp = 0;
        foreach ($playlist_ratings as $playlist_rating){
            $temp += $playlist_rating;
        }

        if($temp != 0)
            $temp = $temp/ count($playlist_ratings);
        else
            $temp = 0;


        return $temp;
    }

    public function getUser(Request $request) {



        if(!User::where('id', '=', $request->id)->exists()){

            return view('errors.404-user')->with('user_id', $request->id);
        }


        $user = User::find($request->id);

        $Genres = Genre::all();

        return view('profile')->with([
            'Success' => true,
            'AvgRating' => $this->getUserAvgRating($request->id),
            'UserInfo' => $user,
            'TrackInfo' => $user->track,
            'ArtistInfo' => $user->artist,
            'GenreInfo' => $user->genre,
            'PlaylistInfo' => $user->user_top_playlist,
            'PlaylistCount' => count($user->playlist),
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
        $artist = explode('/', $artist);
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
        $track = explode('/', $track);
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
