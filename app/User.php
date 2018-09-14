<?php

namespace App;
use App\Genre;
use App\Artist;
use App\Track;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
}
