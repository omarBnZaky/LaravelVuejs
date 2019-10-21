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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::apiResources(['user'=>'API\UserController']);
//
//Route::apiResources(['role'=>'API\RolesController']);
//Route::apiResources(['org/users'=>'API\Organization\UserController']);
//Route::group(['prefix'=>'org','namespace'=>''])
//Route::get('all-users','API\UserController@index');
//Route::apiResources(['task'=>'API\User\TaskController']);
Route::group(['prefix'=>'task'],function (){
    Route::get('all','API\User\TaskController@index');
    Route::post('finish/{id}','API\User\TaskController@finish');
    Route::post('doing/{id}','API\User\TaskController@doing');
});
