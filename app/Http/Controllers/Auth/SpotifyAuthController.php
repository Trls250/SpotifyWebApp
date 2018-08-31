<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Traits\Tokens;
use App\Traits\UserData;
use App\Http\Controllers\Controller;
use Session;

class SpotifyAuthController extends Controller
{
    /**
     * Token and UserData are Traits, that have Authentication 
     * functions, as abstract types. Because these functions 
     * are to be used from different points in the system
     * this enables code re-usability.
     */

    use Tokens{
        Tokens::postAuthCode as myPostAuthCode;
        Tokens::authCode as myAuthCode;
    }

    use UserData{
        UserData::getUserProfile as myGetUserProfile;
    }


    /*
    * This function is Called by FrontEnd to start authorization.
    * Redirects application to Spotify Servers for User Grant (Through Trait Function)
    * Called by: Log In button
    * From: FrontEnd
    */

    public function authCode()
    {
        return ($this->myAuthCode());
    }



    /*
    *   This function is called by Redirect_URI parameter from SPOTIFY Servers
    *   It receives Authorization and State codes in parameters.
    *   It sends back another request to SPOTIFY Servers to obtain Access and Refresh Tokens
    *   Called by: Spotify Servers
    *   From: Outside the system
    */

    public function postAuthCode(Request $request)
    {

        if($this->myPostAuthCode($request) == true)
        {
            if ($this->myGetUserProfile('me')['Success'] == true)
            {
                return redirect()->route('home');
            }
        }
        
    }



    public function setExpire(Request $request)
    {
        session::put('access_token',  $request->token);
    }

   

}
