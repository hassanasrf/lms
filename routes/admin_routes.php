<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "admin" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return successResponse('Admin API is working');
});

/* Auth Routes */
// Route::post('login', 'AuthController@login')->name('login');
// Route::post('register', 'AuthController@register')->name('register');

Route::group([
    'middleware' => ['auth:admin']
], function () {

    // Route::post('logout', 'AuthController@logout')->name('logout');
    // Route::get('get-profile', 'AuthController@getProfile')->name('get_profile');
    // Route::post('update-profile', 'AuthController@update')->name('update_profile');

    Route::group([
        'namespace' => 'Admin',
    ], function () {

        //

});
