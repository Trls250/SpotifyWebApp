<?php

namespace App\Traits;
use Session;

trait UserData {


    public function getUserProfile($id)
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

        if($id=='me')
        {

            curl_setopt($curl_api_user, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt_array($curl_api_user, array(
                CURLOPT_URL => "https://api.spotify.com/v1/me",
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$access_token),
                ));
        }

        else
        {
            curl_setopt($curl_api_user, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt_array($curl_api_user, array(
                CURLOPT_URL => "https://api.spotify.com/v1/users/".$id,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$access_token),
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

        if($responseError!="")
        {
            $return_array = array(
                "Success" => false,
                "Code"  => "exp_session",
                "Desc"  => "ERROR : ".$responseError
            );
            return $return_array;                             //TODO -> Append failure code here in case of CURL error
        }

        if (isset($responseData['error']))
        {
            $return_array = array(
                "Success" => false,
                "Code"  => $responseData['error']['status'],
                "Desc"  => $responseData['error']['message']
            );
            return $return_array;
        }
        else
        {
            if($id == 'me')
                Session::put('UserInfo', $responseData);

            $responseData['Success'] = true;
            return $responseData;
        }

    }
}


?>
