<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PlaylistRating;
use App\Comment;
use Session;

class Playlist extends Model {

    protected $connection = 'mysql';
    protected $table = 'playlists';
    public $incrementing = false;

    public function store(Request $request) {
        $playlist = new Playlist;

        $playlist->id = $request->id;
        $playlist->title = $request->title;
        $playlist->added_by = $request->added_by;
        $playlist->repeated_artist = $request->repeated_artist;
        $playlist->repeated_times = $request->repeated_times;
        $playlist->repeated_artist_id = $request->repeated_artist_id;
        $playlist->creator_name = $request->creator_name;
        $playlist->creator_id = $request->creator_id;
        $playlist->rating = $request->rating;
        $playlist->followers = $request->followers;
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

    public function AddNewComment($data){
        $comment = new Comment;
        $comment->playlist_id = $this->id;
        $comment->user_id = session::get('UserInfo')['id'];
        $comment->user_name = session::get('UserInfo')['display_name'];
        $comment->comment = $data['comment'];
        $comment->user_url = session::get('UserInfo')['external_urls']['spotify'];

        $comment->save();
    }

    public function getComments(){

        $commentRecords = Comment::where(['playlist_id' => $this->id])->get();
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
                    'userName'          => $comment->user_name,
                    'userProfileImage'  => $image,
                    'text'              => $comment->comment,
                    'time'              =>  Self::timeago($comment->created_at)
                ];
            }
        }      

        return $comments;
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

    public function calculateRating(){

        $ratings = $this->rate;
        $rate  = 0;
        if(!empty($ratings)){
            foreach ($ratings as $key => $value) {
                $rate += $value->rating;    
            }
        }

        $rate /= count($this->rate);

        $this->rating = $rate;
        $this->save();
        
        return $rate;
    }
}
