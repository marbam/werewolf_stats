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

Route::get('/insert', 'GameController@insert');
Route::get('/append', 'GameController@append');
Route::post('/store', 'GameController@store');
Route::post('/factionAjax', 'GameController@getFaction');
Route::get('/list', 'GameController@list');
Route::get('/show/{game}', 'GameController@show');
