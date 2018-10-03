<?php

namespace App;
use App\Genre;
use App\Artist;
use App\Track;
use Session;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $casts = ['id' => 'string'];
    public $timestamps = false;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function store(Request $request){

        $this->id = $request->id;
        $this->name = $request->name;
        $this->followers = $request->followers;
        $this->save();
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function genre() {
        return $this->belongsToMany('App\Genre');
    }
    public function artist() {
        return $this->belongsToMany('App\Artist');
    }
    public function track() {
        return $this->belongsToMany('App\Track');
    }



    public static function saveRecord(){

        if (!User::where('id', '=', session::get('UserInfo')['id'])->exists()) {

            $user = new User();
        }
        else{
            $user = User::where('id', '=', session::get('UserInfo')['id'])->first();
        }
        $user->id = session::get('UserInfo')['id'];
        $user->name = null;
        $user->followers = session::get('UserInfo')['followers']['total'];
        $user->save();

    }
}
