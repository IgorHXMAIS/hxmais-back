<?php

Route::group([
    'prefix' => 'admins',
    'namespace' => 'admin',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');
    Route::group(['middleware' => ['jwt.admin']], function() {
        Route::delete('logout', 'AuthController@logout');
        Route::get('me', 'AuthController@me');
    });
});

Route::group([
    'prefix' => 'representatives',
    'namespace' => 'representative'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');
    Route::group(['middleware' => ['jwt.representative']], function() {
        Route::delete('logout', 'AuthController@logout');
        Route::get('me', 'AuthController@me');
    });
});
