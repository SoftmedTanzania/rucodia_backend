<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/api/v1/docs', 'HomeController@apidocs')->name('apidocs');

Route::group(
    array(
        'namespace' => 'web',
        'middleware' => 'auth'),
        function () {
            Route::Resource('users', 'UserController');
            // Route::Resource('levels', 'LevelController');
            // Route::Resource('locations', 'LocationController');
            // Route::Resource('units', 'UnitController');
            Route::Resource('categories', 'CategoryController');
            Route::Resource('subcategories', 'SubcategoryController');
            // Route::Resource('products', 'ProductController');
            // Route::Resource('orders', 'OrderController');
            // Route::Resource('regions', 'RegionController');
            // Route::Resource('districts', 'DistrictController');
            // Route::Resource('wards', 'WardController');
            // Route::Resource('transactions', 'TransactionController');
            // Route::Resource('transactiontypes', 'TransactiontypeController');
            // Route::get('auth', 'UserController@auth');
            // Route::get('regions/{region}/districts', 'RegionController@regionDistricts');
            // Route::get('regions/{region}/districts/wards', 'RegionController@regionDistrictsWards');
            // Route::get('districts/{district}/wards', 'DistrictController@districtWards');
            // Route::get('user/{user_id}/product/{product_id}/balance', 'UserController@userBalance');
            // Route::get('users/{user}/products', 'UserController@userBalances');
            // Route::get('users/{user}/transactions', 'TransactionController@userTransactions');
            Route::get('/users/districts/{id}', 'UserController@ajaxdistricts');
            Route::get('/users/wards/{id}', 'UserController@ajaxwards');

    });