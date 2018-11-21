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

/*Route::get('/', [
    'uses'=>'HomeController@index',
    'as'=>'home.index'
]);*/
Route::get('/','UserPostController@index');

Route::resource('userpost','UserPostController');

Auth::routes();



Route::put('/delete/{post_id}/{key}',[
    'uses'=>'UserPostController@delete',
    'as'=>'userpost delete',
    'middleware'=>'auth'

]);
Route::get('/userpost/reply/{post_id}/{key}',[
    'uses'=>'UserPostController@getreply',
    'as'=>'userpost reply',
    'middleware'=>'auth'

]);
Route::put('/userpost/reply/{post_id}/{key}',[
    'uses'=>'UserPostController@postreply',
    'as'=>'userpost reply',
    'middleware'=>'auth'

]);



Route::get('/home', 'HomeController@index');



