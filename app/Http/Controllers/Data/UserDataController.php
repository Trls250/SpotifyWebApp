<?php

namespace App\Http\Controllers\Data;

// use App\Traits\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Genre;
use session;

class UserDataController extends Controller {

    // use UserData {
    //     UserData::getUserProfile as myGetUserProfile;
    // }


    public function getCurrentUser(Request $request) {

        $user = User::find(session::get('UserInfo')['id']);
        $genre_user = User::where([
            'user_id' => $user->id
        ])->get();
        $track_user = User::find(session::get('UserInfo')['id'])->track();
        $artist_user = User::find(session::get('UserInfo')['id'])->artist();
        return ([
            'Success' => true,
            'UserInfo' => $user,
            'TrackInfo' => $track_user,
            'ArtistInfo' => $artist_user,
            'GenreInfo' => $genre_user
        ]);
    }

    public function getUser(Request $request) {
        return $this->myGetUserProfile($request->id);
    }

    public function test(Request $request) {
        Genre::insertGenres();
    }
}
