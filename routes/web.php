<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Hash;
Route::get('hash/{h}', function($h) {
    return Hash::make($h);
});

require 'components/api.php';
require 'components/admin.php';
require 'components/representative.php';
require 'components/auth.php';

Route::fallback(function() {
    return response()->json([
        'error' => true,
        'message' => 'route not found'
    ], 404);
});
