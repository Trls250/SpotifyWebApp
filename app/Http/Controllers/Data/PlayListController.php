<?php

namespace App\Http\Controllers;

use App\PlaylistRating;
use App\Http\Controllers\Data\PlaylistRatingsController;
use App\Playlist;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

/**
 * TODO: Handle empty response bug from CURL when Spotify api sends no error and no response.
 */
class PlayListController extends Controller {

    /**
     *
     */


    public function getAllPlaylistsRecords(Request $request) {

        $offset = 0;
        $limit = 10;

        if(isset($request['offset']))
        {
            $offset = $request['offset'];

        }

        if(isset($request['items']))
        {
            $limit = $request['items'];

        }


        $url = "https://api.spotify.com/v1/me/playlists?limit=".$limit."&offset=".$offset;
        $curl_return = goCurl($url, null, "GET", FALSE);

        if ($curl_return['Success'] == false) {
            return view('errors.500')->withErrors($curl_return['Desc']);
        } else {
            // $curl_data = json_decode($curl_return['ResponseData'], true);

            if(count($curl_return['ResponseData']['items']) == 0 && $offset == 0)
            {
                return ([
                    'Success'=>false,
                    'Status'=>"404",
                    'Message'=>"No records"]);
            }


            else if(count($curl_return['ResponseData']['items']) == 0 && $offset > 0)
            {
                return ([
                    'Success'=>false,
                    'Status'=>"204",
                    'Message'=>"No further records"]);
            }

            else
            {
                foreach ($curl_return['ResponseData']['items'] as $key => $playlist) {
                    if (Playlist::where('id', '=', $playlist['id'])->exists()) {
                        $curl_return['ResponseData']['items'][$key]['db'] = true;
                    } else {
                        $curl_return['ResponseData']['items'][$key]['db'] = false;
                    }
                }

                return view('loaders.user_playlists')->with('Playlists', $curl_return['ResponseData']['items'])
                ->with('get_all_page','get_all_page');
            }

        }
    }

    public function getAllPlaylistsRecordsforUser(Request $request) {

        $offset = 0;
        $limit = 10;

        if(isset($request['offset']))
        {
            $offset = $request['offset'];

        }

        if(isset($request['items']))
        {
            $limit = $request['items'];

        }

        if(!isset($request['id']))
        {
            return (['Success' => false,
                'Status' => "404"]);
        }


        $url = "https://api.spotify.com/v1/users/".$request['id']."/playlists?limit=".$limit."&offset=".$offset;
        $curl_return = goCurl($url, null, "GET", FALSE);

        if ($curl_return['Success'] == false) {
            return view('errors.500')->withErrors($curl_return['Desc']);
        } else {
            // $curl_data = json_decode($curl_return['ResponseData'], true);

            if(count($curl_return['ResponseData']['items']) == 0 && $offset == 0)
            {
                return ([
                    'Success'=>false,
                    'Status'=>"404",
                    'Message'=>"No records"]);
            }


            else if(count($curl_return['ResponseData']['items']) == 0 && $offset > 0)
            {
                return ([
                    'Success'=>false,
                    'Status'=>"204",
                    'Message'=>"No further records"]);
            }

            else
            {
                foreach ($curl_return['ResponseData']['items'] as $key => $playlist) {
                    if (Playlist::where('id', '=', $playlist['id'])->exists()) {
                        $curl_return['ResponseData']['items'][$key]['db'] = true;
                    } else {
                        $curl_return['ResponseData']['items'][$key]['db'] = false;
                    }
                }

                return view('loaders.user_playlists_user')->with('Playlists', $curl_return['ResponseData']['items'])
                    ->with('get_all_page','get_all_page');
            }

        }
    }



    public function getWallRecords(Request $request)
    {

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

        if(Playlist::count() == 0){
            return ([
                'Success'=>false,
                'Status'=>"404",
                'Message'=>"No records"]);
        }


        $playlists = Playlist::getAll($offset, $limit);

        if($playlists->count() == 0)
        {
            return ([
                'Success'=>false,
                'Status'=>"204",
                'Message'=>"No further records"]);
        }

        return view('loaders.wall')->with([
            'Status' => "200",
            'Success'=>true,
            'Playlists'=> $playlists]);
    }

    /**
     *
     */
    public function addPlaylist(Request $request) {

        //Check if URL of a Playlist is received
        if (!isset($request->url)) {
            $return_array = array(
                "Success" => false,
                "Desc" => "CAN NOT OBTAIN PLAYLIST ID FROM URL"
            );

            return $return_array;
        } else {
            // Grab vairiables from request
            $playlist_id = $request->url;

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



            $exploded = explode('/',$request->url);


            /*
             * CURL Request PUT Data
             */
            $url = "https://api.spotify.com/v1/playlists/" . end($exploded) . "/followers";

            $body = array(
                "public" => false
            );



            $curl_return = goCurl($url, $body, "PUT", TRUE);
            if(strpos($curl_return['Header'],'200') == false)
                return ([
                    'Success' => false
                ]);
            else
                return ([
                    'Success' => true,
                    'id' => end($exploded)
                ]);
        }
    }





    /**
     * This function gets playlist information from spotify server after
     * receiving ID from URL parameters.
     * Function complexity: Iteratively pings Spotify Servers if
     * hit by the url, saves old instances, whenever records are
     * more than 100, and request record is 100+, it pings spotify again
     * and merges new and old data
     */
    public function getPlayListDetails(Request $request) {

        $request->validate([
            'items' => 'bail|required',
            'page' => 'required',
        ]);


        $playlist = Playlist::find($request->id);
        $items = $request->input('items');
        $page = $request->input('page');
        $high = $items * $page;
        $offset = ($page - 1) * $items;
        $total = $playlist->total_tracks;
        $remainder = $total % $items;

        if ($remainder) {
            $temp = $total / $items;
            $total = ($temp + 1) * $items;
        }


        if ($high > $total) {
            return ([
                "Success"=>false,
                "Status" => "404",
            "Message" => "No further records, invalid page index"]);
        } else {

            $url = 'https://api.spotify.com/v1/playlists/' . $request->id . '/tracks?offset=' . $offset . '&limit=' . $items;
            $return = $this->getPlayListInner($url, false);

            if ($return['Success'] == false) {
                if ($return['Code'] == "exp_session")
                    return view('/')->withErrors([$return['Desc']]);

                return $return;
            }
            else {
                return view('loaders/table')->with([
                    'Response' => $return,
                    'Offset' => $offset]);
            }
        }


    }

    public function insertPlaylist(Request $request) {
        //the following function calculates all data, and inserts into DB so this function is just a wrapper
        if($this->refreshCalculateEveryRecord($request)["Success"]){
            return redirect('playlist/open-playlist/'.$request->id);
        }else{
            return view('errors.500');
        }
        // return $this->refreshCalculateEveryRecord($request);
    }

    public function refreshCalculateEveryRecord(Request $request) {


        $limit = 100;

        $iterations = 1;
        $current_iteration = 0;
        $offset = 0;
        $return = null;


        while ($current_iteration < $iterations) {

            if ($current_iteration == 0) {
                $url = 'https://api.spotify.com/v1/playlists/' . $request->id;
            } else {
                $url = 'https://api.spotify.com/v1/playlists/' . $request->id . '/tracks?offset=' . $offset . '&limit=' . $limit;
            }
            $return = $this->getPlayListInner($url, true, $current_iteration, $return);

            if ($return['Success'] == false) {
                if ($return['Code'] == "exp_session") {
                    return view('relogin')->withErrors([$return['Desc']]);
                }
                return $return;                                                                         //error page goes here
            }

            if ($current_iteration == 0) {
                $iterations = ceil($return['ResponseData']['tracks']['total'] / $limit);
            }

            $offset+=$limit;
            $current_iteration++;
        }



        $imageToInsert = findAndGetCover(($return['ResponseData']['images']), 'playlists/'.$return['ResponseData']['id'].'.jpg');
        $repeatedArtist = $this->findMostRepeatedArtist($return['ResponseData']);
        $averagedValues = $this->findAveragedTrackFeatures($return['TrackFeatures'], $return['ResponseData']['tracks']);

        if (Playlist::where('id', '=', $request->id)->exists()) {
            $playlist = Playlist::find($request->id);
        } else {
            $playlist = new Playlist();
        }

        $playlist->id = $return['ResponseData']['id'];
        $playlist->title = $return['ResponseData']['name'];
        $playlist->added_by = session::get('UserInfo')['id'];
        $playlist->added_by_name = session::get('UserInfo')['display_name'];
        $playlist->repeated_artist = $repeatedArtist['RepeatedArtist']['name'];
        $playlist->repeated_artist_id = $repeatedArtist['RepeatedArtist']['id'];
        $playlist->creator_name = $return['ResponseData']['owner']['display_name'];
        $playlist->creator_id = $return['ResponseData']['owner']['id'];
        $playlist->instrumentalness = $averagedValues['Instrumentalness'];
        $playlist->liveness = $averagedValues['Liveness'];
        $playlist->Loudness = $averagedValues['Loudness'];
        $playlist->speechiness = $averagedValues['Speechiness'];
        $playlist->tempo = $averagedValues['Tempo'];
        $playlist->followers = $return['ResponseData']['followers']['total'];
        $playlist->danceability = $averagedValues['Danceability'];
        $playlist->popularity = $averagedValues['Popularity'];
        $playlist->energy = $averagedValues['Energy'];
        $playlist->valence = $averagedValues['Valence'];
        $playlist->total_tracks = $return['TotalRecords'];
        $playlist->calculated_tracks = true;
        $playlist->cover = $imageToInsert['Success'];
        $playlist->save();

        /*

          $this->findMostRepeatedArtist($return['ArtistGenres']);
          $this->findAveragedTrackFeatures($return['TrackFeatures'], $return['ResponseData']);

          /*echo"<pre>";
          print_r($return['TrackFeatures']);
          exit();
          $playlist = Playlist::find($request->id);
          $playlist
          $playlist->repeated_artist = $return['RepeatedArtist']['name'];
          $playlist->repeated_artist_id = $return['RepeatedArtist']['id'];
          $playlist->danceability = $return['Danceability'];
          $playlist->popularity = $return['Popularity'];
          $playlist->energy = $return['Energy'];
          $playlist->valence = $return['Valence'];
          $playlist->calculated_tracks = true;
          $playlist->save(); */

        return ([
            'Success' => true,
            'id' => $return['ResponseData']['id']]);
    }


    public function refresh(Request $request) {

        if($this->refreshCalculateEveryRecord($request)['Success'] == true) {
            return ($this->getPlayList($request));
        }

        else {

            return ("an error occured in refresh@PlayListController");
        }

    }

    public function getPlayList(Request $request) {
        $playlist_id = $request->id;
        $uri = $request->path();

        if (Playlist::where('id', '=', $playlist_id)->exists()) {

            $playlist = Playlist::find($request->id);
            $playlist["timeNow"] = $this->timeago($playlist['created_at']);
            if($uri == "playlist/get/".$request->id){

                return view('playlist')->with([
                            'Playlist' => $playlist,
                            'Rate'  => (new PlaylistRatingsController)->get($request->id, session::get('UserInfo')['id'])
                ]);
            }
            else{
                /*echo "<pre>";
                print_r($playlist);
                exit();*/
                return view('playlistinfo')->with([
                    'Playlist' => $playlist]);
            }
        } else {

            return view('home')->withErrors('This playlist doesn\'t exist in our system. Please add it first.');
        }

        /* $repeatedArtist = $this->findMostRepeatedArtist($return['ArtistGenres']);
          $averagedValues = $this->findAveragedTrackFeatures($return['TrackFeatures'], $return['ResponseData']['tracks']);

          $playlist->id = $return['ResponseData']['id'];
          $playlist->title = $return['ResponseData']['name'];
          $playlist->repeated_artist = $repeatedArtist['RepeatedArtist']['name'];
          $playlist->repeated_artist_id = $repeatedArtist['RepeatedArtist']['id'];
          $playlist->creator_name = $return['ResponseData']['owner']['display_name'];
          $playlist->creator_id = $return['ResponseData']['owner']['id'];
          $playlist->rating = 0;
          $playlist->followers = $return['ResponseData']['followers']['total'];
          $playlist->danceability = $averagedValues['Danceability'];
          $playlist->popularity = $averagedValues['Popularity'];
          $playlist->energy = $averagedValues['Energy'];
          $playlist->valence = $averagedValues['Valence'];
          $playlist->total_tracks = $return['TotalRecords'];
          $playlist->calculated_tracks = null;

          $playlist->save();



          return view('playlist')->with([
          'ResponseData' => $return['ResponseData'],
          'RepeatedArtist' => $repeatedArtist,
          'Averages' => $averagedValues]); */
    }

    /**
     *
     */
    private function getPlayListInner($url, $commulative, $iteration = 0, $data = null) {

        $curl_return = goCurl($url, null, 'GET', False);
        if ($curl_return['Success'] == false)
            return $curl_return;
        else {
            $TrackFeatures = $this->getTrackAttributes($curl_return['ResponseData']);

            if ($TrackFeatures['Success'] == false)
                return ("$TrackFeatures");
            else {
                    if (!isset($curl_return['ResponseData']['tracks'])) {
                        if ($commulative && $iteration > 0) {

                            $tempMain = $data['ResponseData'];
                            $tempTracks = array_merge($data['ResponseData']['tracks'], $curl_return['ResponseData']['items']);
                            $tempMain['tracks'] = $tempTracks;
                            $tempFeatures = array_merge($data['TrackFeatures'], $TrackFeatures['audio_features']);
                            //$tempArtists = array_merge($data['ArtistGenres'], $ArtistGenres);
                            $tempTotal = $data['TotalRecords'];


                            $return = [
                                'Success' => true,
                                'ResponseData' => $tempMain,
                                'TrackFeatures' => $tempFeatures,
                                //'ArtistGenres' => $tempArtists,
                                'TotalRecords' => $tempTotal
                            ];
                            return $return;
                        } else {

                            $ArtistGenres = $this->getArtistGenres($curl_return['ResponseData']);

                            if ($ArtistGenres['Success'] == false)
                                return ([
                                    'Success' => false,
                                    'Code' => "error_artists"
                                ]);
                            else {
                                $total_tracks = 0;
                                if (isset($curl_return['ResponseData']['tracks'])) {
                                    $total_tracks = $curl_return['ResponseData']['tracks']['total'];
                                }
                                $return = [
                                    'Success' => true,
                                    'TrackFeatures' => $TrackFeatures['audio_features'],
                                    'ResponseData' => $curl_return['ResponseData'],
                                    'ArtistGenres' => $ArtistGenres,
                                    'TotalRecords' => $total_tracks,
                                ];

                                return $return;
                            }
                        }
                    } else {

                        $ArtistGenres = $this->getArtistGenres($curl_return['ResponseData']);

                        if ($ArtistGenres['Success'] == false)
                            return $ArtistGenres;
                        else {
                            $total_tracks = 0;

                            if (isset($curl_return['ResponseData']['tracks'])) {
                                $total_tracks = $curl_return['ResponseData']['tracks']['total'];
                            }

                            $return = [
                                'Success' => true,
                                'TrackFeatures' => $TrackFeatures['audio_features'],
                                'ResponseData' => $curl_return['ResponseData'],
                                'ArtistGenres' => $ArtistGenres,
                                'TotalRecords' => $total_tracks,
                            ];

                            return $return;
                        }


                    }
                }
            }
    }

    public function cmp($a, $b) {
        return strcmp($a['name'], $b['name']);
    }

    public function mostFrequent($arr, $n) {

        // Sort the array
        usort($arr, array($this, 'cmp'));
        // find the max frequency
        // using linear traversal
        $max_count = 1;
        $res = $arr[0];
        $curr_count = 1;
        for ($i = 1; $i < $n; $i++) {
            if ($arr[$i]['name'] == $arr[$i - 1]['name'])
                $curr_count++;
            else {
                if ($curr_count > $max_count) {
                    $max_count = $curr_count;
                    $res = $arr[$i - 1];
                }
                $curr_count = 1;
            }
        }

        // If last element
        // is most frequent
        if ($curr_count > $max_count) {
            $max_count = $curr_count;
            $res = $arr[$n - 1];
        }




        return $res;
    }

    public function findMostRepeatedArtist($main) {



        $artists = array();

        foreach($main['tracks']['items'] as $item)
        {
            foreach($item['track']['artists'] as $artist)
            {
                array_push($artists, $artist);

            }
        }

        if (count($artists) > 1) {

            if (count($artists) > 2) {
                $return = $this->mostFrequent($artists, count($artists));

                if ($return == '1') {
                    $return = $artists[0];
                }
            } else {

                $return = $artists[0];
            }

            $return = [
                'Success' => true,
                'RepeatedArtist' => $return
            ];

            return $return;
        } else {
            $return = [
                'Success' => true,
                'RepeatedArtist' => ([
            'name' => 'none',
            'id' => 'none'])
            ];

            return $return;
        }
    }

    public function findAveragedTrackFeatures($tracks, $main) {
        $danceability = 0;
        $energy = 0;
        $popularity = 0;
        $valence = 0;
        $speechiness= 0;
        $tempo= 0;
        $instrumentalness= 0;
        $liveness= 0;
        $loudness= 0;

        if (!isset($tracks['audio_features'])) {
            $count = count($tracks);
            foreach ($tracks as $track) {
                $danceability+=$track['danceability'];
                $energy+=$track['energy'];
                $valence+=$track['valence'];
                $speechiness+=$track['speechiness'];
                $tempo+=$track['tempo'];
                $instrumentalness+=$track['instrumentalness'];
                $liveness+=$track['liveness'];
                $loudness-=($track['loudness']);
            }

            if (!isset($main['tracks']))
                foreach ($main['items'] as $playlist) {
                    $popularity+=$playlist['track']['popularity'];
                } else
                foreach ($main['tracks']['items'] as $playlist) {
                    $popularity+=$playlist['track']['popularity'];
                }
        } else {
            $count = count($tracks['audio_features']);
            foreach ($tracks['audio_features'] as $track) {
                $danceability+=$track['danceability'];
                $energy+=$track['energy'];
                $valence+=$track['valence'];
                $speechiness+=$track['speechiness'];
                $tempo+=$track['tempo'];
                $instrumentalness+=$track['instrumentalness'];
                $liveness+=$track['liveness'];
                $loudness-=$track['loudness'];
            }

            foreach ($main['tracks']['items'] as $playlist) {
                $popularity+=$playlist['track']['popularity'];
            }
        }

        if($danceability<0)
            $danceability = 0;
        if($energy<0)
            $energy = 0;
        if($popularity<0)
            $energy = 0;
        if($valence<0)
            $valence = 0;
        if($speechiness<0)
            $speechiness = 0;
        if($loudness<0)
            $loudness = 0;
        if($instrumentalness<0)
            $instrumentalness = 0;
        if($liveness<0)
            $liveness = 0;
        if($tempo<0)
            $tempo = 0;

        
        $return = [
            'Success' => true,
            'Danceability' => round(($danceability / $count)*100),
            'Energy' => round(($energy / $count)*100),
            'Popularity' => round(($popularity / $count)),
            'Valence' => round(($valence / $count)*100),
            'Speechiness' => round(($speechiness/$count)*100),
            'Tempo' => round((($tempo/$count)/200)*100),
            'Instrumentalness' => round(($instrumentalness/$count)*1000),
            'Liveness' => round(($liveness/$count)*100),
            'Loudness' =>  round(($loudness/$count)),
        ];

        return $return;
    }

    /**
     * Limit and offset query parameters on spotify api are broken.
     * A common issue that is found over internet right now.
     * Solution implemented: As maximum ids requested to Spotify API
     * are 50, and Playlist's minimum record received is 100,
     * I am dividing received records into two dynamic equal chunks.
     */
    private function getTrackAttributes($playlist) {
        $track_ids = "";
        $toAppend = "";

        if (isset($playlist['tracks'])) {
            foreach ($playlist['tracks']['items'] as $track) {
                $track_ids = $track_ids . $toAppend;
                $track_ids = $track_ids . $track['track']['id'];
                $toAppend = '%2C';
            }
        } else {
            foreach ($playlist['items'] as $track) {
                $track_ids = $track_ids . $toAppend;
                $track_ids = $track_ids . $track['track']['id'];
                $toAppend = '%2C';
            }
        }


        $url = "https://api.spotify.com/v1/audio-features?ids=" . $track_ids;

        $curl_return = goCurl($url, null, 'GET', false);

        if ($curl_return['Success'] == false) {
            return $curl_return;
        } else {
            $curl_return['ResponseData']['Success'] = true;
            return $curl_return['ResponseData'];
        }
    }

    /**
     *
     */
    private function getArtistGenres($playlist) {



        $ArtistGenres = array();
        $artist_ids = "";
        $toAppend = "";
        $limit = 50;

        if (!isset($playlist['tracks']))
            $count_records = count($playlist['items']);
        else
            $count_records = count($playlist['tracks']['items']);

        /*
        $counter = 0;

        for ($i = 0; $i < $count_records;) {
            if (!isset($playlist['tracks']))
                $artist_count = count($playlist['items'][$i]['track']['artists']);
            else
                $artist_count = count($playlist['tracks']['items'][$i]['track']['artists']);


            while ($i < $count_records && $counter + $artist_count < $limit) {

                if (!isset($playlist['tracks']))
                    $temp = $playlist['items'][$i]['track']['artists'];
                else
                    $temp = $playlist['tracks']['items'][$i]['track']['artists'];


                foreach ($temp as $artist) {
                    $artist_ids = $artist_ids . $toAppend;
                    $artist_ids = $artist_ids . $artist['id'];
                    $toAppend = '%2C';
                }

                $counter += $artist_count;
                $i++;

                if ($i < $count_records)
                    if (!isset($playlist['tracks']))
                        $artist_count = count($playlist['items'][$i]['track']['artists']);
                    else
                        $artist_count = count($playlist['tracks']['items'][$i]['track']['artists']);
            }

            $url = 'https://api.spotify.com/v1/artists?ids=' . $artist_ids;


            $curl_return = goCurl($url, null, 'GET', false);

            if ($curl_return['Success'] == false) {

                return $curl_return;
            } else {
                $ArtistGenres = array_merge($ArtistGenres, $curl_return['ResponseData']['artists']);
            }


            $artist_ids = '';
            $toAppend = '';
            $counter = 0;
        }*/



          $start = 0;
          $iterations = ceil($count_records/($limit+1));

          for($i = 0; $i < $iterations; $i++)
          {

          if(!isset($playlist['tracks']))
          foreach(array_slice($playlist['items'], $start, $limit) as $track)
          {

          $artist_ids = $artist_ids.$toAppend;
          if(isset($track['track']['artists'][0]['id']))
          $artist_ids = $artist_ids.$track['track']['artists'][0]['id'];
          else
          $artist_ids = $artist_ids."123";
          $toAppend = '%2C';
          //$artist_ids = $artist_ids.$track['track']['artists'][0]['id'];

          }
          else
          foreach(array_slice($playlist['tracks']['items'], $start, $limit) as $track)
          {
          // $artist_ids = $artist_ids.$toAppend;

          $artist_ids = $artist_ids.$toAppend;
          if(isset($track['track']['artists'][0]['id']))
          $artist_ids = $artist_ids.$track['track']['artists'][0]['id'];
          else
          $artist_ids = $artist_ids."123";
          $toAppend = '%2C';
          //$artist_ids = $artist_ids.$track['track']['artists'][0]['id'];


          }

          
          $url = 'https://api.spotify.com/v1/artists?ids='.$artist_ids;
          $curl_return = goCurl($url, null, 'GET', false);

        

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

    public function openPlaylist(Request $request){
        
        $playlist_id = $request->id;
        $uri = $request->path();
        if (Playlist::where('id', '=', $playlist_id)->exists()) {

            $playlist = Playlist::find($request->id);
            
            $playlist->rating = $playlist->calculateRating();
            $playlist->save();

            $playlist["timeNow"] = $this->timeago($playlist['created_at']);
            $data = [];
            $data["Playlist"] = $playlist;
            $data["user"] = session::get('UserInfo');
            if(file_exists('users/'. session::get('UserInfo')['id'].'.jpg')){
                $data["user"]['profileImage'] = '/users/'. session::get('UserInfo')['id'].'.jpg';
            }else{
                $data["user"]['profileImage'] = '/images/default_user.png';
            }

            $data["tots_comments"] = Playlist::find($playlist['id'])->comment()->count();
            $data["user_rating"] = $playlist->getRating(session::get('UserInfo')['id']);

            return view('openplaylists')->with($data);
        } else {

            return view('home')->withErrors('This playlist doesn\'t exist in our system. Please add it first.');
        }
        // return view('openplaylists');
    }  

    /**
     *
     */

    function timeago($ptime) {

        $difference = time() - strtotime($ptime);
        if ($difference) {
            $periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
            $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
            for ($j = 0; $difference >= $lengths[$j]; $j++)
                $difference /= $lengths[$j];

            $difference = round($difference);
            if ($difference != 1)
                $periods[$j] .= "s";

            $text = "$difference $periods[$j] ago";


            return $text;
        }else {
            return ' Just Now';
        }
    }

}
