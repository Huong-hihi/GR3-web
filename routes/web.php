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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');

    Route::group(['prefix' => 'user', 'namespace' => 'Admin', 'middleware' => 'role:admin'], function () {
        Route::get('', 'UserController@index')->name('admin.user.index');
        Route::get('create', 'UserController@create')->name('admin.user.create');
        Route::post('store', 'UserController@store')->name('admin.user.store');
        Route::get('{id}/edit', 'UserController@edit')->name('admin.user.edit');
        Route::put('{id}/update', 'UserController@update')->name('admin.user.update');
        Route::get('{id}/delete', 'UserController@delete')->name('admin.user.delete');
    });

    Route::group(['prefix' => 'singer', 'namespace' => 'Admin', 'middleware' => 'role:admin'], function () {
        Route::get('', 'SingerController@index')->name('admin.singer.index');
        Route::get('create', 'SingerController@create')->name('admin.singer.create');
        Route::post('store', 'SingerController@store')->name('admin.singer.store');
        Route::get('{userID}/edit', 'SingerController@edit')->name('admin.singer.edit');
        Route::put('{userID}/update', 'SingerController@update')->name('admin.singer.update');
        Route::get('{userID}/delete', 'SingerController@delete')->name('admin.singer.delete');
    });

    Route::group(['prefix' => 'song', 'namespace' => 'Admin', 'middleware' => 'role:admin'], function () {
        Route::get('', 'SongController@index')->name('admin.song.index');
        Route::get('create', 'SongController@create')->name('admin.song.create');
        Route::post('store', 'SongController@store')->name('admin.song.store');
        Route::get('{id}/edit', 'SongController@edit')->name('admin.song.edit');
        Route::put('{id}/update', 'SongController@update')->name('admin.song.update');
        Route::get('{id}/delete', 'SongController@delete')->name('admin.song.delete');
    });

    Route::group(['prefix' => 'category', 'namespace' => 'Admin', 'middleware' => 'role:admin'], function () {
        Route::get('', 'CategoryController@index')->name('admin.category.index');
        Route::get('create', 'CategoryController@create')->name('admin.category.create');
        Route::post('store', 'CategoryController@store')->name('admin.category.store');
        Route::get('{id}/edit', 'CategoryController@edit')->name('admin.category.edit');
        Route::put('{id}/update', 'CategoryController@update')->name('admin.category.update');
        Route::get('{id}/delete', 'CategoryController@delete')->name('admin.category.delete');
    });
});

Route::group(['namespace' => 'Client'], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('search', 'HomeController@search')->name('home.search');
    Route::post('song/listen', 'ListenController@listen')->name('client.song.listen');
    Route::get('song/{id}', 'SongController@detail')->name('client.song.detail');
    Route::get('singer/{id}', 'SingerController@detail')->name('client.singer.detail');
    Route::get('singer/{id}/album', 'SingerController@album')->name('client.singer.album');
    Route::get('album/{id}', 'AlbumController@detail')->name('client.album.detail');
    Route::get('my-album', 'AlbumController@myAlbum')->name('client.album.my-album');
    Route::get('profile', 'ProfileController@index')->name('client.profile.index');
    Route::put('profile', 'ProfileController@update')->name('client.profile.update');
    Route::post('rating/log/{song_id}', 'RatingController@log')->name('client.rating.log');
    Route::post('my-album/update', 'AlbumController@myAlbumUpdate')->name('client.my-album.update');
    Route::group(['prefix' => 'api'], function () {
        Route::post('comment/create', 'CommentController@apiCreate')->name('api.comment.create');
    });
});
