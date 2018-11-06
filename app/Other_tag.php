<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Playlist;
use Illuminate\Support\Facades\DB;

class other_tag extends Model
{
    public $timestamps = FALSE;

    
    public static function getForThisPlaylist($id){
        $query = "select name from playlist_other_tags A join other_tags B on A.other_tag_id = B.id where A.playlist_id = '".$id."'";
        $result = DB::select($query);
        return $result;
    }

    public function playlist(){
        return $this->hasMany('App\Playlist');
    }

}
