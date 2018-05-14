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

Route::resource('users', 'UserController')->middleware('auth.basic.once');
Route::resource('levels', 'LevelController')->middleware('auth.basic.once');
Route::resource('locations', 'LocationController')->middleware('auth.basic.once');
Route::resource('units', 'UnitController')->middleware('auth.basic.once');
Route::resource('categories', 'CategoryController')->middleware('auth.basic.once');
Route::resource('products', 'ProductController')->middleware('auth.basic.once');
Route::resource('orders', 'OrderController')->middleware('auth.basic.once');
