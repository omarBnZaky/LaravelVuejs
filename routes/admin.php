<?php


Route::get('/', function () {
        return redirect()->route('admin.login');
});
Route::group(['prefix'=>'admin'],function (){
    Route::get('/login', 'AdminAuth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
//        Route::get('/all-users','AdminController@allUsers')->name('users');
    Route::post('logout','AdminAuth\AdminLoginController@logout')->name('admin.logout');

});

Route::get('{any}','AdminController@index')->where('any','([A-z\d-\/_.]+)?');

