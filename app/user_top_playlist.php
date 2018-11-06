<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_top_playlist extends Model
{
    public $timestamps = false;
    public $table = "user_top_playlists";


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function playlist() {
        return $this->belongsTo('App\Playlist');
    }

}
