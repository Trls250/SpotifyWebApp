<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use session;
//use App\Playlist;
use App\Comment;

class CommentsController extends Controller {

    public function store(Request $request) {

        $validatedData = $request->validate([
            'comment' => 'required',
        ]);


        $comment = new Comment;
        $comment->playlist_id = $request->id;
        $comment->user_id = session::get('UserInfo')['id'];
        $comment->user_name = session::get('UserInfo')['display_name'];
        $comment->comment = $request->comment;
        $comment->user_url = session::get('UserInfo')['external_urls']['spotify'];

        $comment->save();


        return $comment;
    }

    public function get(Request $request) {
        $validatedData = $request->validate([
            'page' => 'required',
        ]);
    }

}
