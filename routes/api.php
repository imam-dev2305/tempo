<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return 'ea';
});
Route::prefix('pengguna')->group(function () {
    Route::get('/get', 'UserController@data');
    Route::get('/get/{id}', 'UserController@data_id');
    Route::post('/insert', 'UserController@store');
    Route::post('/update/{id}', 'UserController@update');
    Route::get('/delete/{id}', 'UserController@destroy');
});
