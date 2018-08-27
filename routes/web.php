<?php

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


Route::get('/authCode', 'Auth\SpotifyAuthController@authCode');
Route::get('/postAuth', 'Auth\SpotifyAuthController@postAuthCode');



Route::get('/playlist/{todo}', 'PlayListController@userFunWrapper');
Route::get('/playlist/get/{items}/{page}', 'PlayListController@getPlaylist')->name('GetPlaylist');
