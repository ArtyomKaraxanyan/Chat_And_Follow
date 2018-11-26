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
Route::get('activation/{key}', 'Auth\RegisterController@activation');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');



Route::get('/profile/{id}', 'HomeController@read');
Route::post('/edit/user/{id}','HomeController@update');
Route::get('/edit/user/{id}','HomeController@edit');
Route::get('/home/image','HomeController@create');
Route::get('/profile', 'HomeController@profile');
Route::get('/profile/password/{id}', 'HomeController@editpass');
Route::post('/profile/password/{id}','HomeController@updatepass');
Route::post('profile', 'HomeController@update_avatar');

Route::any('/search','HomeController@search');

//Posts

Route::get('/home','PostsController@posts');
Route::get('/post','PostsController@index');
    //noty read
Route::resource('/posts', 'PostsController');

Route::post('/post/create','PostsController@create');
Route::get('/profile','PostsController@porofile_post');
Route::get('/post/read/{id}','PostsController@read_posts')->name('posts.show');
Route::get('/delete/{id}','HomeController@delete');
Route::get('/delete/posts/{id}','PostsController@deletePost');
Route::get('/edit/posts/{id}','PostsController@edit');
Route::post('/update/posts/{id}','PostsController@post_update');

//Comments


Route::resource('comments', 'CommentsController');

//message
Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/message', 'MessageController@index')->name('message');
Route::post('/message', 'MessageController@store')->name('message.store');




//follow
Route::group(['middleware' => 'auth'], function () {
    Route::get('users/{id}', 'UsersController@show')->name('users');
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
    Route::get('/notifications', 'UsersController@notifications');
});

//
//Route::group(['middleware' => 'auth'], function () {
//    Route::get('/posts', 'NewPostsController@index');
//    Route::get('posts/new', 'NewPostsController@create');
//    Route::post('/posts/new/store', 'NewPostsController@store');
//    Route::resource('/posts', 'NewPostsController');
//});

//image