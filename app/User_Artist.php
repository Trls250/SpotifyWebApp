<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Artist extends Model
{
    public $timestamps = false;
    protected $table = "artist_user";
    public function store(Request $request) {

        $user_artist = new User_Artist();
        $user_artist->artist_id = $request->artist_id;
        $user_artist->user_id = $request->user_id;

        $user_artist->save();

    }


    public function artist(){
        return $this->belongsTo('App\Artist');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
