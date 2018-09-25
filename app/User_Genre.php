<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Genre extends Model
{
    public function store(Request $request) {

        $user_genre = new User_Genre();
        $user_genre->genre_id = $request->genre_id;
        $user_genre->user_id = $request->user_id;

        $user_genre->save();

    }


    public function genre(){
        return $this->belongsTo('App\Genre');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
