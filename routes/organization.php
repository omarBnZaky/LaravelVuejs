<?php

Route::domain('org.laravelvue.test')->group(function () {
     Route::group(['prefix'=> 'org'],function (){
        Route::get('dashboard','OrgController@index')->name('org.dashboard');
        Route::get('login','OrgAuth\OrgLoginController@showLoginForm')->name('org.login');
        Route::post('login','OrgAuth\OrgLoginController@showLoginForm')->name('org.login.submit');
        Route::get('register','OrgAuth\OrgRegisterController@showOrgRegisterForm')->name('org.register');
        Route::post('register','OrgAuth\OrgRegisterController@create')->name('org.register.submit');
        Route::post('logout','AdminAuth\AdminLoginController@logout')->name('org.logout');

        //this code made for vue routes
        Route::get('{path}','OrgController@index')->where('path','([A-z\d-\/_.]+)?');
});

     });
