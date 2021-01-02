<?php

Route::group([
    'namespace' => 'representative',
    'prefix' => 'representatives',
    'middleware' => ['jwt.representative']
], function() {

    //Routes for clients representavive
    //All clients representative
    Route::get('/clients', 'ClientsController@index');
    //All subscriptions client
    Route::get('/clients/{id}/subscriptions', 'ClientsController@clientSubscriptions');
    //All payments for one subscription
    Route::get('/clients/subscriptions/{id}/payments', 'ClientsController@paymentSubscriptions');
    //All subscriptions the representative
    Route::get('/clients/subscriptions', 'ClientsController@allClientsSubscriptions');
    //All payments subscriptions the representative
    Route::get('/clients/subscriptions/payments', 'ClientsController@allClientsPaymentsSubscriptions');
    //Count total subscriptions the representative
    Route::get('/clients/subscriptions/total', 'ClientsController@totalSubscriptions');
    //Count total payments subscriptions the representative
    Route::get('/clients/subscriptions/payments/total', 'ClientsController@totalPaymentsSubscriptions');
    //Count total clients the representative
    Route::get('/clients/total', 'ClientsController@totalClients');

    //Routes analytics
    Route::get('/dashboard/analytics', 'SubscriptionsController@analyticsDashboard');

    //Routes analytics - Details
    Route::get('/dashboard/analytics/clients/overdue', 'SubscriptionsController@analyticsDashboardClientsOverdue');

    Route::get('', 'SalesController@index');
    Route::get('{type}/{doc}', 'SalesController@show');

    Route::post('', 'SalesController@store');
});
