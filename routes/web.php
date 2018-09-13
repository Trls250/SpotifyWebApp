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



Route::get('auth/getCode', 'Auth\SpotifyAuthController@myAuthCode');
Route::get('auth/postAuth', 'Auth\SpotifyAuthController@myPostAuthCode');
Route::get('auth/setExpire/{token}', 'Auth\SpotifyAuthController@setExpire');




Route::group(['middleware' => 'checkAuth'], function () {

    Route::get('wall', 'PlayListController@getWall');
    Route::get('playlist/getAll', 'PlayListController@getAllPlaylists');
    Route::get('playlist/getWall', 'PlayListController@getWall');
    Route::get('playlist/getWallRecords', 'PlayListController@getWallRecords');
    Route::get('playlist/add/{url}', 'PlayListController@addPlaylist');
    Route::get('playlist/insert/{id}', 'PlayListController@insertPlaylist');

    Route::group(['middleware' => 'checkPlaylistId'], function () {
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
