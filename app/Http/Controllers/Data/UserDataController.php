<?php

namespace App\Http\Controllers\Data;
use App\Traits\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDataController extends Controller
{

    use UserData {
        UserData::getUserProfile as myGetUserProfile;
    }

    public function getCurrentUser(Request $request)
    {

        return $this->myGetUserProfile(session::get('UserInfo')['id']);

    }
    public function getUser(Request $request)
    {
        return $this->myGetUserProfile($request->id);

    }
}
