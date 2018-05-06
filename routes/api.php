<?php

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/auth'
], function () {
    Route::post('/login', 'AuthController@login')->name('api_login');
    Route::post('/logout', 'AuthController@logout')->name('logout');
    Route::post('/refresh', 'AuthController@refresh')->name('refresh_token');;
    Route::post('/me', 'AuthController@me')->name('auth_user');
});

Route::group(['prefix' => 'v1'], function () {

    Route::resource('teams', 'TeamController')->except([
        'create',
        'edit'
    ]);

    Route::resource('players', 'PlayerController')->except([
        'create',
        'edit'
    ]);

    Route::get('/teams/{team}/players',
        ['uses' => 'TeamController@getPlayers'])->name('teams.players');
});