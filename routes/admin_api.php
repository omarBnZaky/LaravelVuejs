<?php
Route::domain('admin.laravelvue.test')->group(function () {
    Route::apiResources(['/user'=>'API\UserController']);
    Route::apiResources(['/role'=>'API\RolesController']);
});
