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
    
    public function FunWrapper(Request $request)
    {
        $todo = $request->todo;

        switch($todo)
        {
            case "get":
                return $this->getUserProfile($request);
        }


        return "Invalid URL Pattern";
    }


    public function getUserProfile(Request $request)
    {

        if(!$request->has('id'))
        {
            $return_array = array(
                "Success" => false,
                "Desc"  => "CAN NOT OBTAIN USER ID FROM URL"
            );
            
            return $return_array;                                 
        }
        else 
            return ($this->myGetUserProfile($request->input('id')));
        
    }
}
