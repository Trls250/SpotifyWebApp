<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("client_id", 'eb8ca431d8e64b51b50f47d49a2efa11');
define('client_secret', '0bc65f040408414aa202b8ed0a45be37');
define('redirect_uri', getBaseUrl() . 'auth/postAuth');
define('state', 'ABCDEF');

use Illuminate\Http\Request;

//TODO -> randomize state check

function getBaseUrl() {
    // output: /myproject/wall.blade.php
    $currentPath = $_SERVER['PHP_SELF'];

    // output: Array ( [dirname] => /myproject [basename] => wall.blade.php [extension] => php [filename] => index )
    $pathInfo = pathinfo($currentPath);

    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];

    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';

    // return: http://localhost/myproject/
    return $protocol . $hostName . $pathInfo['dirname'] . "/";
}

function authCode() {

    $response_type = 'code';
    $scope = 'playlist-read-collaborative%20user-read-private%20user-read-email%20playlist-modify-private%20user-read-playback-state%20playlist-read-private%20streaming%20playlist-modify-public%20user-modify-playback-state%20user-read-currently-playing%20playlist-read-collaborative';

    return redirect('https://accounts.spotify.com/authorize/?client_id=' . client_id . '&response_type=' . $response_type . '&redirect_uri=' . redirect_uri . '&scope=' . $scope . '&state=' . state);
}

function postAuthCode(Request $request) {
    if (!$request->has('code'))
        return "false";                                          //TODO -> append failure code...when input parameters don't exist

    else {
        //Grab variables from request
        $authorization_code = $request->input('code');

        if (state != $request->input('state')) {
            return "STATE MISMATCH";
        } else {

            /*
             * GET ACCESS TOKEN NOW    *

             * CURL REQUEST POST DATA
             * SECOND REQUEST IN AUTHORIZATION PHASE
             * SENDING AUTHORIZATION CODE TO EXCHANGE ACCESS AND REFRESH TOKENS
             */

            $postData = array(
                'grant_type' => "authorization_code",
                'code' => $authorization_code,
                'redirect_uri' => redirect_uri,
                'client_id' => client_id,
                'client_secret' => client_secret
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

            if ($responseError != "") {
                $return_array = array(
                    "Success" => false,
                    "Code" => "error_curl",
                    "Desc" => "ERROR : " . $responseError
                );
                return $return_array;                                    //TODO -> Append failure code here in case of CURL error
            }

            if (isset($responseData['error'])) {
                if ($responseData['error'] == 'invalid_grant')
                    return "Authorization code expired or used";
                else {
                    $return_array = array(
                        "Success" => false,
                        "Code" => $responseData['error']['status'],
                        "Desc" => $responseData['error']['message']
                    );

                    return $return_array;
                }
            } else {

                Session::put([
                    'access_token' => $responseData['access_token'],
                    'refresh_token' => $responseData['refresh_token'],
                    'expires_in' => $responseData['expires_in']
                ]);

                return true;
            }
        }
    }
}

function refreshToken() {

    //clear out the user info from session, so if refreshing fails, there is no user in session


    if (!session::has('refresh_token')) {
        $return_array = array(
            "Success" => false,
            "Code" => "exp_session",
        );

        return $return_array;
    }

    $postData = array(
        'grant_type' => "refresh_token",
        'refresh_token' => session::get('refresh_token'),
        'client_id' => client_id,
        'client_secret' => client_secret
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

    if ($responseError != "") {
        $return_array = array(
            "Success" => false,
            "Code" => "error_curl",
            "Desc" => "ERROR : " . $responseError
        );
        return $return_array;                                     //TODO -> Append failure code here in case of CURL error
    }

    if (isset($responseData['error'])) {
        if ($responseData['error'] == 'invalid_grant') {
            $return_array = array(
                "Success" => false,
                "Code" => "exp_session",
                "Desc" => $responseData['error']['message']
            );

            return $return_array;
        } else {
            $return_array = array(
                "Success" => false,
                "Code" => $responseData['error']['status'],
                "Desc" => $responseData['error']['message']
            );

            return $return_array;
        }
    } else {


        Session::put([
            'access_token' => $responseData['access_token'],
            'expires_in' => $responseData['expires_in']
        ]);



        session::forget('UserInfo');
        return (getUserProfile('me'));
    }
}

function getUserProfile($id) {
    //Grab variabes from sessions

    if ((Session::has('access_token'))) {
        $access_token = Session::get('access_token');
    } else
        return ('Error: Can not read session instance');
    /*
     * CURL REQUEST BUILDING
     */

    $curl_api_user = curl_init();

    if ($id == 'me') {

        curl_setopt($curl_api_user, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt_array($curl_api_user, array(
            CURLOPT_URL => "https://api.spotify.com/v1/me",
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $access_token),
        ));
    } else {
        curl_setopt($curl_api_user, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt_array($curl_api_user, array(
            CURLOPT_URL => "https://api.spotify.com/v1/users/" . $id,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $access_token),
        ));
    }

    /*
     * CURL REQUEST SEND AND RECEIVE RESPONSE
     */


    $responseData = json_decode(curl_exec($curl_api_user), TRUE);
    $responseError = curl_error($curl_api_user);

    /*
     * Close CURL
     */

    curl_close($curl_api_user);

    if ($responseError != "") {
        $return_array = array(
            "Success" => false,
            "Code" => "exp_session",
            "Desc" => "ERROR : " . $responseError
        );
        return $return_array;                             //TODO -> Append failure code here in case of CURL error
    }

    if (isset($responseData['error'])) {
        $return_array = array(
            "Success" => false,
            "Code" => $responseData['error']['status'],
            "Desc" => $responseData['error']['message']
        );
        return $return_array;
    } else {
        if ($id == 'me')
        {
            findAndGetCover($responseData['images'], 'users/'.$responseData['id'].'.jpg');
            Session::put('UserInfo', $responseData);
        }
        $responseData['Success'] = true;
        return $responseData;
    }
}


