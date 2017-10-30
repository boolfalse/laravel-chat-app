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

Auth::routes();

Route::get('/', ['as' => 'home', 'uses' => 'ChatController@homePage']);

Route::post('add-room', ['as' => 'addRoom', 'uses' => 'ChatController@addRoom']);

Route::post('unlock-private-room', ['as' => 'unlockPrivateRoom', 'uses' => 'ChatController@unlockPrivateRoom']);

Route::get('private-room/{hash_tokenKey?}', 'ChatController@privateRoom')->where('hash_tokenKey', '(.*)'); // hash token key can contain slashes too

Route::post('generate-url', ['as' => 'generateUrl', 'uses' => 'ChatController@generateUrl']);