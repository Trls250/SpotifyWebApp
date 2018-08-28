<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

/**
 * TODO: Handle empty response bug from CURL when Spotify api sends no error and no response.
 */

class PlayListController extends Controller
{
    
    
    public function userFunWrapper(Request $request)
    {
        $todo = $request->todo;

        switch($todo)
        {
            case "add":
                return $this->addPlaylist($request);
            case "getAll":
                return $this->getAllPlaylists();
        }


        return "Invalid URL Pattern";
    }



    /**
     * 
     */

    public function getAllPlaylists()
    {
        $url = 	"https://api.spotify.com/v1/me/playlists";
        $curl_return = $this->myCurl($url, null, "GET", FALSE);

       // $curl_data = json_decode($curl_return['ResponseData'], true);


       if($curl_return['Success'] == false)
            return $curl_return['Desc'];
        else
            return view ('home')->with($curl_return['ResponseData']);
    }


    /**
     * 
     */

    public function addPlaylist(Request $request)
    {

        //Check if URL of a Playlist is received

        if(!$request->has('url'))
        {
            $return_array = array(
                "Success" => false,
                "Desc"  => "CAN NOT OBTAIN PLAYLIST ID FROM URL"
            );
            
            return $return_array;                                 
        }


        else
        {
            // Grab vairiables from request
            $playlist_id = $request->input('url');

            //TODO: CHECK ISSET HERE

            // Grab variables from sessions


            if(Session::has('user_info'))
            {
                $user_info = Session::get('user_info');
                $user_id = $user_info['id'];
            }
            else
            {
                $return_array = array(
                    "Success" => false,
                    "Desc"  => "CAN NOT READ SESSION INSTANCE : USER PROFILE INFO"
                );
                
                return $return_array;
            }    

            

            /*
            * CURL Request PUT Data 
            */

            $url = "https://api.spotify.com/v1/users/".$user_id."/playlists/".$playlist_id."/followers";

            $body = array(
                "public" => false
            );



            $curl_return = $this->myCurl($url, $body, "PUT", TRUE);

            return $curl_return;


           
        }
    }


    /**
     * 
     */

    private function myCurl($url, $body, $method, $header)
    {

        if(Session::has('access_token'))
        {
            $access_token = Session::get('access_token');
        }
        else
        {
            $return_array = array(
                "Success" => false,
                "Desc"  => "CAN NOT READ SESSION INSTANCE : ACCESS_TOKEN"
            );
            
            return $return_array;
        }

            /*
            * CURL REQUEST BUILDING 
            */

            $curl_api_user = curl_init();

            if($header)
                curl_setopt($curl_api_user, CURLOPT_HEADER, 1);

            curl_setopt($curl_api_user, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

            if($body == null)
            {
                curl_setopt_array($curl_api_user, array(
                    CURLOPT_URL => $url,
                    CURLOPT_CUSTOMREQUEST => $method,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Content-Type: application/json',
                        'Authorization: Bearer '.$access_token),
                    ));
            }
            else
            {
                curl_setopt_array($curl_api_user, array(
                    CURLOPT_URL => $url,
                    CURLOPT_CUSTOMREQUEST => $method,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_POSTFIELDS => http_build_query($body),
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Content-Type: application/json',
                        'Authorization: Bearer '.$access_token),
                    ));
            }

            

            /*
            * CURL REQUEST SEND AND RECEIVE RESPONSE
            */

            $raw_data = curl_exec($curl_api_user);
            $responseData = json_decode($raw_data, TRUE);
            $responseError = curl_error($curl_api_user);
            
            /*
            *  Close CURL 
            */

            curl_close($curl_api_user);



             // Check for any CURL errors

             if($responseError!="")
             {

                $return_array = array(
                    "Success" => false,
                    "Desc"  => "CURL ERROR: " .$responseError
                );

                return $return_array;                                                             
             }
 
             if (isset($responseData['error']))
             {
                
                $return_array = array(
                    "Success" => false,
                    "Desc"  => ("ERROR Y : ".$responseData['error']['status'].
                    "</br>DESCRIPTION : ".$responseData['error']['message'])
                );

                 return $return_array;
             }
             else
             {
                 

                 if($header)
                 {
                    $data = explode("\n",$raw_data);
                    $header = $data[0];

                    $return_array = array(
                        "Success" => true,
                        "Header"    => $header,
                        "ResponseData" => $responseData,
                    );
                }
                else
                    $return_array = array(
                        "Success" => true,
                        "ResponseData" => $responseData,
                        "ResponseError" => $responseError
                    );
                 return $return_array;
             }
    }


    /**
     * 
     */
    public function getPlayList(Request $request)
    {

        $validatedData = $request->validate([
            'id' => 'required'
        ]);

        if(!$request->has('id'))
        {
            $return_array = array(
                "Success" => false,
                "Desc"  => "MISSING PLAY LIST ID IN URL"
            );
            
            return $return_array;                                 
        }
        else if ($request->input('id') == '')
        {
            $return_array = array(
                "Success" => false,
                "Desc"  => "EMPTY PLAY LIST ID IN URL"
            );
            
            return $return_array;  
        }

        else
        {

            // a boolean flag to pass all the checks if the data stored in sessions is valid

            
            $getFromApiOriginal = false;

            $fields = 'tracks.next%2Ctracks.total%2Cdescription%2Cfollowers.total%2Cimages%2Cname%2Cowner.display_name%2Cowner.id%2Cid%2Cname';
            $field_inner ='%2Ctracks.items.track.id%2Ctracks.items.track.name%2Ctracks.items.track.popularity%2Ctracks.items.track.duration_ms%2Ctracks.items.track.artists.id%2Ctracks.items.track.artists.name';


            $items = $request->items;
            $page = $request->page;
            $high = $items * $page;
            $low = $high - $page;

            if(Session::has('ResponseData'))
            {
                if(Session::get('ResponseData')['id'] == $request->input('id'))
                {
                    if($high > Session::get('CurrentRecords'))
                    {

                        if($high >= Session::get('TotalRecords'))
                        {
                            return "No further records, invalid page index";
                        }
                        
                        $url = Session::get('ResponseData')['tracks']['next'];//.'&fields='.$fields.$field_inner;
                        $this->getPlayListInner($url, true);
                    }
                    else
                    {
                        $getFromApiOriginal = false;
                    }
                }
                else
                {
                    if($page!=1)
                        return redirect('/playlist/get/25/1?id='.$request->input('id'));

                    $getFromApiOriginal = true;
                }

            }
            else
            {
                $getFromApiOriginal = true;
            }

            if ($getFromApiOriginal)
            {
                print_r("Getting value from spotify");
                $playlist_id = $request->input('id');
                $url = 'https://api.spotify.com/v1/playlists/'.$playlist_id;//.'?fields='.$fields.$field_inner;

                //For the very first iteration

                Session::put([
                    'CurrentRecords' => 0
                ]);

                $this->getPlayListInner($url, false);
                
            }


            return view ('playlist')->with(Session::get('ResponseData'));
            /*echo "<pre>";
            print_r(session::get('TrackFeatures'));
            print_r(Session::get('ArtistGenres'));
            print_r(Session::get('ResponseData'));
            print_r('Total '. Session::get('CurrentRecords'));
            print_r(Session::get('ResponseData')['total']);
            echo "</pre>";*/


        }

    }


    /**
     * 
     */

    private function getPlayListInner($url, $append)
    {

        $curl_return = $this->myCurl($url, null, 'GET', False);

        if($curl_return['Success'] == false)
            return $curl_return['Desc'];
        else
        {
            $TrackFeatures = $this->getTrackAttributes($curl_return['ResponseData'], $append);

            if($TrackFeatures['Success'] == false)
                return $TrackFeatures['Desc'];
            else
            {
                $ArtistGenres = $this->getArtistGenres($curl_return['ResponseData'], $append);
                if($ArtistGenres['Success'] == false)
                    return $ArtistGenres['Desc'];
                else
                {

                    if($append)
                    {
                        $tempMain = Session::get('ResponseData');
                        $tempTracks = array_merge($tempMain['tracks']['items'], $curl_return['ResponseData']['items']);
                        $tempMain['tracks'] = $tempTracks;
                        $tempFeatures = array_merge(Session::get('TrackFeatures'), $TrackFeatures['audio_features']);
                        $tempArtists = array_merge(Session::get('ArtistGenres'), $ArtistGenres);

                        Session::put([
                            'ResponseData'  => $tempMain,
                            'TrackFeatures' => $tempFeatures,
                            'ArtistGenres'  => $tempArtists,
                            'CurrentRecords' => Session::get('CurrentRecords')+count($curl_return['ResponseData']['items'])
                        ]);


                    }
                    else
                        Session::put([
                            'TrackFeatures' => $TrackFeatures['audio_features'],
                            'ResponseData'  => $curl_return['ResponseData'],
                            'ArtistGenres'  => $ArtistGenres,
                            'CurrentRecords' => Session::get('CurrentRecords')+count($curl_return['ResponseData']['tracks']['items']),
                            'TotalRecords'  => $curl_return['ResponseData']['tracks']['total']
                        ]);

                }
            }
        }
        
        
    }

    /**
     * Limit and offset query parameters on spotify api are broken.
     * A common issue that is found over internet right now.
     * Solution implemented: As maximum ids requested to Spotify API
     * are 50, and Playlist's minimum record received is 100, 
     * I am dividing received records into two dynamic equal chunks.
     */

    private function getTrackAttributes($playlist, $append)
    {
        $track_ids = "";
        $toAppend = "";


        if($append)
         {   
            foreach($playlist['items'] as $track)
            {
        
                $track_ids = $track_ids.$toAppend;
                $track_ids = $track_ids.$track['track']['id'];
                $toAppend = '%2C';

            }
        }
        else
            foreach($playlist['tracks']['items'] as $track)
            {
        
                $track_ids = $track_ids.$toAppend;
                $track_ids = $track_ids.$track['track']['id'];
                $toAppend = '%2C';

            }

        
        $url =  "https://api.spotify.com/v1/audio-features?ids=".$track_ids;

        $curl_return = $this->myCurl($url, null, 'GET', false);

        if($curl_return['Success'] == false)
        {
            return $curl_return;
        }
        else
        {
            $curl_return['ResponseData']['Success'] = true;
            return $curl_return['ResponseData'];
        }
    }


    /**
     * 
     */

    private function getArtistGenres($playlist, $append)
    {

        $ArtistGenres = array();
        $artist_ids = "";
        $toAppend = "";

        $start = 0;
        $limit = 50;

        if($append)
            $count_records = count($playlist['items']);
        else
            $count_records = count($playlist['tracks']['items']);

        $iterations = ceil($count_records/($limit+1));

        for($i = 0; $i < $iterations; $i++)
        {

            if($append)
                foreach(array_slice($playlist['items'], $start, $limit) as $track)
                {
                    $artist_ids = $artist_ids.$toAppend;
                    $artist_ids = $artist_ids.$track['track']['artists'][0]['id'];
                    $toAppend = '%2C';
                }
            else
                foreach(array_slice($playlist['tracks']['items'], $start, $limit) as $track)
                {
                    $artist_ids = $artist_ids.$toAppend;
                    $artist_ids = $artist_ids.$track['track']['artists'][0]['id'];
                    $toAppend = '%2C';
                }

            $url = 'https://api.spotify.com/v1/artists?ids='.$artist_ids;

            $curl_return = $this->myCurl($url, null, 'GET', false);

            if($curl_return['Success'] == false)
            {
                return $curl_return;
            }

            else
            {
               $ArtistGenres = array_merge($ArtistGenres, $curl_return['ResponseData']['artists']);
            }

            $artist_ids = '';
            $start = $limit;
            $limit = $limit + $limit;
            $toAppend = '';

        }
        
        $ArtistGenres['Success'] = true;
        return $ArtistGenres;
        
    }
}
