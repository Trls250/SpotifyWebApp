<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Playlist;
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
        $comment->track_id = $request->suggest_track;
        $comment->user_url = session::get('UserInfo')['external_urls']['spotify'];
        
        $comment->save();

        return $comment;
    }

    /* ADDED BY FARZAM */
    public function addComment(Request $request){

         $validatedData = $request->validate([
            'comment' => 'required'
        ]);

        $playlist = Playlist::find($request->id);
        if(empty($playlist)){

        }   


        /* Add New Comment. */
        $playlist->AddNewComment($request->input());

        /* IF rating is provided, Add or Update the record of rating for User. */
        

        return "success";
    }

    public function getComments(Request $request) {
        $validatedData = $request->validate([
            'start' => 'required',
            'limit' => 'required'
        ]);


        return view('loaders.comment')->with([
            "comments" => Playlist::getComments($request->id, $request->start, $request->limit)]);

    }



    public function test(Request $request){
        echo '<pre>';
        print_r($request);
        exit;
        return;
    }
}
