<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist_Other_tag extends Model
{
    public $timestamps = False;
    public $table = "playlist_other_tags";
    public $incrementing = false;
    public $primaryKey = ['other_tag_id', 'playlist_id'];

    public static function other_tag(){
        return $this->belongsToMany('App\Other_tag');
    }
    public static function playlist(){
        return $this->belongsToMany('playlists', 'id');
    }
}
