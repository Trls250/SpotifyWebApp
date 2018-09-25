<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $connection = 'mysql';
    protected $table = 'playlist_comments';
    public $timestamps = true;

    public function store(Request $request) {
        $comment = new Comment;

        $comment->playlist_id = $request->playlist_id;
        $comment->user_id = $request->user_id;
        $comment->user_name = $request->user_name;
        $comment->comment = $request->comment;
        $comment->user_url = $request->user_url;
        $comment->created_at = $request->created_at;
        $comment->updated_at = $request->updated_at;
        $comment->track_id = $request->track_id;
    }

    public function playlist() {
        return $this->belongsTo('App\playlist');
    }

}
