<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PlaylistRating;
use Illuminate\Support\Facades\DB;
use App\Comment;
use App\Playlist_Other_tag;
use Session;

class Playlist extends Model {

    protected $connection = 'mysql';
    protected $table = 'playlists';
    public $incrementing = false;
    protected $casts = ['id' => 'string'];
    public $primaryKey = 'id';
    public function store(Request $request) {
        $playlist = new Playlist;
        $playlist->id = $request->id;
        $playlist->title = $request->title;
        $playlist->added_by = $request->added_by;
        $playlist->repeated_artist = $request->repeated_artist;
        $playlist->repeated_times = $request->repeated_times;
        $playlist->repeated_artist_id = $request->repeated_artist_id;
        $playlist->added_by_name = $request->added_by_name;
        $playlist->creator_name = $request->creator_name;
        $playlist->creator_id = $request->creator_id;
        $playlist->rating = $request->rating;
        $playlist->followers = $request->followers;
        $playlist->instrumentalness = $request->instrumentalness;
        $playlist->liveness = $request->liveness;
        $playlist->loudness = $request->loudness;
        $playlist->speechiness = $request->speechiness;
        $playlist->tempo = $request->tempo;
        $playlist->danceability = $request->danceability;
        $playlist->popularity = $request->popularity;
        $playlist->energy = $request->energy;
        $playlist->valence = $request->valence;
        $playlist->total_tracks = $request->total_tracks;
        $playlist->calculated_tracks = $request->calculated_tracks;
        $playlist->cover = $request->image;
        $playlist->rating_count = null;
        $playlist->save();
    }

    public function comment() {
        return $this->hasMany('App\Comment');
    }

    public function rate() {
        return $this->hasMany('App\PlaylistRating');
    }

    public static function getAll($offset, $items) {
        $playlists = Playlist::orderBy('updated_at', 'desc')->skip($offset)->take($items)->get();
        return ($playlists);
    }
    public static function getAllForTable($offset, $items) {
        try{

            $query = "select title as Name, popularity as Popularity, danceability as Danceability, energy as Energy, valence as Valence, instrumentalness as Instrumentalness, liveness as Liveness, loudness as Loudness, speechiness as Speechiness, tempo as BPM, acousticness as Acousticness, average_release_year as `Average Release Year` from playlists order by updated_at desc limit ".$offset.", ".$items;
            $result = DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            return ([
                'Success' => false,
                'Error' => $ex->getMessage()
            ]);
        }
        
        return ([
            'Success' => true,
            'Data' => $result
        ]);
    }

    public static function getAllofUser($offset, $items, $id) {
        $playlists = Playlist::where(['added_by' => $id])->orderBy('updated_at', 'desc')->skip($offset)->take($items)->get();
        return ($playlists);
    }

    public function user(){
        return $this->belongsToMany('App\User');
    }
    
    public static function ratedPlaylists(){
        try{
            $query = "select * from playlists A inner join playlist_ratings B on A.id = B.playlist_id where B.user_id = '".session::get('UserInfo')['id']."'";
            $result = DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            return ([
                'Success' => false,
                'Error' => $ex->getMessage()
            ]);
        }
        
        return ([
            'Success' => true
        ]);
    }

    public static function isNewTag($user_id){
        $query = "select * from playlist_user where user_id = '".$user_id."' and is_viewed = 0";
        $count = DB::select($query);

        $count = count($count);

        if($count)
        {
            session::put('Tagged', $count);
            return true;
        }
        else
        {
            session::put('Tagged', 0);
            return false;
        }

    }
    
    
    public static function setTagViewed($playlist_id, $user_id) {
        
        //Playlist::isNewTag($user_id);
        
        try{
            $query = "update playlist_user set is_viewed = 1 where playlist_id = '".$playlist_id."' and user_id = '".$user_id."'";
            $result = DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            return ([
                'Success' => false,
                'Error' => $ex->getMessage()
            ]);
        }
        
        return ([
            'Success' => true
        ]);
        
       
    }

    public static function getTaggedPlaylists($user_id, $offset, $limit){

        $query = "select A.*, B.is_viewed, B.tagged_by_user_id, B.tagged_by_user_name from playlists A INNER JOIN (select * from playlist_user where user_id != tagged_by_user_id and user_id = '".$user_id."') B on A.id = B.playlist_id ORDER BY B.is_viewed  limit ".$limit." offset ".$offset."";
        $playlists = DB::select($query);

        return $playlists;

    }

    public static function searchLike($str = null, $start, $limit) {

        

        if($str != null) {

            $query = "select A.* from playlists A where title like '%".$str."%' or repeated_artist like '%".$str."%' or repeated_genre like '%".$str."%' limit ".$limit." offset ".$start."";
            $playlists = DB::select($query);
            $total = count($playlists);


       // $playlists = Self::removeDecimalFromFilters($playlists);
       return([
        'Playlists' => $playlists,
        'Total' => $total]);
        }
        else {
            $playlists = Playlist::where('title', 'like', '%%')->skip($start)->take($limit)->get();
            $total = Playlist::all()->count();
       // $playlists = Self::removeDecimalFromFilters($playlists);
        return ([
            'Playlists' => $playlists,
            'Total' => $total]);
        };


    }
    public static function removeDecimalFromFilters($playlists){

        if(!empty($playlists)){
            foreach ($playlists as $key => $value) {
                $playlists[$key]["instrumentalness"] *= 100;
                $playlists[$key]["liveness"] *= 100;
                $playlists[$key]["loudness"] *= 100;
                $playlists[$key]["speechiness"] *= 100;
                $playlists[$key]["tempo"] *= 100;
                $playlists[$key]["popularity"] *= 100;
                $playlists[$key]["danceability"] *= 100;
                $playlists[$key]["energy"] *= 100;
                $playlists[$key]["valence"] *= 100;

                if($playlists[$key]["instrumentalness"] > 100){
                    $playlists[$key]["instrumentalness"] = 100;
                }

                if($playlists[$key]["liveness"] > 100){
                    $playlists[$key]["liveness"] = 100;
                }

//                if($playlists[$key]["loudness"] > 100){
//                    $playlists[$key]["loudness"] = 100;
//                }

                if($playlists[$key]["speechiness"] > 100){
                    $playlists[$key]["speechiness"] = 100;
                }

//                if($playlists[$key]["tempo"] > 100){
//                    $playlists[$key]["tempo"] = 100;
//                }

                if($playlists[$key]["popularity"] > 100){
                    $playlists[$key]["popularity"] = 100;
                }

                if($playlists[$key]["danceability"] > 100){
                    $playlists[$key]["danceability"] = 100;
                }

                if($playlists[$key]["energy"] > 100){
                    $playlists[$key]["energy"] = 100;
                }

                if($playlists[$key]["valence"] > 100){
                    $playlists[$key]["valence"] = 100;
                }
            }
        }

        return $playlists;
    }

    public function AddOrUpdateRating($data){

        $flag = false;
        $rating = PlaylistRating::where(['user_id' => session::get('UserInfo')['id'], 'playlist_id' => $this->id ])->first();

        if(empty($rating)){
            $rating = new \App\PlaylistRating;
            $rating->playlist_id = $this->id;
            $rating->user_id = session::get('UserInfo')['id'];
            $flag = true;
        }
        if(empty($data["rating"])){
            $rating->rating = 0;
        }else{
            $rating->rating  = $data['rating'];
        }
        $rating->save();

        if($flag){
            $this->rating_count++;
            $this->calculateRating();
            $this->save();
        }
    } 
    
    
    public static function findPlaylistWithTaggedUsers($id) {
        
        try{
            $playlist = Playlist::find($id);
            $query = "select B.id, B.name from playlist_user A join users B on A.user_id = B.id where playlist_id = '".$id."'";
            $users = DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            return ([
                'Success' => false,
                'Error' => $ex->getMessage()
            ]);
        }
        
        return ([
            'Success' => true,
            'Playlist' => $playlist,
            'Users' => $users
        ]);
        
       
        
        
    }

    public function AddNewComment($data){

        $suggest_track = null;
        if(isset($data['suggest_track'])){

            $exploded = explode('/',$data['suggest_track']);
            $suggest_track = end($exploded);
        }

        $comment = new Comment;
        $comment->playlist_id = $this->id;
        $comment->user_id = session::get('UserInfo')['id'];
        $comment->user_name = session::get('UserInfo')['display_name'];
        $comment->comment = $data['comment'];
        $comment->user_url = session::get('UserInfo')['external_urls']['spotify'];
        $comment->track_id = $suggest_track;

        $comment->save();
    }

    public static function getComments($id, $start, $limit){


        $commentRecords = Comment::where(['playlist_id' => $id])->orderBy('updated_at', 'desc')->skip($start)->take($limit)->get();
        $comments = []; 

        if(!empty($commentRecords)){
            foreach ($commentRecords as $key => $comment) {
                $image = '';
                
                if(file_exists(base_path().'/public/' . 'users/' . $comment["user_id"] . '.jpg')){
                    $image = '/users/' . $comment["user_id"] . '.jpg';
                }else{
                    $image = '/images/default_user.png';
                }

                $comments[] = [
                    'id'                => $comment->id,
                    'user_id'           => $comment->user_id,
                    'userName'          => $comment->user_name,
                    'track_id'          => $comment->track_id,
                    'userProfileImage'  => $image,
                    'text'              => $comment->comment,
                    'time'              =>  Self::timeago($comment->created_at)
                ];
            }
        }      

        return $comments;
    }

    public static function insertOtherTag($playlist_id, $tag_id){

        // $playlist = Playlist::find($playlist_id);
        // $playlist->Other_tag()->attach($tag_id);

        if(Playlist_Other_tag::where([
            'playlist_id' => $playlist_id,
            'other_tag_id' => $tag_id
        ])->exists()){
            return ([
                'Success' => true,
                'Already' => true
            ]);
        }

        try{
            $user_other_tag = new Playlist_Other_tag();
            $user_other_tag->playlist_id = $playlist_id;
            $user_other_tag->other_tag_id = $tag_id;
            $user_other_tag->save();

            return ([
                'Success' => true
            ]);

        }catch(\Illuminate\Database\QueryException $ex){
            return ([
                'Success' => false,
                'Error' => $ex->getMessage()
            ]);
        }

    }

    public static function timeago($ptime) {

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

    public function getRating($user_id) {
        return ( PlaylistRating::where([
            'playlist_id' => $this->id,
            'user_id' => $user_id
        ])->first());
    }
    public function calculateRating(){
        $ratings = $this->rate;
        $rate  = 0;
        if(!empty($ratings)){
            foreach ($ratings as $key => $value) {
                $rate += $value->rating;    
            }
        }

        if(count($this->rate) > 0){
            $rate /= count($this->rate);
        }

        return $rate;
    }

    public function other_tag(){
        return $this->belongsToMany('App\other_tag');
    }
}
