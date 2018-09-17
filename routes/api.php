<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/logout', function () {
    return Auth::logout();
    // return 'success';
});

Route::group(
    array(
        'namespace' => 'api',
        'prefix' => 'v1',
        'middleware' => ['auth.basic.once']),
        function () {
            Route::apiResource('users', 'UserController');
            Route::apiResource('levels', 'LevelController');
            Route::apiResource('locations', 'LocationController');
            Route::apiResource('units', 'UnitController');
            Route::apiResource('categories', 'CategoryController');
            Route::apiResource('subcategories', 'SubcategoryController');
            Route::apiResource('products', 'ProductController');
            Route::apiResource('orders', 'OrderController');
            Route::apiResource('regions', 'RegionController');
            Route::apiResource('districts', 'DistrictController');
            Route::apiResource('wards', 'WardController');
            Route::apiResource('transactions', 'TransactionController');
            Route::apiResource('transactiontypes', 'TransactiontypeController');
            Route::get('auth', 'UserController@auth');
            Route::get('regions/{region}/districts', 'RegionController@regionDistricts');
            Route::get('regions/{region}/districts/wards', 'RegionController@regionDistrictsWards');
            Route::get('districts/{district}/wards', 'DistrictController@districtWards');
            Route::get('user/{user_id}/product/{product_id}/balance', 'UserController@userBalance');
            Route::get('users/{user}/products', 'UserController@userBalances');
            Route::get('users/{user}/transactions', 'TransactionController@userTransactions');
            Route::post('sms', 'UserController@sms')->name('sms.store');
            Route::get('products/{product}/users', 'UserController@productUsers')->name('product.users');
            Route::post('getsms', 'UserController@get_message');
    });