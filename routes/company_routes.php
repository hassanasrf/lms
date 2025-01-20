<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Company API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register company API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "company" middleware group. Enjoy building your API!
|
*/

Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');

Route::group([
    'namespace' => 'Api',
], function () {

    /* Auth Routes */
    Route::post('login', 'AuthController@login')->name('login');

    Route::group([
        'middleware' => ['auth:api','check.guard:api']
    ], function () {

        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::get('profile', 'AuthController@getProfile')->name('profile');

        Route::group([
            'namespace' => 'Admin'
        ], function () {

            Route::get('currency', 'DataController@getCurrency');
            Route::get('service-types', 'DataController@getServiceType');
            Route::get('company-types', 'DataController@getCompanyType');
            Route::get('customer-types', 'DataController@getCustomerType');

            Route::apiResource('users', 'UserController');
            Route::apiResource('roles', 'RoleController');
            Route::apiResource('banks', 'BankController');
            Route::apiResource('cities', 'CityController');
            Route::apiResource('agents', 'AgentController');
            Route::apiResource('bookings', 'BookingController');
            Route::apiResource('countries', 'CountryController');
            Route::apiResource('customers', 'CustomerController');
            Route::apiResource('currencies', 'CurrencyController');
            Route::apiResource('commodities', 'CommodityController');
            Route::apiResource('tagging-points', 'taggingPointController');
            Route::apiResource('shipping-lines', 'ShippingLineController');
            Route::apiResource('permissions', 'PermissionController')->except(['index']);

        });
    });

    Route::get('company-by-subdomain', 'Admin\CompanyController@getCompanyDetailsBySubdomain');

});