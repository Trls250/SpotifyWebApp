<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Session;

trait Tokens
{
    protected $client_id = 'eb8ca431d8e64b51b50f47d49a2efa11';
    protected $client_secret = '0bc65f040408414aa202b8ed0a45be37';
    protected $redirect_uri = 'http://localhost:8000/auth/postAuth';

    private $state = 'ABCDEF';                                              //TODO -> randomize state check


    public function authCode()
    {

        $response_type = 'code';
        $scope = 'user-read-private%20user-read-email%20playlist-modify-private%20user-read-playback-state%20playlist-read-private%20streaming%20playlist-modify-public%20user-modify-playback-state%20user-read-currently-playing%20playlist-read-collaborative';

        return redirect('https://accounts.spotify.com/authorize/?client_id='.$this->client_id.'&response_type='.$response_type.'&redirect_uri='.$this->redirect_uri.'&scope='.$scope.'&state='.$this->state);

    }


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
                * GET ACCESS TOKEN NOW    *

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
                    $return_array = array(
                        "Success" => false,
                        "Code"  => "error_curl",
                        "Desc"  => "ERROR : ".$responseError
                    );
                    return $return_array;                                    //TODO -> Append failure code here in case of CURL error
                }

                if (isset($responseData['error']))
                {
                    if ($responseData['error'] == 'invalid_grant')
                        return "Authorization code expired or used";
                    else
                        {
                            $return_array = array(
                                "Success" => false,
                                "Code"  => $responseData['error']['status'],
                                "Desc"  => $responseData['error']['message']
                            );

                            return $return_array;
                        }
                }

                else
                {

                    Session::put([
                        'access_token'  => $responseData['access_token'],
                        'refresh_token' => $responseData['refresh_token'],
                        'expires_in'    => $responseData['expires_in']
                    ]);

                    return true;
                }

            }

        }
    }


    public function refreshToken()
    {

        if(!session::has('refresh_token'))
        {
            $return_array = array(
                "Success" => false,
                "Code"  => "exp_session",
            );

            return $return_array;
        }

        $postData = array(
            'grant_type'    => "refresh_token",
            'refresh_token'  => session::get('refresh_token'),
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


        $responseData = curl_exec($curl_api_token);
        $responseError = curl_error($curl_api_token);

        curl_close($curl_api_token);
        /*
        * Close CURL
        */
        $responseData = json_decode($responseData, TRUE);

        if($responseError!="")
        {
            $return_array = array(
                "Success" => false,
                "Code"  => "error_curl",
                "Desc"  => "ERROR : ".$responseError
            );
            return $return_array;                                     //TODO -> Append failure code here in case of CURL error
        }

        if (isset($responseData['error']))
        {
            if ($responseData['error'] == 'invalid_grant')
            {
                $return_array = array(
                    "Success" => false,
                    "Code"  => "exp_session",
                    "Desc"  => $responseData['error']['message']
                );

                return $return_array;
            }
            else
            {
                $return_array = array(
                    "Success" => false,
                    "Code"  => $responseData['error']['status'],
                    "Desc"  => $responseData['error']['message']
                );

                return $return_array;
            }
        }

        else
        {

            Session::put([
                'access_token'  => $responseData['access_token'],
                'expires_in'    => $responseData['expires_in']
            ]);

            return (['Success' => true]);
        }


    }
}

?>
