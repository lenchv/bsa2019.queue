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

Route::put('/queue/sync', 'QueueController@syncTask');
Route::put('/queue/async', 'QueueController@asyncTask');
Route::put('/queue/fail', 'QueueController@failJob');

Route::post('/messages', 'ChatController@send');

Route::get('/users/{userName}', 'UserController@getUser');
Route::post('/users', 'UserController@createUser');
