<?php

namespace App;
use App\Genre;
use App\Artist;
use App\Track;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $casts = ['id' => 'string'];
    protected $table = "users";
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
    public function playlist() {
        return $this->belongsToMany('App\Playlist');
    }

    public static function searchLike($str, $id) {


      $query = "select * from (SELECT *, IF(id is not NULL, users.id, '') as text FROM `users` where (name is Null or name = '') and id like '%".$str."%' UNION ALL select *, IF(id is not NULL, users.name, '') as text from users where name like '%".$str."%') A where A.id not in (SELECT user_id from playlist_user where playlist_id = '".$id."')";

       // $query = "select A.id, A.name, A.followers from (SELECT *, IF(id is not NULL, users.id, '') as text FROM `users` where (name is Null or name = '') and id like '%".$str."%' UNION ALL select *, IF(id is not NULL, users.name, '') as text from users where name like '%".$str."%') A inner join playlist_user B where playlist_id = '%".$id."%' and A.id != B.user_id";
       
       $users_temp = DB::select($query);




       return $users_temp;


    }



    public static function saveRecord(){

        if (!User::where('id', '=', session::get('UserInfo')['id'])->exists()) {

            $user = new User();
        }
        else{
            $user = User::where('id', '=', session::get('UserInfo')['id'])->first();
        }
        $user->id = session::get('UserInfo')['id'];
        $user->name = session::get('UserInfo')['display_name'];
        $user->followers = session::get('UserInfo')['followers']['total'];
        $user->save();

    }
}
