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


      $query = "(select Z.id, Z.name as text from other_tags Z where Z.name like '%".$str."%') UNION ALL (select id, name from (SELECT *, IF(id is not NULL, users.id, '') as text FROM `users` where (name is Null or name = '') and id like '%".$str."%' UNION ALL select *, IF(id is not NULL, users.name, '') as text from users where name like '%".$str."%') A where A.id not in (SELECT user_id from playlist_user where playlist_id = '".$id."'))";

       // $query = "select A.id, A.name, A.followers from (SELECT *, IF(id is not NULL, users.id, '') as text FROM `users` where (name is Null or name = '') and id like '%".$str."%' UNION ALL select *, IF(id is not NULL, users.name, '') as text from users where name like '%".$str."%') A inner join playlist_user B where playlist_id = '%".$id."%' and A.id != B.user_id";
       
       $users_temp = DB::select($query);

       $new_array = [];

       foreach ($users_temp as $key) {
        if($key->id != session::get('UserInfo')['id'])
          array_push($new_array, $key);
       }


       return $new_array;


    }



    public static function saveRecord(){

        $isUserNew = false;

        if (!User::where('id', '=', session::get('UserInfo')['id'])->exists()) {

            $user = new User();
            $isUserNew = true;
        }
        else{
            $user = User::where('id', '=', session::get('UserInfo')['id'])->first();
        }
        $user->id = session::get('UserInfo')['id'];
        $user->name = session::get('UserInfo')['display_name'];
        $user->followers = session::get('UserInfo')['followers']['total'];
        $user->save();

        return $isUserNew;

    }

    public static function attachTrack($id, $name, $preview){
        if(Track::where('id', '=', $id)->exists()) {

            $track = Track::find($id);

        }
        else {

            $track = new Track();

        }


        $track->id = $id;
        $track->name = $name;
        $track->preview = $preview;
        $track->save();


        if(User_Track::where([
            'user_id' => session::get('UserInfo')['id'],
            'track_id' => $id]) ->exists()){

             return ([
                 'Success' => True,
                 'Status' => 200
             ]);

        }

        $user_track = new User_Track();
        $user_track->track_id = $id;
        $user_track->user_id = session::get('UserInfo')['id'];
        $user_track->save();

        return ([
            'Success' => True,
            'Status' => 200
        ]);
    }


    public static function attachArtist($id, $name, $popularity, $followers){
    



            if(Artist::where('id', '=', $id)->exists()) {

                $artist = Artist::find($id);

            }
            else {

                $artist = new Artist();

            }


                $artist->id = $id;
                $artist->name = $name;
                $artist->popularity = $popularity;
                $artist->followers = $followers;
                $artist->save();



            if(User_Artist::where([
                'user_id' => session::get('UserInfo')['id'],
                'artist_id' => $id])->exists()){

                return ([
                    'Success' => True,
                    'Status' => 200
                ]);

            }

                $user_artist = new User_Artist();
                $user_artist->artist_id = $id;
                $user_artist->user_id = session::get('UserInfo')['id'];
                $user_artist->save();


                return ([
                    'Success' => True,
                    'Status' => 200
                ]);



        }
    
}
