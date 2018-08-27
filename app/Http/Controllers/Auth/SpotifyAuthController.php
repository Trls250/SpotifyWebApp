<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class SpotifyAuthController extends Controller
{
    
    protected $client_id = 'eb8ca431d8e64b51b50f47d49a2efa11';
    protected $client_secret = '0bc65f040408414aa202b8ed0a45be37';
    protected $redirect_uri = 'http://localhost:8000/postAuth';
    
    private $state = 'ABCDEF';                                              //TODO -> randomize state check


    /*
    * This function is Called by FrontEnd to start authorization.
    * Redirects application to Spotify Servers for User Grant
    * RedirectURI sent in parameters bring back to PostAuth() Function.
    */

    public function authCode()
    {
        
        $response_type = 'code';
        $scope = 'user-read-private%20user-read-email%20playlist-modify-private%20user-read-playback-state%20playlist-read-private%20streaming%20playlist-modify-public%20user-modify-playback-state%20user-read-currently-playing%20playlist-read-collaborative';


        return redirect('https://accounts.spotify.com/authorize/?client_id='.$this->client_id.'&response_type='.$response_type.'&redirect_uri='.$this->redirect_uri.'&scope='.$scope.'&state='.$this->state);

    }




    /*
    *   This function is called by Redirect_URI parameter from SPOTIFY Servers
    *   It receives Authorization and State codes in parameters.
    *   It sends back another request to SPOTIFY Servers to obtain Access and Refresh Tokens
    */

    public function postAuthCode(Request $request)
    {
        

        if(!$request->has('code'))
            return "false";                                          //TODO -> append failure code...when input parameters don't exist

        else
        {
            //Grab variables from request
            $authorization_code = $request->input('code');

            if($this->state != $request->input('state'))
            {
                return "STATE MISMATCH";
            }
            else
            {
            
                /*
                *       GET ACCESS TOKEN NOW    *

                * CURL REQUEST POST DATA
                * SECOND REQUEST IN AUTHORIZATION PHASE
                * SENDING AUTHORIZATION CODE TO EXCHANGE ACCESS AND REFRESH TOKENS
                */


                $postData = array(
                    'grant_type'    => "authorization_code",
                    'code'          => $authorization_code,
                    'redirect_uri'  => $this->redirect_uri,
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->client_secret
                );



                /*
                * CURL REQUEST BUILDING 
                */


                $curl_api_token = curl_init();
                curl_setopt_array($curl_api_token, array(
                    CURLOPT_URL => "https://accounts.spotify.com/api/token",
                    CURLOPT_POST => TRUE,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
                    CURLOPT_POSTFIELDS => http_build_query($postData),
                ));


                /*
                * CURL REQUEST SEND AND RECEIVE RESPONSE
                */


                $responseData = json_decode(curl_exec($curl_api_token), TRUE);
                $responseError = curl_error($curl_api_token);

                curl_close($curl_api_token);
                /*
                * Close CURL
                */

                


                if($responseError!="")
                {
                    return "CURL ERROR: " .$responseError;                                   //TODO -> Append failure code here in case of CURL error
                }

                if (isset($responseData['error']))
                {
                    if ($responseData['error'] == 'invalid_grant')
                        return "Authorization code expired or used";
                    else
                        return "Unkown Error Occured, Possibly: Access Token Request Failed";
                }

                else
                {
         
                    Session::put([
                        'access_token'  => $responseData['access_token'],
                        'refresh_token' => $responseData['refresh_token'],
                        'expires_in'    => $responseData['expires_in']
                    ]);

                    $fun_return = $this->getUserProfile();
        
                    if($fun_return == "true")
                    {
                        return redirect()->route('home');
                    }
                    else
                    {
                        return $fun_return;
                    }
                }
                
            }          
            
        }
    }


    public function getUserProfile()
    {

        //Grab variabes from sessions

        if((Session::has('access_token')))
        {
            $access_token = Session::get('access_token');
        }
        else
            return ('Error: Can not read session instance');


        /*
        * CURL REQUEST BUILDING 
        */


        $curl_api_user = curl_init();


        curl_setopt($curl_api_user, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt_array($curl_api_user, array(
            CURLOPT_URL => "https://api.spotify.com/v1/me",
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$access_token),
            ));


        /*
        * CURL REQUEST SEND AND RECEIVE RESPONSE
        */


        $responseData = json_decode(curl_exec($curl_api_user), TRUE);
        $responseError = curl_error($curl_api_user);

        /*
        * Close CURL
        */

        curl_close($curl_api_user);

        if($responseError!="")
        {
             return "CURL ERROR: " .$responseError;                                   //TODO -> Append failure code here in case of CURL error
        }

        if (isset($responseData['error']))
        {
            return ("ERROR : ".$responseData['error']['status'].
                    "</br>DESCRIPTION : ".$responseData['error']['message']);
        }
        else
        {
            Session::put('user_info', $responseData);
            return "true";
        }
  
        
    }


}
