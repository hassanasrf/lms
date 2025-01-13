<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');

Route::group([
    'namespace' => 'Api',
], function () {

    /* Auth Routes */
    Route::post('login', 'AuthController@login')->name('login');

    Route::group([
        'middleware' => ['auth:admin','check.guard:admin']
    ], function () {

        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::get('profile', 'AuthController@getProfile')->name('profile');

        Route::group([
            'namespace' => 'Admin'
        ], function () {

            Route::apiResource('users', 'UserController');
            Route::apiResource('roles', 'RoleController');
            Route::apiResource('cities', 'CityController');
            Route::apiResource('companies', 'CompanyController');
            Route::apiResource('countries', 'CountryController');
            Route::apiResource('currencies', 'CurrencyController');
            Route::apiResource('permissions', 'PermissionController')->except(['index']);
        });
    });

});