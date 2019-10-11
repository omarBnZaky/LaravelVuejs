<?php
use Illuminate\Http\Request;

Route::apiResources(['user'=>'API\UserController']);

Route::apiResources(['role'=>'API\RolesController']);
