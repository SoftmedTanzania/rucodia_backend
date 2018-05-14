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

Route::apiResource('users', 'UserController')->middleware('auth.basic.once');
Route::apiResource('levels', 'LevelController')->middleware('auth.basic.once');
Route::apiResource('locations', 'LocationController')->middleware('auth.basic.once');
Route::apiResource('units', 'UnitController')->middleware('auth.basic.once');
Route::apiResource('categories', 'CategoryController')->middleware('auth.basic.once');
Route::apiResource('subcategories', 'SubcategoryController')->middleware('auth.basic.once');
Route::apiResource('products', 'ProductController')->middleware('auth.basic.once');
Route::apiResource('orders', 'OrderController')->middleware('auth.basic.once');

Route::apiResource('regions', 'RegionController')->middleware('auth.basic.once');
Route::get('regions/{region}/districts', 'RegionController@regionDistricts')->middleware('auth.basic.once');
Route::get('regions/{region}/districts/wards', 'RegionController@regionDistrictsWards')->middleware('auth.basic.once');

Route::apiResource('districts', 'DistrictController')->middleware('auth.basic.once');
Route::get('districts/{district}/wards', 'DistrictController@districtWards')->middleware('auth.basic.once');

Route::apiResource('wards', 'WardController')->middleware('auth.basic.once');

Route::get('auth', 'UserController@auth')->middleware('auth.basic.once');
Route::get('users/{id}/balance', 'UserController@userBalance')->middleware('auth.basic.once');

Route::apiResource('transactions', 'TransactionController')->middleware('auth.basic.once');
Route::apiResource('transactiontypes', 'TransactiontypeController')->middleware('auth.basic.once');
