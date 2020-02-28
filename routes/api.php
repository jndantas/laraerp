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

Route::apiResources([
    'user' => 'API\UserController',
    'category' => 'API\CategoryController',
    'sector' => 'API\SectorController',
    'authorizationcertificate' => 'API\AuthorizationCertificateController',
    'enterprise' => 'API\EnterpriseController',
    'product' => 'API\ProductController',
    'employee' => 'API\EmployeeController',
    'position' => 'API\PositionController',
    'typeaccident' => 'API\TypeAccidentController',
    'accident' => 'API\AccidentController',
    'trainning' => 'API\TrainingController',
    'exam' => 'API\ExamController',
    'stock_entries' => 'API\InputController',
    'stock_outputs' => 'API\OutputController',
]);
Route::get('getCategories', 'API\ProductController@getCategories');
Route::get('getCertificates', 'API\ProductController@getCertificates')->name('getCertificates');
Route::get('getEnterprises', 'API\EmployeeController@getEnterprises');
Route::get('getPositions', 'API\EmployeeController@getPositions');
Route::get('getTypeAccidents', 'API\AccidentController@getTypeAccidents');
Route::get('getEmployees', 'API\AccidentController@getEmployees');
Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@updateProfile');
