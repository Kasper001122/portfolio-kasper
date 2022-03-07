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
// posts need update and delete
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//USERS
Route::get('/home', 'UserController@index')->name('home');
//create
Route::get('/user/admin/create','UserController@create');
//store
Route::post('/user/admin','UserController@store');
//show
Route::get('/user/admin/{user}','UserController@show');
//update
Route::get('/user/admin/{user}/edit', 'UserController@edit');
Route::patch('/user/admin/{user}', 'UserController@update');
//destroy
Route::delete('/user/admin/{user}','UserController@destroy');


//POSTS
Route::get('/post/feed', 'HomeController@index')->name('home');

Route::get('feed', 'PostController@index')->name('feed');

//Create
Route::get('/post/create','PostController@create');
//store
Route::post('/post','PostController@store');
//edit
Route::get('/post/{post}/edit','PostController@edit');
//patch
Route::patch('/post/{post}', 'PostController@update');
//delete
Route::delete('/post/{post}','PostController@destroy');
//THEMES
Route::get('/theme/home', 'ThemeController@index')->name('home');
//show
Route::get('/theme/create','ThemeController@create');
Route::get('/theme/{theme}','ThemeController@show');

//store
Route::post('/theme','ThemeController@store');


//edit
Route::get('/theme/{theme}/edit','ThemeController@edit');
//patch
Route::patch('/theme/{theme}', 'ThemeController@update');


//delete
Route::delete('/theme/{theme}','ThemeController@destroy');

//THEME CHANGE
Route::get('/theme/change/{theme}','ThemeController@changeTheme');
