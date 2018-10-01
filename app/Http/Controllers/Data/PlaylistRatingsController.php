<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PlaylistRating;
use App\Playlist;

use Session;

class PlaylistRatingsController extends Controller
{
    /**
     * Insertion of ratings, automatically updates the ratings if previous ratings found
     * Automatically re-calculates the total rate of the playlist
     * (This can be done in a more efficient way using eloquent triggers or events)
     */
    public function insert(Request $request)
    {

        $validate_values = $request->validate([
            'rate' => 'required'
        ]);

        $rating = $this->get($request->id, session::get('UserInfo')['id']);

        if(!$rating){
            $rating = new PlaylistRating;
            $rating->playlist_id = $request->id;
            $rating->user_id = session::get('UserInfo')['id'];
            $this->incrementPlaylistCounter($request->id);
        }

        else
        {
            $rating = PlaylistRating::where([
                'playlist_id' => $request->id,
                'user_id' => session::get('UserInfo')['id']
            ])->first();
        }

        $rating->rating = $request->rate;
        $rating->save();


        $total_rate = PlaylistRating::where('playlist_id', '=', $request->id)->sum('rating');
        $total_count = PlaylistRating::where('playlist_id', '=', $request->id)->count();

        $to_update = $total_rate/$total_count;

        $playlist = Playlist::find($request->id);
        $playlist->rating = $to_update;

        $playlist->save();



        return ([
            'Success' => true,
            'Rate' => $request->rate,
            'Updated' => $to_update
        ]);

    }

    //not a route function
    public function get($playlist_id, $user_id)
    {
        $rate = PlaylistRating::where([
            'playlist_id' => $playlist_id,
            'user_id' => $user_id
        ])->first();

        if(!isset($rate))
            $rate = false;

        return $rate;
    }

    /**
     * convert to a trigger
     */

    private function incrementPlaylistCounter($id)
    {
        $playlist = Playlist::where(['id' => $id])->first();
        $playlist->rating_count = $playlist->rating_count +1;
        $playlist->save();
    }
}
