<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register client API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "client" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return successResponse('Client API is working');
});

Route::group([
    'namespace' => 'Api',
], function () {

    /* Auth Routes */
    Route::post('login', 'AuthController@login')->name('login');
    // Route::post('register', 'AuthController@register')->name('register');

    Route::group([
        'middleware' => ['auth:api']
    ], function () {

        // Route::post('logout', 'AuthController@logout')->name('logout');
        // Route::get('get-profile', 'AuthController@getProfile')->name('get_profile');
        // Route::post('update-profile', 'AuthController@update')->name('update_profile');

        Route::group([
            'namespace' => 'Client',
        ], function () {

            //

        });
    });
});
