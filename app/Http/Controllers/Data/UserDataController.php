<?php

namespace App\Http\Controllers\Data;

// use App\Traits\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserDataController extends Controller {

    // use UserData {
    //     UserData::getUserProfile as myGetUserProfile;
    // }

    public function update(){

        if (!Playlist::where('id', '=', session::get('UserInfo')['id'])->exists()) {

            $user = new User();
        }
        else{
            $user = Playlist::where('id', '=', session::get('UserInfo')['id'])->get();
        }

        $user->name = session::get('UserInfo')['display_name'];
        $user->followers = session::get('UserInfo')['followers'];
        $user->save();

        return view('playlists');

    }
    public function getCurrentUser(Request $request) {

        return $this->myGetUserProfile(session::get('UserInfo')['id']);
    }

    public function getUser(Request $request) {
        return $this->myGetUserProfile($request->id);
    }
}
