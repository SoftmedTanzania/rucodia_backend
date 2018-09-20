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
Route::get('api/v1/receive', 'HomeController@index')->name('sms.receive');

Route::group(
    array(
        'namespace' => 'web',
        'middleware' => 'auth'),
        function () {
            Route::Resource('users', 'UserController');
            Route::Resource('categories', 'CategoryController');
            Route::Resource('subcategories', 'SubcategoryController');
            Route::get('/users/districts/{id}', 'UserController@ajaxdistricts');
            Route::get('/users/wards/{id}', 'UserController@ajaxwards');
            Route::get('/excel/import/users', 'UserController@excelImportUsers')->name('excelImportUsers');
            Route::post('excel/import/mass', 'UserController@massImportUsers')->name('massImportUsers');
    });