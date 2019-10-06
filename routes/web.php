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

Route::domain('laravelvue.test')->group(function () {


    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//    Route::get('/all-users','HomeController@allUsers')->name('users');

    //this code made for vue routes
    Route::get('{path}','HomeController@index')->where('path','([A-z\d-\/_.]+)?');


});
