<?php

use Illuminate\Support\Facades\Route;

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
    return view('mainPage');
});

// Route::get('games/', function () {
//     return ('Did you mean to include a game ID?');
// });

Route::get('games/', ['uses' => 'ScoreController@gamesIndex']);


Route::get('games/{id}', ['uses' => 'ScoreController@gameView']);

