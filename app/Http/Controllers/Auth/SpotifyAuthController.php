<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use App\Artist;

class SpotifyAuthController extends Controller {

    /**
     * Token and UserData are Traits, that have Authentication
     * functions, as abstract types. Because these functions
     * are to be used from different points in the system
     * this enables code re-usability.
     */
    /*
     * This function is Called by FrontEnd to start authorization.
     * Redirects application to Spotify Servers for User Grant (Through Trait Function)
     * Called by: Log In button
     * From: FrontEnd
     */

    public function myAuthCode() {
        return (authCode());
    }

    /*
     *   This function is called by Redirect_URI parameter from SPOTIFY Servers
     *   It receives Authorization and State codes in parameters.
     *   It sends back another request to SPOTIFY Servers to obtain Access and Refresh Tokens
     *   Called by: Spotify Servers
     *   From: Outside the system
     */

    public function myPostAuthCode(Request $request) {

        if (postAuthCode($request) == true) {

            $user = getUserProfile('me');

            if ($user['Success'] == true) {
                // return redirect()->route('user/update');
                $isNewUser = User::saveRecord();
                \App\Playlist::isNewTag(Session::get('UserInfo')['id']);
                Session::put('WallRecordsCount', \App\Playlist::count());

                // if($isNewUser){


                // }

                $this->getUserTopTracksAndArtists();

                return redirect('playlist/getWall');
            } else {
                return view('home')->withErrors('Unable to log in right now.');
            }
        }
        
    }

    public function checkRedirect() {

        if(session()->has('UserInfo')){
            return redirect('playlist/getWall');
        } else {
            return view ('home');
        }

    }

    public function getUserTopTracksAndArtists(){
        $this_user_id = session::get('UserInfo')['id'];

        if(isset($this_user_id)){
            $url = "https://api.spotify.com/v1/me/top/artists?time_range=medium_term&limit=100&offset=0";
            $topArtists = goCurl($url, null, "GET", false);

            if($topArtists['Success']){
                foreach($topArtists['ResponseData']['items'] as $artist){
                    User::attachArtist($artist['id'], $artist['name'], $artist['popularity'], $artist['followers']['total'], $artist['genres']);
                }

                $url = "https://api.spotify.com/v1/me/top/tracks?time_range=medium_term&limit=100&offset=0";
                $topTracks = goCurl($url, null, "GET", false);

    

                if($topTracks['Success']){
                    foreach($topTracks['ResponseData']['items'] as $track){
                        User::attachTrack($track['id'], $track['name'], $track['preview_url']);
                    }

                    return([
                        'Success' => true
                    ]);

                }else
                {
                    return([
                        'Success' => false,
                        'Error' => "Error in obtaining data"
                    ]);
                }

            }else
            {
                return([
                    'Success' => false,
                    'Error' => "Error in obtaining data"
                ]);
            }


            

        }


    }

    

    //for testing purposes
    public function setExpire() {
        Session::flush();
        return redirect('/'); 
    }

}
