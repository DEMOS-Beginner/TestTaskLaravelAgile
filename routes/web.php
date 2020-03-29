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
    return view('index');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::resource('/requests', 'RequestController')->except(['edit', 'update'])->names('requests');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('/messages', 'MessageController')->only(['store'])->names('messages');
});

Route::get('/requests/{id}/accept', 'RequestController@accept')->name('requests.accept');

Route::get('/filter', 'RequestController@filter')->name('filter');
