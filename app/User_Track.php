<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Track extends Model
{
    public $timestamps = false;
    protected $table = "track_user";
    public function store(Request $request) {

        $user_track = new User_Track();
        $user_track->track_id = $request->track_id;
        $user_track->user_id = $request->user_id;

        $user_track->save();

    }


    public function track(){
        return $this->belongsTo('App\Track');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
