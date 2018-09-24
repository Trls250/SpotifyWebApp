<?php

namespace App\Http\Controllers\Data;

// use App\Traits\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Genre;

class UserDataController extends Controller {

    // use UserData {
    //     UserData::getUserProfile as myGetUserProfile;
    // }


    public function getCurrentUser(Request $request) {

        return $this->myGetUserProfile(session::get('UserInfo')['id']);
    }

    public function getUser(Request $request) {
        return $this->myGetUserProfile($request->id);
    }

    public function test(Request $request) {
        Genre::insertGenres();
    }
}
