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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/insert', 'GameController@insert');
    Route::get('/append', 'GameController@append');
    Route::post('/store', 'GameController@store');

    Route::get('/users', 'UserController@listing');
    Route::post('/approve_user', 'UserController@approve');
    Route::post('/revoke_user', 'UserController@revoke');
    Route::post('/delete_user', 'UserController@delete');

    Route::get('/export_games', 'GameController@export');
    Route::get('/game/import', 'GameController@import');
    Route::get('/game/import_start', 'GameController@processImport');
});


Route::post('/factionAjax', 'GameController@getFaction');
Route::get('/list', 'GameController@list');
Route::get('/game/{game}', 'GameController@show');

Route::get('/roles', 'RoleController@listing');
Route::get('/roles/{role}', 'RoleController@show');

Route::get('/factions', 'FactionController@listing');
Route::get('/factions/{faction}', 'FactionController@show');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\HomeController@logout');

// Route::get('/home', 'HomeController@index')->name('home');
