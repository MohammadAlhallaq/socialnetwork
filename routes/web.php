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

Route::get('/home', 'HomeController@index')->name('home');







Route::group(['middleware' => 'auth'], function (){



    Route::get('/get_auth', function (){
       return Auth::user();
    });



    Route::post('/profile/update/profile', [
        'uses' => 'ProfilesController@update',
        'as' => 'profile.update'
    ]);


    Route::get('/profile/edit', [
        'uses' => 'ProfilesController@edit',
        'as' => 'profile.edit'
    ]);


    Route::get('/profile/{slug}', [
        'uses' => 'ProfilesController@index',
        'as' => 'profile'
    ]);



    Route::get('/check_relation_status/{id}', [
        'uses' => 'FriendshipsController@check',
        'as' => 'check'
    ]);

    Route::get('/add_friend/{id}', [
        'uses' => 'FriendshipsController@add_friend',
        'as' => 'check'
    ]);


    Route::get('/accept_friend/{id}', [
        'uses' => 'FriendshipsController@accept_friend',
    
    ]);



    Route::get('/get_unread', function () {
        return Auth::user()->unreadNotifications;
    });


    Route::get('/notifications', [

        'uses' => 'homeController@notifications'

    ]);


    Route::post('/create/post', [

        'uses' => 'PostController@store'

    ]);



    Route::get('/get_posts', [
        'uses' => 'PostController@feed'
    ]);



    Route::get('/test', [
        'uses' => 'PostController@test'
    ]);


    Route::get('/like/{id}', [
        'uses' => 'LikesController@like'
    ]);


    Route::get('/unlike/{id}', [
        'uses' => 'LikesController@unlike'
    ]);


    Route::get('/search/{query}', [

        'uses' => 'profilesController@search'

    ])
;

});






