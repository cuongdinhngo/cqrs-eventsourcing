<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

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

Route::group(['namespace' => 'User', 'prefix' => 'users'], function(){
    Route::post('/', 'UserController@store');
    Route::group(['middleware' => ['auth:api']], function(){
        Route::get('/search', 'UserController@search');
        Route::get('/{id}', 'UserController@show');
        Route::put('/{id}', 'UserController@update');
        Route::post('/batch-users', 'UserController@createUsers');
    });
});
