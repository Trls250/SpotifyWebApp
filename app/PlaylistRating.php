<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Playlist;

class PlaylistRating extends Model
{
    protected $connection = 'mysql';
    protected $table = 'playlist_ratings';
    public $incrementing = true;

    public function store(Request $request)
    {
        $rate = new PlaylistRate;
        $rate->playlist_id = $request->playlist_id;
        $rate->user_id = $request->user_id;
        $rate->rating = $request->rating;
        $rate->save();
    }


    public function playlist() {
        return $this->belongsTo('App\playlist');
    }
}
