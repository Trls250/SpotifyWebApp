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

Route::get('/',  function () {
    return view('home');
})->name('home');


Route::get('/test', 'PlayListController@test');


Route::prefix('auth')->group(function () {
    Route::get('/getCode', 'Auth\SpotifyAuthController@authCode');
    Route::get('/postAuth', 'Auth\SpotifyAuthController@postAuthCode');
    Route::get('/setExpire/{token}', 'Auth\SpotifyAuthController@setExpire');
});



Route::group(['middleware' => 'checkAuth'], function () {

    Route::prefix('playlist')->group(function () {
        Route::get('getAll', 'PlayListController@getAllPlaylists');
        Route::get('get/{id}', 'PlayListController@getPlayList');
        Route::get('add/{url}', 'PlayListController@addPlaylist');
        Route::get('insert/{id}', 'PlayListController@insertPlaylist');

        Route::group(['middleware' => 'checkPlaylistId'], function () {
            Route::get('calculate/{id}', 'PlayListController@calculateEveryRecord');
            Route::get('details/{id}', 'PlayListController@getPlaylistDetails')->name('GetPlaylistDetails');
        });

    });


    Route::prefix('users')->group(function () {
        Route::get('me', 'Data\UserDataController@getCurrentUser');
        Route::get('get{id}','Data\UserDataController@getUser');
    });


    Route::prefix('comment')->group(function () {
        Route::post('add/{id}', 'Data\CommentsController@store');
    });



});
