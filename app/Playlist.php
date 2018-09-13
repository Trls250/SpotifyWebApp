<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
