<?php

use App\Http\Middleware\checkAuth;
use App\Http\Middleware\checkPlaylistId;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/test', 'PlayListController@test');
Route::post('comment/test', 'Data\CommentsController@test');

/*
TODO: Assign middlewares here
*/

Route::get('auth/getCode', 'Auth\SpotifyAuthController@myAuthCode');
Route::get('auth/postAuth', 'Auth\SpotifyAuthController@myPostAuthCode');
Route::get('auth/setExpire/{token}', 'Auth\SpotifyAuthController@setExpire');




Route::group(['middleware' => 'checkAuth'], function () {

    Route::get('user/update', 'Data\UserDataController@update');
    Route::get('logout', "Auth\SpotifyAuthController@setExpire");
    Route::get('search', 'Data\SearchController@getSearchResults');
    Route::get('wall', 'PlayListController@getWall');
    Route::view('playlist/getAll', 'playlists');
    Route::get('playlist/getAllRecords', 'PlayListController@getAllPlaylistsRecords');
    Route::view('playlist/getWall', 'wall');
    Route::get('playlist/getWallRecords', 'PlayListController@getWallRecords');
    Route::get('playlist/add/{url}', 'PlayListController@addPlaylist');
    Route::get('playlist/insert/{id}', 'PlayListController@insertPlaylist');

    Route::group(['middleware' => 'checkPlaylistId'], function () {
        Route::get('playlist/open-playlist/{id}','PlayListController@openPlaylist');
        Route::get('playlist/get/{id}', 'PlayListController@getPlayList');
        Route::get('playlist/calculate/{id}', 'PlayListController@refresh');
        Route::get('playlist/details/{id}', 'PlayListController@getPlaylist');
        Route::get('playlist/table/{id}', 'PlayListController@getPlaylistDetails');
        Route::post('rate/insert/{id}', 'Data\PlaylistRatingsController@insert');
    });

    Route::get('users/me', 'Data\UserDataController@getCurrentUser');
    Route::get('users/get{id}', 'Data\UserDataController@getUser');
    Route::post('comment/add/{id}', 'Data\CommentsController@store');

});

Route::group(['middleware' => ['web']], function(){
    Route::post('comment/add-new', 'Data\CommentsController@addComment');
});

