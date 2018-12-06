<?php

namespace App\Http\Controllers;

use App\PlaylistRating;
use App\Playlist_Other_tag;
use App\Http\Controllers\Data\PlaylistRatingsController;
use App\Playlist;
use App\Comment;
use App\User;
use App\Other_tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

/**
 * TODO: Handle empty response bug from CURL when Spotify api sends no error and no response.
 */
class PlayListController extends Controller {



    public function tagsWallSpecific(Request $request){

        
        $other_tag = Other_tag::find($request->tag_id);


        if(!isset($other_tag)){
            return "No tag with this id was found. Are you sure you were redirected automatically?";
        }else{


            $playlists = $other_tag->playlist()->get();
            $playlists_temp = [];


            foreach ($playlists as $key => $value) {
                $playlists_temp[$value->id]['object'] = $value;
            }

            return view('top_tags')->with([
             'Playlists' => $playlists_temp,
             'Tags' => Null,
             'Title' => "Playlists with Tag : ".$other_tag->name
            ]);

        }
        

    }



    public function tagsWall(Request $request){

        $collection = Playlist_Other_tag::groupBy('other_tag_id')
            ->selectRaw('other_tag_id, count(other_tag_id)')
            ->orderBy('count(other_tag_id)', 'DESC')
            ->take(10)
            ->get();

        $tempTagIds = [];


        foreach ($collection as $key => $value) {
            array_push($tempTagIds, $value->other_tag_id);
        }


        $playlist_ids  = Playlist_Other_tag::whereIn('other_tag_id',$tempTagIds)->get();

        $tempPlaylistIds  = [];

        $playlists = [];

        foreach ($playlist_ids as $key => $value) {
            $playlists[$value->playlist_id] = []; 
            array_push($tempPlaylistIds, $value->playlist_id);
            // array_push($tempPlaylistIds, [$value->playlist_id, $value->other_tag_id]);
        }

        $playlistCollection = Playlist::whereIn('id', $tempPlaylistIds)->get();

        foreach ($playlist_ids as $key => $value) {
            $playlists[$value->playlist_id][] = $value->other_tag_id;
            $plalists[$value->playlist_id]['object'] = []; 
        }
        

        $tags = [];

        $tagsCollection = Other_tag::whereIn('id', $tempTagIds)->get();

        foreach ($tagsCollection as $key => $value) {
            $tags[$value->id] = $value->name;
        }

        foreach ($playlistCollection as $key => $value) {
                    
            $playlists[$value->id]['object'] = $value;

        } 

        return view('top_tags')->with([
             'Playlists' => $playlists,
             'Tags' => $tags,
             'Title' => "Top Tags"
        ]);

    }


    /**
     * PART OF THIS END POINT NEEDS TO BE MOVED TO THE CORESPONDING MODEL 
     */
    

    public function advanced_search(Request $request){

        $request->validate([
            'data.valence'=> 'required',
            'data.speechiness' => 'required',
            'data.valence' => 'required',
            'data.instrumentalness' => 'required',
            'data.liveness' => 'required',
            'data.loudness' => 'required',
            'data.tempo' => 'required',
            'data.popularity' => 'required',
            'data.danceability' => 'required',
            'data.energy' => 'required',
            'data.acousticness' => 'required',
            'data.rating' => 'required',
            'data.genres' => 'required',
            'data.artists' => 'required',
            'data.tags' => 'required',
            'data.year' => 'required',
        ]);
        
        $data = [];
        $data['speechiness'][0] = (int)$request->data['speechiness'][0];
        $data['speechiness'][1] = (int)$request->data['speechiness'][1];
        $data['valence'][0] = (int)$request->data['valence'][0];
        $data['valence'][1] = (int)$request->data['valence'][1];
        $data['instrumentalness'][0] = (int)$request->data['instrumentalness'][0];
        $data['instrumentalness'][1] = (int)$request->data['instrumentalness'][1];
        $data['liveness'][0] = (int)$request->data['liveness'][0];
        $data['liveness'][1] = (int)$request->data['liveness'][1];
        $data['loudness'][0] = (int)$request->data['loudness'][0];
        $data['loudness'][1] = (int)$request->data['loudness'][1];
        $data['tempo'][0] = (int)$request->data['tempo'][0];
        $data['tempo'][1] = (int)$request->data['tempo'][1];
        $data['popularity'][0] = (int)$request->data['popularity'][0];
        $data['popularity'][1] = (int)$request->data['popularity'][1];
        $data['danceability'][0] = (int)$request->data['danceability'][0];
        $data['danceability'][1] = (int)$request->data['danceability'][1];
        $data['energy'][0] = (int)$request->data['energy'][0];
        $data['energy'][1] = (int)$request->data['energy'][1];
        $data['acousticness'][0] = (int)$request->data['acousticness'][0];
        $data['acousticness'][1] = (int)$request->data['acousticness'][1];
        $data['rating'][0] = (int)$request->data['rating'][0];
        $data['rating'][1] = (int)$request->data['rating'][1];
        $data['year'][0] = (int)$request->data['year'][0];
        $data['year'][1] = (int)$request->data['year'][1];
        $data['genres'] = $request->data['genres'];
        $data['artists'] = $request->data['artists'];
        $data['tags'] = $request->data['tags'];
        $data['type'] = $request->data['type'];
       

        $tags_flag = FALSE;
        $genres_flag = FALSE;
        $artists_flag = FALSE;


        $sql = "";

        if($data['tags'] != 'empty'){

            $tags_flag = TRUE;

            $tags = explode(" ",$data['tags']);

            $other_tags = Other_tag::whereIn('name', $tags)->get();
            $temp = "";
            $count = 0;

            foreach ($other_tags as $key => $value) {
                if($key != 0){
                    $temp = $temp . ",";
                }
                $temp = $temp . $value->id;
                $count++;
            }
            
            if($count ){
                if($data['type']==1){
                 $sql = "select * from playlists where id in (select playlist_id from playlist_other_tags where other_tag_id in (".$temp.")) ";}
                  else {
                     $sql = "select title as Name, popularity as Popularity, danceability as Danceability, energy as Energy, valence as Valence, instrumentalness as Instrumentalness, liveness as Liveness, loudness as Loudness, speechiness as Speechiness, tempo as BPM, acousticness as Acousticness, average_release_year as `Average Release Year` from playlist_other_tags where other_tag_id in (".$temp.")";
                  }
                }
               
            else if($data['type']==1){
            $sql = "select * from playlists where id < 0 ";}
            else{
                    $sql =  "select title as Name, popularity as Popularity, danceability as Danceability, energy as Energy, valence as Valence, instrumentalness as Instrumentalness, liveness as Liveness, loudness as Loudness, speechiness as Speechiness, tempo as BPM, acousticness as Acousticness, average_release_year as `Average Release Year` from playlists where id < 0";
                }

            }else if($data['type']==1){
                $sql = "select * from playlists where id > 0 ";
            }
            else{
                $sql = "select title as Name, popularity as Popularity, danceability as Danceability, energy as Energy, valence as Valence, instrumentalness as Instrumentalness, liveness as Liveness, loudness as Loudness, speechiness as Speechiness, tempo as BPM, acousticness as Acousticness, average_release_year as `Average Release Year` from playlists where id > 0";
                }
            

        

        if($data["genres"] != 'empty'){

 
            $genres = explode(" ",$data['genres']);

            $sql = $sql . " and repeated_genre REGEXP '";

            foreach ($genres as $key => $value) {
                
                $sql = $sql . $value . "|";
            }
            
            $sql = rtrim($sql, "|");
            $sql = $sql . "'";
        }

        if($data["artists"] != 'empty'){

 
            $artists = explode(" ",$data['artists']);

            $sql = $sql . " and repeated_artist REGEXP '";

            foreach ($artists as $key => $value) {
                
                $sql = $sql . $value . "|";
            }
            
            $sql = rtrim($sql, "|");
            $sql = $sql . "'";
        }


            $sql = $sql .  " and rating between ".$data['rating'][0]." and ".$data['rating'][1]." ";
            $sql = $sql .  " and popularity between ".$data['popularity'][0]." and ".$data['popularity'][1]." ";
            $sql = $sql .  " and instrumentalness between ".$data['instrumentalness'][0]." and ".$data['instrumentalness'][1]." ";
            $sql = $sql .  " and speechiness between ".$data['speechiness'][0]." and ".$data['speechiness'][1]." ";
            $sql = $sql .  " and danceability between ".$data['danceability'][0]." and ".$data['danceability'][1]." ";
            $sql = $sql .  " and valence between ".$data['valence'][0]." and ".$data['valence'][1]." ";
            $sql = $sql .  " and energy between ".$data['energy'][0]." and ".$data['energy'][1]." ";
            $sql = $sql .  " and loudness between ".$data['loudness'][0]." and ".$data['loudness'][1]." ";
            $sql = $sql .  " and acousticness between ".$data['acousticness'][0]." and ".$data['acousticness'][1]." ";
            $sql = $sql .  " and liveness between ".$data['liveness'][0]." and ".$data['liveness'][1]." ";
            $sql = $sql .  " and tempo between ".$data['tempo'][0]." and ".$data['tempo'][1]." ";
            $sql = $sql .  " and average_release_year between ".$data['year'][0]." and ".$data['year'][1]." ";

            $sql = $sql . " LIMIT 500";

            try{
                $playlists = DB::select($sql);
            }catch(Exception $e){
                return ([
                    'Success' => false,
                    'Message' => $e->getMessage()
                ]);
            }
            
        if($data['type'] == 2){
            return ([
                'Status' => "200",
                'Success'=>true,
                'Playlists'=> $playlists,
                'FromTag'=> FALSE]);

        }else{
        return view('loaders.wall_1')->with([
            'Status' => "200",
            'Success'=>true,
            'Playlists'=> $playlists,
            'FromTag'=> FALSE]);
        }
    }

    public function insertplaylistData($playlist_id,$user_id,$tagged_by_user_Id,$tagged_by_user_name, $is_viewed = 0) {
        try {
                            //$user = $user->playlist()->attach($request->id);
                            $data = [
                                'playlist_id' => $playlist_id,
                                'user_id' => $user_id,
                                'is_viewed' => $is_viewed,
                                'tagged_by_user_id' => $tagged_by_user_Id,
                                'tagged_by_user_name' => $tagged_by_user_name
                            ];
                            
                            $result = DB::table('playlist_user')->insert($data);

                            
                  
                        }catch (\Exception $e) {
                            return ([
                                'Success' => false,
                                'Error' => $e->getMessage()
                            ]);
                    
                        }
                return ([
                    'Success'=> true
                ]);
        
    }

    public function getTaggedPlaylists(Request $request) {

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
        $playlists = Playlist::getTaggedPlaylists(session::get('UserInfo')['id'], $offset, $limit);

        if(Playlist::count() == 0){
            return ([
                'Success'=>false,
                'Status'=>"404",
                'Message'=>"No records"]);
        }



    
        if(count($playlists) == 0)
        {
            return ([
                'Success'=>false,
                'Status'=>"204",
                'Message'=>"No further records"]);
        }

        return view('loaders.tagged-wall')->with([
            'Status' => "200",
            'Success'=>true,
            'Playlists'=> $playlists,
            'FromTag'=>TRUE]);
    }

    public function tagUser(Request $request){

        $query = "";
        

        if(!isset($request->data)){

            return ([
                'Success' => false,
                'Error' => 'user_id empty or user to tag not found'
            ]);
        }else {

            $tempToAddinOthers = [];


            foreach ($request->input('data') as $x) {

                if(User::where('id', '=', $x)->exists())
                {
                    $user = User::find($x);

                    if (!$user->playlist->contains($request->id)){
                         
                       $result = $this->insertplaylistData($request->id,$x,session::get('UserInfo')['id'],session::get('UserInfo')['display_name']);
                        if($result['Success']==false)
                        {
                            return $result;
                        }
                    }


                }else{
                    array_push($tempToAddinOthers, $x);
                }
            }

            $other_tags_that_added = [];


            foreach($tempToAddinOthers as $x){

                if(Other_tag::where('id', '=', $x)->exists()){
                    $other_tag = Other_tag::where('id', '=', $x)->get();
                    $temp = $other_tag[0]->name;
                    $result = Playlist::insertOtherTag($request->id, $other_tag[0]['id']);
                    
                }else{

                    $other_tag = new Other_tag();
                    $other_tag->name = $x;
                    $temp = $x;
                    $other_tag->save();

                    $result = Playlist::insertOtherTag($request->id, $other_tag['id']);
                

                }
                
                array_push($other_tags_that_added, $temp);


                if($result['Success']==false)
                {
                    return $result;
                }

                

            }
            
            $users = User::findMany($request->input('data'));
            

            return ([
                        'Success' => true,
                        'Data' => "User tagged",
                        'Users' => $users,
                        'Tags' => $other_tags_that_added
                    ]);

            
        }


    }


    
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

            if($limit > 100){
                $limit = 100;
            }

        }


        $url = "https://api.spotify.com/v1/me/playlists?limit=".$limit."&offset=".$offset;
        $curl_return = goCurl($url, null, "GET", FALSE);
        
        if ($curl_return['Success'] == false) {
            return $url;
            return view('errors.500')->withErrors($curl_return);
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

    public function getUserWallRecords(Request $request)
    {

        $offset = 0;
        $limit = 2;
        $type = 2;

        if(isset($request['type'])){
            $type = $request['type'];
        }


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

             
 

        $playlists = Playlist::getAllofUser($offset, $limit, $request->id);

        if($playlists->count() == 0)
        {
            return ([
                'Success'=>false,
                'Status'=>"204",
                'Message'=>"No further records"]);
        }

        if($type == '2'){
            return view('loaders.wall_compact')->with([
                'Status' => "200",
                'Success'=>true,
                'Playlists'=> $playlists,
                'FromTag'=> FALSE]);

        }else{
        return view('loaders.wall')->with([
            'Status' => "200",
            'Success'=>true,
            'Playlists'=> $playlists,
            'FromTag'=> FALSE]);
        }
    }


    public function getWallRecords(Request $request)
    {

        $offset = 0;
        $limit = 2;
        $type = 2;

        if(isset($request['type'])){
            $type = $request['type'];
        }

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

             
 
        if($type == '1')
        {
            $playlists = Playlist::getAll($offset, $limit);
            $count = $playlists->count();
        }
        else 
        {
            $playlists = Playlist::getAllForTable($offset, $limit)['Data'];
            $count = sizeof($playlists);
        }



        if($count == 0)
        {
            return ([
                'Success'=>false,
                'Status'=>"204",
                'Message'=>"No further records"]);
        }

        if($type == '2'){
            return ['data' => $playlists];

        }else{
        return view('loaders.wall')->with([
            'Status' => "200",
            'Success'=>true,
            'Playlists'=> $playlists,
            'FromTag'=> FALSE]);
        }
    }
    
    public function getLibraryRecords(Request $request)
    {
        
        $offset = 0;
        $limit = 2;
        $type = 2;

        if(isset($request['type'])){
            $type = $request['type'];
        }

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
         $sql = "select title as Name, popularity as Popularity, danceability as Danceability, energy as Energy, valence as Valence, instrumentalness as Instrumentalness, liveness as Liveness, loudness as Loudness, speechiness as Speechiness, tempo as BPM, acousticness as Acousticness, average_release_year as `Average Release Year` from playlists ";
        $playlists = DB::select($sql);
                
        $playlists = DB::table('playlists')
                    ->select('*')
                    ->join('playlist_ratings', 'playlist_ratings.playlist_id', '=', 'playlists.id')
                    ->where('playlist_ratings.user_id', session::get('UserInfo')['id'])
                    ->skip($offset)->take($limit)->get();
        


      

        if($playlists->count() == 0)
        {
            return ([
                'Success'=>false,
                'Status'=>"204",
                'Message'=>"No further records"]);
        }


        if($type == '2'){
            $sql = 'select title as Name, popularity as Popularity, danceability as Danceability, energy as Energy, valence as Valence, instrumentalness as Instrumentalness, liveness as Liveness, loudness as Loudness, speechiness as Speechiness, tempo as BPM, acousticness as Acousticness, average_release_year as `Average Release Year` from playlists as p inner join playlist_ratings as pr on pr.playlist_id = p.id where pr.user_id="' . session::get('UserInfo')['id'] . '"';
        $playlists = DB::select($sql);
            return ['data' => $playlists];

        }else{
        return view('loaders.wall_1')->with([
            'Status' => "200",
            'Success'=>true,
            'Playlists'=> $playlists,
            'FromTag'=> FALSE]);
        }

    }

    public function myUserwall(Request $request){
        return view('wall')->with ([
            'page_heading' => 'Playlists Added By '.$request->name,
            'url' => 'playlist/getUserWallRecords'.'/'.$request->id]);
    }
    
    public function mywall(Request $request)
    {
        
        return view('wall')->with ([
            'page_heading' => 'Latest Activity',
            'url' => 'playlist/getWallRecords']);
    }

    public function mywallwithSearch(Request $request)
    {
        
        return view('wall')->with ([
            'page_heading' => 'Advanced Search',
            'url' => 'playlist/getWallRecords']);
    }
    
     public function mylibrary(Request $request)
    {
        
        return view('wall')->with ([
            'page_heading' => 'My Library',
            'url' => 'playlist/getLibraryRecords']);

    }
    
    

    /**
     *
     */
    public function addPlaylist(Request $request) {

 

        $url = $request->input('url');
        //Check if URL of a Playlist is received
        if (!isset($url)) {
            $return_array = array(
                "Success" => false,
                "Desc" => "CAN NOT OBTAIN PLAYLIST ID FROM URL",
                "url" => $url

            );

            return $return_array;
        } else {
            // Grab vairiables from request
            $playlist_id = $request->input('url');

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
            $exploded = explode('?', end($exploded));


            /*
             * CURL Request PUT Data
             */
            $url = "https://api.spotify.com/v1/playlists/" . $exploded[0] . "/followers";

            $body = array(
                "public" => false
            );



            $curl_return = goCurl($url, $body, "PUT", TRUE);
            if(strpos($curl_return['Header'],'200') == false)
            {
                return ([
                    'Success' => false,
                    'curl' => $curl_return,
                    'url' => $url
                ]);
            }
            else
            {


                $temp = session::get('WallRecordsCount') + 1;
                session::put('WallRecordsCount', $temp);
                return ([
                    'Success' => true,
                    'id' => $exploded[0]
                ]);
            }
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
            $temp = session::get('WallRecordsCount') + 1;
                session::put('WallRecordsCount', $temp);
            return redirect('playlist/open-playlist/'.$request->id);
        }else{
            return view('errors.500');
        }
        // return $this->refreshCalculateEveryRecord($request);
    }

    private function getDetailedRecords($playlist_id, $onlyInfo = True, $total_pre_calculated_records = 0){

        $limit = 100;

        if($onlyInfo)
            $iterations = 1;
        else{
            $iterations = ceil($total_pre_calculated_records/$limit);
        } 
        
        $current_iteration = 0;
        $offset = 0;
        $return = null;


        while ($current_iteration < $iterations) {

            if($onlyInfo){
                if ($current_iteration == 0) {
                    $url = 'https://api.spotify.com/v1/playlists/' . $playlist_id;
                } else {
                    $url = 'https://api.spotify.com/v1/playlists/' . $playlist_id . '/tracks?offset=' . $offset . '&limit=' . $limit;
                }
            }else{
                    $url = 'https://api.spotify.com/v1/playlists/' . $playlist_id . '/tracks?offset=' . $offset . '&limit=' . $limit;
            }
            $return = $this->getPlayListInner($url, true, $current_iteration, $return, TRUE);

            if ($return['Success'] == false) {
                if ($return['Code'] == "exp_session") {
                    return view('relogin')->withErrors([$return['Desc']]);
                }
                return $return;                                                                         //error page goes here
            }


            
            // if ($current_iteration == 0) {
            //     if(isset($return['ResponseData']['tracks'])){
            //         $iterations = ceil($return['ResponseData']['tracks']['total'] / $limit);
            //     }else{
            //         $iterations = ceil($return['ResponseData']['total'] / $limit);
            //     }
            // }

            $offset+=$limit;
            $current_iteration++;


            if($onlyInfo){
                break;
            }
        }

        return $return;
    }

    // private function getDetailedRecordsCsv($playlist_id){

    //     $limit = 100;

    //     $iterations = 1;
    //     $current_iteration = 0;
    //     $offset = 0;
    //     $return = null;


    //     while ($current_iteration < $iterations) {

    //         $url = 'https://api.spotify.com/v1/playlists/' . $playlist_id . '/tracks?offset=' . $offset . '&limit=' . $limit;
    //         // if ($current_iteration == 0) {
    //         //     $url = 'https://api.spotify.com/v1/playlists/' . $playlist_id;
    //         // } else {
    //         //     $url = 'https://api.spotify.com/v1/playlists/' . $playlist_id . '/tracks?offset=' . $offset . '&limit=' . $limit;
    //         // }
    //         $return = $this->getPlayListInner($url, true, $current_iteration, $return, TRUE);

    //         if ($return['Success'] == false) {
    //             if ($return['Code'] == "exp_session") {
    //                 return view('relogin')->withErrors([$return['Desc']]);
    //             }
    //             return $return;                                                                         //error page goes here
    //         }

    //         if ($current_iteration == 0) {
    //             $iterations = ceil($return['ResponseData']['total'] / $limit);
    //         }

    //         $offset+=$limit;
    //         $current_iteration++;
    //     }

    //     return $return;
    // }

    public function generateCsvFile($Response, $playlist_id){


        

        // for($i=0; $i<count($response['ResponseData']['items']); $i++){
        
     
        // }


        
        // exit();
        // // foreach ($request['ResponseData']['items'] as $key => $value) {
        
        // // }

        // exit();
        

        // if(is_file($filename)){
        // //     unlink($filename);
        // // }

        
        $line = [];

        array_push($line, "Track No.");
        array_push($line, "Track Name");
        array_push($line, "Artists");
        array_push($line, "Genres");
        array_push($line, "Popularity");
        array_push($line, "Valence");
        array_push($line, "Danceability");
        array_push($line, "Energy");
        array_push($line, "Liveness");
        array_push($line, "Instrumentalness");
        array_push($line, "Loudness");
        array_push($line, "Speechiness");
        array_push($line, "Acousticness");
        array_push($line, "Tempo");
        array_push($line, "Duration_ms");
        array_push($line, "Release Date");

        // echo "<pre>";
        // // print_r($Response);
        // // exit();


        try {

            if (!is_dir('public/playlists_csv')) {
                mkdir("public/playlists_csv", 0777);
            }

            $filename = 'public/playlists_csv/'.$playlist_id.'.csv';

            $file = fopen($filename, 'w');
            
            fputcsv($file, $line);
                
            }catch(Exception $e){

                return([
                    'Success' => false,
                    'Error' => e.getMessage()
                ]);
            }

            $line = [];

        for($i=0; $i<count($Response['ResponseData']['items']); $i++){

            array_push($line, $i + 1);

            $temp = $Response['ResponseData']['items'][$i]['track']['name'];

            str_replace(',', '/', $temp);



            array_push($line, $temp);

            
            $artists_temp = "";

            if(count($Response['ResponseData']['items'][$i]['track']['artists']) == 0)
                    array_push($line, 'Artists not available');
            else{

                for($j=0; $j<count($Response['ResponseData']['items'][$i]['track']['artists']); $j++)
                {
                    
                     $temp = $Response['ResponseData']['items'][$i]['track']['artists'][$j]['name'];
                     $artists_temp = $artists_temp . $temp;
                    

                    if($j<count($Response['ResponseData']['items'][$i]['track']['artists']) -1)
                        $artists_temp = $artists_temp . '/';
                
                }
            }

            array_push($line, $artists_temp);

            $genres_temp = "";

            if(isset($Response['ArtistGenres'][$i]['genres'])){

                if(count($Response['ArtistGenres'][$i]['genres']) == 0)
                        array_push($line, '---');
                else{

                    for($j=0; $j<count($Response['ArtistGenres'][$i]['genres']); $j++){

     
                        $temp = $Response['ArtistGenres'][$i]['genres'][$j];
                        $genres_temp = $genres_temp . $temp;
                        

                        if($j<count($Response['ArtistGenres'][$i]['genres']) -1){
                            $genres_temp = $genres_temp . '/';
                        }
                        
                    }

                    array_push($line, $genres_temp);

                }
            }
            else
                array_push($line, 'Genres not available');
            


        if(isset($Response['ResponseData']['items'][$i]['track']['popularity']))
            array_push($line, $Response['ResponseData']['items'][$i]['track']['popularity']);
        else
            array_push($line, '---');
        

        if(isset($Response['TrackFeatures'][$i]['valence']))
            array_push($line, $Response['TrackFeatures'][$i]['valence']);
        else
            array_push($line, '---');

        if(isset($Response['TrackFeatures'][$i]['danceability']))
            array_push($line, $Response['TrackFeatures'][$i]['danceability']);
        else
            array_push($line, '---');

        if(isset($Response['TrackFeatures'][$i]['energy']))
            array_push($line, $Response['TrackFeatures'][$i]['energy']);
        else
            array_push($line, '---');

        if(isset($Response['TrackFeatures'][$i]['liveness']))
            array_push($line, $Response['TrackFeatures'][$i]['liveness']);
        else
            array_push($line, '---');

        if(isset($Response['TrackFeatures'][$i]['instrumentalness']))
            array_push($line, $Response['TrackFeatures'][$i]['instrumentalness']);
        else
            array_push($line, '---');

        // if(isset($Response['TrackFeatures'][$i]['liveness']))
        //     array_push($line, $Response['TrackFeatures'][$i]['liveness']);
        // else
        //     array_push($line, '---');

        if(isset($Response['TrackFeatures'][$i]['loudness']))
            array_push($line, ($Response['TrackFeatures'][$i]['loudness']));
        else
            array_push($line, '---');

        if(isset($Response['TrackFeatures'][$i]['speechiness']))
            array_push($line, $Response['TrackFeatures'][$i]['speechiness']);
        else
            array_push($line, '---');


        if(isset($Response['TrackFeatures'][$i]['acousticness']))
            array_push($line, $Response['TrackFeatures'][$i]['acousticness']);
        else
            array_push($line, '---');


        if(isset($Response['TrackFeatures'][$i]['tempo']))
            array_push($line, $Response['TrackFeatures'][$i]['tempo']);
        else
            array_push($line, '---');

        if(isset($Response['TrackFeatures'][$i]['duration_ms']))
            array_push($line, $Response['TrackFeatures'][$i]['duration_ms']);
        else
            array_push($line, '---');

        array_push($line,$Response['ResponseData']['items'][$i]['track']['album']['release_date']);


        try{
            fputcsv($file, $line);
            $line = [];
            $artists_temp = "";
            $genres_temp = "";
        }catch(Exception $e){
            return([
                    'Success' => false,
                    'Error' => e.getMessage()
                ]);
        }
    }

        return([
                    'Success' => true,
                    'Message' => "File created/ updated."
                ]);


    }

    public function refreshCalculateEveryRecord(Request $request) {


        
        $return = $this->getDetailedRecords($request->id, True);


        $commulative_return = $this->getDetailedRecords($request->id, false, $return['TotalRecords']);
        

        $csv_file_creation = $this->generateCsvFile($commulative_return, $request->id, $return['ResponseData']['name']);

        

        $imageToInsert = findAndGetCover(($return['ResponseData']['images']), 'playlists/'.$return['ResponseData']['id'].'.jpg');
        $repeatedArtist = $this->findMostRepeatedArtist($commulative_return['ResponseData']);
        $averageYear = $this->findMostAverageYear($commulative_return['ResponseData']);
        $repeatedGenres = $this->findMostRepeatedGenres($commulative_return['ArtistGenres']);
        $averagedValues = $this->findAveragedTrackFeatures($commulative_return['TrackFeatures'], $commulative_return['ResponseData']['items']);
        $is_new = false;


        if (Playlist::where('id', '=', $request->id)->exists()) {
            $playlist = Playlist::find($request->id);
        } else {
            $playlist = new Playlist();
            $playlist->id = $return['ResponseData']['id'];
            $is_new = true;
                
        }



        $playlist->title = $return['ResponseData']['name'];
        $playlist->description = $return['ResponseData']['description'];
        $playlist->added_by = session::get('UserInfo')['id'];
        $playlist->added_by_name = session::get('UserInfo')['display_name'];
        $playlist->repeated_artist = $repeatedArtist['RepeatedArtist'];
        //$playlist->repeated_artist_id = null; //$repeatedArtist['RepeatedArtist']['id'];
        $playlist->creator_name = $return['ResponseData']['owner']['display_name'];
        $playlist->creator_id = $return['ResponseData']['owner']['id'];
        $playlist->repeated_genre = $repeatedGenres['RepeatedGenres'];

        $playlist->instrumentalness = $this->setMaxTo100($averagedValues['Instrumentalness']);
        $playlist->liveness = $this->setMaxTo100($averagedValues['Liveness']);
        $playlist->Loudness = $averagedValues['Loudness'];
        $playlist->speechiness = $this->setMaxTo100($averagedValues['Speechiness']);
        $playlist->tempo = $averagedValues['Tempo'];
        $playlist->followers = $return['ResponseData']['followers']['total'];
        $playlist->danceability = $this->setMaxTo100($averagedValues['Danceability']);
        $playlist->popularity = $this->setMaxTo100($averagedValues['Popularity']);
        $playlist->energy = $this->setMaxTo100($averagedValues['Energy']);
        $playlist->valence = $this->setMaxTo100($averagedValues['Valence']);
        $playlist->total_tracks = $return['TotalRecords'];
        $playlist->calculated_tracks = true;
        $playlist->acousticness = $this->setMaxTo100($averagedValues['acousticness']);
        $playlist->cover = $imageToInsert['Success'];
        $playlist->average_release_year = ceil($averageYear/$return['TotalRecords']);
        $playlist->save();


        if($is_new){
            $result=$this->insertplaylistData($playlist->id,session::get('UserInfo')['id'],session::get('UserInfo')['id'],session::get('UserInfo')['display_name'], 1);
            if($result['Success']==false)
                 {
                  return $result;
                }
        }
         
        //$sql="INSERT INTO `playlist_user`(`user_id`, `playlist_id`, `is_viewed`, `tagged_by_user_id`, `tagged_by_user_name`) VALUES ('".session::get('UserInfo')['id']."','".$playlist->id."', 0, '".session::get('UserInfo')['id']."','".session::get('UserInfo')['display_name']."')";


       
        /*

          $this->findMostRepeatedArtist($return['ArtistGenres']);
          $this->findAveragedTrackFeatures($return['TrackFeatures'], $return['ResponseData']);

          /*
          
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

        if($csv_file_creation['Success'] == false){
            return ([
            'Success' => false, 
            'Message' => "Playlist Created, Unable to create the .csv file"]);
        }   

        return ([
            'Success' => true,
            'id' => $return['ResponseData']['id']]);
    }


    public function setMaxTo100($value){
        if($value > 100)
            return 100;
        else
            return $value;
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
    private function getPlayListInner($url, $commulative, $iteration = 0, $data = null, $artist_genre_just_once = FALSE) {

        $curl_return = goCurl($url, null, 'GET', False);
        if ($curl_return['Success'] == false)
            return $curl_return;
        else {
            $TrackFeatures = $this->getTrackAttributes($curl_return['ResponseData']);

            if ($TrackFeatures['Success'] == false)
                return ("$TrackFeatures");
            else {
                    $ArtistGenres = $this->getArtistGenres($curl_return['ResponseData'], $artist_genre_just_once = FALSE);

                    if ($ArtistGenres['Success'] == false)
                        return ([
                            'Success' => false,
                            'Code' => "error_artists"
                        ]);
                    else {
                        if (!isset($curl_return['ResponseData']['tracks'])) {
                            if ($commulative && $iteration > 0) {

                                $tempMain = $data['ResponseData'];
                                $tempTracks = array_merge($data['ResponseData']['items'], $curl_return['ResponseData']['items']);
                                $tempMain['items'] = $tempTracks;
                                $tempFeatures = array_merge($data['TrackFeatures'], $TrackFeatures['audio_features']);
                                $tempArtists = array_merge($data['ArtistGenres'], $ArtistGenres);
                                $tempTotal = $data['TotalRecords'];


                                $return = [
                                    'Success' => true,
                                    'ResponseData' => $tempMain,
                                    'TrackFeatures' => $tempFeatures,
                                    'ArtistGenres' => $tempArtists,
                                    'TotalRecords' => $tempTotal
                                ];
                                return $return;
                            } else {

                                
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
                        } else {


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


    // private function getPlayListInner2($url, $commulative, $iteration = 0, $data = null, $artist_genre_just_once = FALSE) {

    //     $curl_return = goCurl($url, null, 'GET', False);
    //     if ($curl_return['Success'] == false)
    //         return $curl_return;
    //     else {
    //         $TrackFeatures = $this->getTrackAttributes($curl_return['ResponseData']);

    //         if ($TrackFeatures['Success'] == false)
    //             return ("$TrackFeatures");
    //         else {
    //                 $ArtistGenres = $this->getArtistGenres($curl_return['ResponseData'], $artist_genre_just_once);

    //                 if ($ArtistGenres['Success'] == false)
    //                     return ([
    //                         'Success' => false,
    //                         'Code' => "error_artists"
    //                     ]);
    //                 else {
    //                     if (!isset($curl_return['ResponseData']['tracks'])) {
    //                         if ($commulative && $iteration > 0) {

    //                             $tempMain = $data['ResponseData'];
    //                             $tempTracks = array_merge($data['ResponseData']['items'], $curl_return['ResponseData']['items']);
    //                             $tempMain['items'] = $tempTracks;
    //                             $tempFeatures = array_merge($data['TrackFeatures'], $TrackFeatures['audio_features']);
    //                             $tempArtists = array_merge($data['ArtistGenres'], $ArtistGenres);
    //                             $tempTotal = $data['TotalRecords'];


    //                             $return = [
    //                                 'Success' => true,
    //                                 'ResponseData' => $tempMain,
    //                                 'TrackFeatures' => $tempFeatures,
    //                                 'ArtistGenres' => $tempArtists,
    //                                 'TotalRecords' => $tempTotal
    //                             ];
    //                             return $return;
    //                         } else {

                                
    //                                 $total_tracks = 0;
    //                                 if (isset($curl_return['ResponseData']['tracks'])) {
    //                                     $total_tracks = $curl_return['ResponseData']['tracks']['total'];
    //                                 }
    //                                 $return = [
    //                                     'Success' => true,
    //                                     'TrackFeatures' => $TrackFeatures['audio_features'],
    //                                     'ResponseData' => $curl_return['ResponseData'],
    //                                     'ArtistGenres' => $ArtistGenres,
    //                                     'TotalRecords' => $total_tracks,
    //                                 ];

    //                                 return $return;
                                
    //                         }
    //                     } else {


    //                             $total_tracks = 0;

    //                             if (isset($curl_return['ResponseData']['tracks'])) {
    //                                 $total_tracks = $curl_return['ResponseData']['tracks']['total'];
    //                             }

    //                             $return = [
    //                                 'Success' => true,
    //                                 'TrackFeatures' => $TrackFeatures['audio_features'],
    //                                 'ResponseData' => $curl_return['ResponseData'],
    //                                 'ArtistGenres' => $ArtistGenres,
    //                                 'TotalRecords' => $total_tracks,
    //                             ];

    //                             return $return;
                            


    //                     }
    //                 }
    //             }
    //         }
    // }


    public function cmp($a, $b) {
        return strcmp($a['name'], $b['name']);
    }

    public function mostFrequent($arr, $n) {

        // new array containing frequency of values of $arr 

        $arr_freq = array_count_values($arr); 
            
        // arranging the new $arr_freq in decreasing  
        // order of occurrences 
        arsort($arr_freq); 
        
        // $new_arr containing the keys of sorted array 
        $new_arr = array_keys($arr_freq); 
        
        // Second most frequent element
        if(isset ($new_arr[$n])) 
            return $new_arr[$n];
        else
            return "";


        // // Sort the array
        // usort($arr, array($this, 'cmp'));
        // // find the max frequency
        // // using linear traversal
        // $max_count = 1;
        // $res = $arr[0];
        // $curr_count = 1;
        // for ($i = 1; $i < $n; $i++) {
        //     if ($arr[$i]['name'] == $arr[$i - 1]['name'])
        //         $curr_count++;
        //     else {
        //         if ($curr_count > $max_count) {
        //             $max_count = $curr_count;
        //             $res = $arr[$i - 1];
        //         }
        //         $curr_count = 1;
        //     }
        // }

        // // If last element
        // // is most frequent
        // if ($curr_count > $max_count) {
        //     $max_count = $curr_count;
        //     $res = $arr[$n - 1];
        // }


        // return $res;
    }

    public function findMostRepeatedArtist($main) {



        $artists = array();

        foreach($main['items'] as $item)
        {
            if(isset($item['track']['artists'])){
                foreach($item['track']['artists'] as $artist)
                {
                    array_push($artists, $artist['name']);

                }
            }
        }
       
        
        $to_return = "";
       
        $total_artist_count = count($artists);

        if ( $total_artist_count > 0 ) {
            

            if($total_artist_count > 5) {

                $to_return = $to_return . $this->mostFrequent($artists, 0);
                
                for ($i = 1; $i<5 && $i<$total_artist_count; $i++){
                    
                    $temp = $this->mostFrequent($artists, $i);
                    if($temp != '')
                        $to_return = $to_return . ", "  . $temp;
                    
                }
                
            
                
            }else {

                $to_return = $to_return . $artists[0];

                for ($i=1; $i<$total_artist_count ; $i++){

                    $to_return = $to_return . ", "  . $artists[$i];

                }


            }

            $return = [
                'Success' => true,
                'RepeatedArtist' => $to_return
            ];

            return $return;
            
        } else {
            $return = [
                'Success' => true,
                'RepeatedArtist' => "None"
            ];

            return $return;
        }
    }
    
    
    public function findMostRepeatedGenres($main){

        
        
        $genres = array();

        foreach($main as $item)
        {
            if(isset($item['genres'])) {
                foreach($item['genres'] as $genre)
                {
                    array_push($genres, $genre);

                }
            }
        }


        $artists = $genres;

        
        $to_return = "";
       
        $total_artist_count = count($artists);

        if ( $total_artist_count > 0 ) {
            

            if($total_artist_count > 5) {

                $to_return = $to_return . $this->mostFrequent($artists, 0);
                
                for ($i = 1; $i<5 && $i<$total_artist_count; $i++){
                    
                    $temp = $this->mostFrequent($artists, $i);
                    if($temp != '')
                        $to_return = $to_return . ", "  . $temp;
                    
                }
                
            
                
            }else {

                $to_return = $to_return . $artists[0];

                for ($i=1; $i<$total_artist_count ; $i++){

                    $to_return = $to_return . ", "  . $artists[i];

                }


            }

            $return = [
                'Success' => true,
                'RepeatedGenres' => $to_return
            ];

            return $return;
            
        } else {
            $return = [
                'Success' => true,
                'RepeatedGenres' => "None"
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
        $acousticness = 0;

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
                $loudness+=($track['loudness']);
                $acousticness +=$track['acousticness'];
            }

            if (!isset($main['tracks'])){
                foreach ($main as $playlist) {
                    $popularity+=$playlist['track']['popularity'];
                }} else
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
                $acousticness +=$track['acousticness'];
                $instrumentalness+=$track['instrumentalness'];
                $liveness+=$track['liveness'];
                $loudness+=$track['loudness'];
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
//        if($loudness<0)
//            $loudness = 0;
        if($instrumentalness<0)
            $instrumentalness = 0;
        if($liveness<0)
            $liveness = 0;
        if($tempo<0)
            $tempo = 0;
        if($acousticness<0)
            $acousticness = 0;
        
        
        $return = [
            'Success' => true,
            'Danceability' => round(($danceability / $count)*100),
            'Energy' => round(($energy / $count)*100),
            'Popularity' => round(($popularity / $count)),
            'Valence' => round(($valence / $count)*100),
            'Speechiness' => round(($speechiness/$count)*100),
            'Tempo' => round((($tempo/$count))),
            'Instrumentalness' => round(($instrumentalness/$count)*100),
            'Liveness' => round(($liveness/$count)*100),
            'Loudness' =>  round(($loudness/$count)),
            'acousticness' => round(($acousticness/$count)*100)
        ];

        return $return;
    }

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


    private function findMostAverageYear($playlist) {
        
        $added_years = 0;


        foreach ($playlist['items'] as $key => $value) {
            $temp = explode('-', $value['track']['album']['release_date'])[0];
            $added_years+=(int)$temp;
        }

        
        return $added_years;
    }

    /**
     *
     */
    private function getArtistGenres($playlist, $just_once = FALSE) {



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

          if(!$just_once)
            $iterations = ceil($count_records/($limit+1));
          else
            $iterations = 1;

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

          if($artist_ids != ""){
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

            $data = Playlist::findPlaylistWithTaggedUsers($request->id);
            
            $data['Playlist']->rating = $data['Playlist']->calculateRating();
            $data['Playlist']->save();

            $data['Playlist']["timeNow"] = $this->timeago($data['Playlist']['created_at']);
            $data_to_send = [];
            $data_to_send["Playlist"] = $data['Playlist'];
            $data_to_send["user"] = session::get('UserInfo');
            $data_to_send["Users"] = $data['Users'];
            if(file_exists('users/'. session::get('UserInfo')['id'].'.jpg')){
                $data_to_send["user"]['profileImage'] = '/users/'. session::get('UserInfo')['id'].'.jpg';
            }else{
                $data_to_send["user"]['profileImage'] = '/images/default_user.png';
            }

            $data_to_send["tots_comments"] = Playlist::find($data['Playlist']['id'])->comment()->count();
            $data_to_send["user_rating"] = $data['Playlist']->getRating(session::get('UserInfo')['id']);

            $data_to_send['Tags'] = Other_tag::getForThisPlaylist($playlist_id);

            return view('openplaylists')->with($data_to_send);
        } else {

            return view('home')->withErrors('This playlist doesn\'t exist in our system. Please add it first.');
        }
        // return view('openplaylists');
    } 
    
    public function openTaggedPlaylist(Request $request){
        
        $playlist_id = $request->id;
        $result = Playlist::setTagViewed($playlist_id, session::get('UserInfo')['id']);
        if($result['Success']) {
            
            return ($this->openPlaylist($request));
            
        }else{
            
            return view('errors.500')->withErrors($result['Error']);
            
        }
        
  
    }
    
    public function deductTag(){
        
        Playlist::isNewTag(session::get('UserInfo')['id']);
        return (session::get('Tagged'));
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
