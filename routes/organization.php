<?php

Route::domain('org.laravelvue.test')->group(function () {
    Route::get('/', function () {
        return redirect()->route('org.login');
    });

     Route::group(['prefix'=> 'org'],function (){
        Route::get('dashboard','OrgController@index')->name('org.dashboard');
        Route::get('login','OrgAuth\OrgLoginController@showLoginForm')->name('org.login');
        Route::post('login','OrgAuth\OrgLoginController@login')->name('org.login.submit');
        Route::get('register','OrgAuth\OrgRegisterController@showOrgRegisterForm')->name('org.register');
        Route::post('register','OrgAuth\OrgRegisterController@create')->name('org.register.submit');
        Route::post('logout','OrgAuth\OrgLoginController@logout')->name('org.logout');

        //this code made for vue routes
        Route::get('{root}','OrgController@index')->where('root','([A-z\d-\/_.]+)?');
    });

});
