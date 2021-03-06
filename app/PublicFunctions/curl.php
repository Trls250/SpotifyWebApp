<?php

ini_set('max_execution_time', 300);

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




function goCurl($url, $body, $method, $header) {

    if (Session::has('access_token')) {
        $access_token = Session::get('access_token');
    } else {
        $return_array = array(
            "Success" => false,
            "Desc" => "Your credentials are invalid. Log in again.",
            "Code" => "exp_session"
        );

        return $return_array;
    }

    /*
     * CURL REQUEST BUILDING
     */

    $curl = curl_init();

    if ($header)
        curl_setopt($curl, CURLOPT_HEADER, 1);

    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl,CURLOPT_TIMEOUT,1000);

    if ($body == null) {
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $access_token),
        ));
    } else {
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POSTFIELDS => http_build_query($body),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $access_token),
        ));
    }

    /*
     * CURL REQUEST SEND AND RECEIVE RESPONSE
     */
    $raw_data = curl_exec($curl);
    $responseData = json_decode($raw_data, TRUE);
    $responseError = curl_error($curl);
    /*
     *  Close CURL
     */

    curl_close($curl);



    // Check for any CURL errors

    if ($responseError != "") {

        $return_array = array(
            "Success" => false,
            "Code" => "error_api",
            "Desc" => "CURL ERROR: " . $responseError
        );

        return $return_array;
    }


    if (isset($responseData['error'])) {

        $return_array = array(
            "Success" => false,
            "Code" => "error_api",
            "Status" => $responseData['error']['status'],
            "Desc" => $responseData['error']['message']
        );


        if ($responseData['error']['status'] == '401') {
            // exit("TEST");
            $refresh_success = refreshToken();
            if ($refresh_success['Success'] == true) {
                return goCurl($url, $body, $method, $header);
            } else {
                return $refresh_success;
            }
        } else
            return $return_array;
    }
    else {


        if ($header) {
            $data = explode("\n", $raw_data);
            $header = $data[0];

            $return_array = array(
                "Success" => true,
                "Header" => $header,
                "ResponseData" => $responseData,
            );
        } else
            $return_array = array(
                "Success" => true,
                "ResponseData" => $responseData,
                "ResponseError" => $responseError
            );
        return $return_array;
    }
}

function downloadImage($image_url, $image_file) {

    $fp = fopen('public/'.$image_file, 'w+');              // open file handle

    $curl = curl_init($image_url);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
    curl_setopt($curl, CURLOPT_FILE, $fp);          // output to file
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0');
    //curl_setopt($curl, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
    curl_exec($curl);

    $responseError = curl_error($curl);

    curl_close($curl);                              // closing curl handle
    fclose($fp);

    if ($responseError != "") {

        $return_array = array(
            "Success" => false,
            "Code" => "500",
            "Desc" => "CURL ERROR: " . $responseError
        );

        return $return_array;
    } else {
        return (['Success' => true]);
    }
}



function findAndGetCover($images, $file_loc) {
    $images_count = count($images);
    if ($images_count > 0) {
        return downloadImage($images[0]['url'], $file_loc);
    } else {
        return (['Success' => false]);
    }
}

