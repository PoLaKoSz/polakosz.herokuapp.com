<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->get('/secret', function() {
    return response()->json(200);
});

Route::get('/movies/search/mafab', 'MovieSearchController@mafab');
Route::get('/movies/search/port',  'MovieSearchController@port');
Route::get('/movies/search/imdb',  'MovieSearchController@imdb');
