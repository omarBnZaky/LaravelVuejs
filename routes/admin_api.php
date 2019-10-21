<?php

Route::apiResources(['user'=>'API\UserController']);
Route::apiResources(['role'=>'API\RolesController']);
Route::apiResources(['org'=>'API\OrganizationController']);
Route::get('all_orgs','API\OrganizationController@all');

Route::group(['prefix'=>'users'],function () {
    Route::get('daily','API\UserController@dailyUsers');
    Route::get('weekly','API\UserController@weeklyUsers');
    Route::get('monthly','API\UserController@monthlyUsers');
    Route::get('yearly','API\UserController@YearlyUsers');
});
