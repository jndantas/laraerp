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

Auth::routes(['register' => false]);

Route::get('/admin/home', 'HomeController@index')->name('home');


Route::group(['namespace'=>'Admin'], function () {
    Route::get('categories', 'SesmtController@category')->name('categories');
    Route::get('enterprises', 'SesmtController@enterprise')->name('enterprises');
    Route::get('admin/certificates', 'SesmtController@certificate')->name('certificates');
    Route::get('products', 'SesmtController@product')->name('products');
    Route::get('positions', 'SesmtController@position')->name('positions');
    Route::get('sectors', 'SesmtController@sector')->name('sectors');
    Route::get('typeaccident', 'SesmtController@typeaccident')->name('typeaccident');
    Route::get('accidents', 'SesmtController@accident')->name('accidents');
    Route::get('exams', 'SesmtController@exam')->name('exams');
    Route::get('inputs', 'SesmtController@input')->name('inputs');
    Route::get('outputs', 'SesmtController@output')->name('outputs');
    Route::get('trainings', 'SesmtController@training')->name('trainings');
    Route::get('users', 'AdminController@user')->name('users');
    Route::get('developer', 'AdminController@developer')->name('developer');
    Route::get('profile', 'AdminController@profile')->name('profile');
    Route::get('inputstock/{product}', 'ProductStockController@getViewInput')->name('inputStock');
    Route::get('outputstock/{product}', 'ProductStockController@getViewOutput')->name('outputStock');
    Route::post('inputstock', 'ProductStockController@storeInput')->name('storeInput');
    Route::post('outputstock', 'ProductStockController@storeOutput')->name('storeOutput');
    Route::resource('employees', 'EmployeeController');
});

