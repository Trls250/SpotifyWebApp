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

 

Route::get('/', 'Auth\SpotifyAuthController@checkRedirect');



/*
TODO: Assign middlewares here
*/

Route::get('auth/getCode', 'Auth\SpotifyAuthController@myAuthCode');
Route::get('auth/postAuth', 'Auth\SpotifyAuthController@myPostAuthCode');
Route::get('auth/setExpire/{token}', 'Auth\SpotifyAuthController@setExpire');




Route::get('test', 'Data\UserDataController@test');

Route::group(['middleware' => 'checkAuth'], function () {

    Route::view('stats', 'stats');
    Route::post('comment/add-new', 'Data\CommentsController@addComment');
    Route::get('user/update', 'Data\UserDataController@update');
    Route::get('logout', "Auth\SpotifyAuthController@setExpire");
    Route::get('search', 'Data\SearchController@getSearchResults');
    Route::get('searchSimple', 'Data\SearchController@getSearchResultsSimple');
    Route::view('playlist/getTaggedWall', 'tagged-wall');
    Route::view('playlist/getAll', 'playlists');
    Route::get('playlist/getAllRecords', 'PlayListController@getAllPlaylistsRecords');
    Route::get('playlist/user/getAllRecords', 'PlayListController@getAllPlaylistsRecordsforUser');
    Route::get('playlist/getWall', 'PlayListController@mywall');
    Route::get('playlist/advanced-search', 'PlayListController@mywallwithSearch')->name('advanced-search');
    Route::get('playlist/getUserWall/{name}/{id}', 'PlayListController@myUserwall');
    Route::get('playlist/getLibrary', 'PlayListController@mylibrary')->name('library-records');
    Route::get('playlist/getWallRecords', 'PlayListController@getWallRecords');
    Route::get('playlist/getUserWallRecords/{id}', 'PlayListController@getUserWallRecords');
    Route::get('playlist/getLibraryRecords', 'PlayListController@getLibraryRecords');
    Route::post('playlist/add', 'PlayListController@addPlaylist');
    Route::get('playlist/insert/{id}', 'PlayListController@insertPlaylist');
    Route::get('playlist/insertSimple/{id}', 'PlayListController@refreshCalculateEveryRecord');
    Route::get('playlist/tags', 'PlayListController@tagsWall');
    Route::get('playlist/tags/{tag_id}', 'PlayListController@tagsWallSpecific');
    Route::get('user/addArtist', 'Data\UserDataController@addArtist');
    Route::get('user/addTrack', 'Data\UserDataController@addTrack');
    Route::get('user/addGenre', 'Data\UserDataController@addGenre');
    Route::get('user/addPlaylist', 'Data\UserDataController@addPlaylist');
    Route::get('user/tagged', 'PlayListController@getTaggedPlaylists');
    Route::get('deduct', 'PlayListController@deductTag');
    Route::get('playlist/getTaggedWallRecords', 'PlayListController@getTaggedPlaylists');
    Route::post('playlist/advanced-search-results', 'PlayListController@advanced_search');
    Route::get('playlist/stats-result', 'Data\SearchController@getStats');
    Route::get('playlist/stats-result-playlist', 'Data\SearchController@getStatsPlaylists');
    Route::get('playlist/stats-result-playlist-rated', 'Data\SearchController@getStatsPlaylistsRated');

    Route::group(['middleware' => 'checkPlaylistId'], function () {
        Route::get('playlist/open-playlist/{id}','PlayListController@openPlaylist');
        Route::get('playlist/open-tagged-playlist/{id}','PlayListController@openTaggedPlaylist');
        Route::get('playlist/get/{id}', 'PlayListController@getPlayList');
        Route::get('playlist/calculate/{id}', 'PlayListController@refresh');
        Route::get('playlist/details/{id}', 'PlayListController@getPlaylist');
        Route::get('playlist/table/{id}', 'PlayListController@getPlaylistDetails');
        Route::post('rate/insert/{id}', 'Data\PlaylistRatingsController@insert');
        Route::get('playlist/comments/{id}', 'Data\CommentsController@getComments');
        Route::post('playlist/tag/{id}', 'PlayListController@tagUser');
        Route::get('playlist/getCsv/{id}', 'PlayListController@generateCsvFile');
        
    });

    Route::get('users/getUserMatch', 'Data\UserDataController@getUserMatch');
    Route::get('users/me', 'Data\UserDataController@getCurrentUser');
    Route::get('users/get/{id}', 'Data\UserDataController@getUser');
    Route::view('people', 'people');
    Route::get('getAllUsers', 'Data\UserDataController@getUsers');

    Route::post('comment/add/{id}', 'Data\CommentsController@store');

    Route::get('users/me/profile', function () {

        return view('profile');
    });


    


    
//    Route::delete('comment/delete/{id}', 'Data\CommentsController@delete');

});



