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
    return view('user.index');
});
Route::get('login', function () {
    return view('login');
});
Route::get('logout', 'UserController@logout');
Route::post('login', 'UserController@login');
Route::prefix('pengguna')->group(function () {
    Route::get('tambah', function () {
        return view('user.tambah');
    });
    Route::post('/insert', 'UserController@store');
    Route::get('ubah/{id}', 'UserController@edit');
    Route::post('/update/{id}', 'UserController@update');
    Route::get('/', function () {
        return view('user.index');
    });
});

Route::get('home', function () {
    return view('user.home');
});
