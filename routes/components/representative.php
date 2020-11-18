<?php

Route::group([
    'namespace' => 'representative',
    'prefix' => 'representatives',
    'middleware' => ['jwt.representative']
], function() {
    Route::get('', 'SalesController@index');
    Route::get('{type}/{doc}', 'SalesController@show');

    Route::post('', 'SalesController@store');
});
