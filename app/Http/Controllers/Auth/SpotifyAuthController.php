<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;

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
            if (getUserProfile('me')['Success'] == true) {
                // return redirect()->route('user/update');
                User::saveRecord();
                \App\Playlist::isNewTag(Session::get('UserInfo')['id']);
                Session::put('WallRecordsCount', \App\Playlist::count());
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

    //for testing purposes
    public function setExpire() {
        Session::flush();
        return redirect('/'); 
    }

}
