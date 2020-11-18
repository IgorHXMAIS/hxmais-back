<?php

Route::group([
    'namespace' => 'admin',
    'prefix' => 'admins',
    'middleware' => ['jwt.admin']
], function() {

    /* Sales Route */
    Route::group(['prefix' => 'sales'], function() {
        Route::get('', 'SalesController@index');
        Route::get('{type}/{doc}', 'SalesController@show');

        Route::delete('{id}', 'SalesController@destroy');
    });

    /* Representative Route */
    Route::group(['prefix' => 'representatives'], function() {
        Route::get('', 'RepresentativeController@index');
        Route::get('sales/{id}', 'RepresentativeController@sales');
        Route::get('{type}/{doc}', 'RepresentativeController@show');

        Route::post('', 'RepresentativeController@store');

        Route::put('{id}', 'RepresentativeController@update');

        Route::delete('{id}', 'RepresentativeController@destroy');
    });
});
