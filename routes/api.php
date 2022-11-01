<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', 'Api\HomeController@index');

//rotte che servono a me
Route::get('/search/{specialization_id}', 'Api\SearchDoctorController@show');
Route::get('/search', 'Api\SearchDoctorController@index');

Route::get('/specializations', 'Api\SpecializationController@index');
Route::get('/users/{id}', 'Api\UserController@show');
Route::get('/users', 'Api\UserController@index');
Route::get('/user/reviews/{id}', 'Api\UserController@reviews');
Route::post('/user/{id}/reviews', 'Api\UserController@addReview');
Route::post('/user/{id}/messages', 'Api\UserController@addMessage');
Route::get('/specializations/{id}', 'Api\SpecializationController@show');
