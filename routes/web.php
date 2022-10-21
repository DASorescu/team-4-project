<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::middleware('auth')->prefix('admin')->name('admin.')->namespace('Admin')->group( function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/users/edit', 'Users\UserDetailController@edit')->name('users.edit');
    Route::resource('/users/services','Users\ServiceController');
    Route::put('/users/update', 'Users\UserDetailController@update')->name('users.update');
    Route::get('/users/sponsorships/create', 'Users\SponsorshipController@create')->name('users.sponsorships.create');
    Route::post('/users/sponsorships/store', 'Users\SponsorshipController@store')->name('users.sponsorships.store');
    
    Route::get('/{any}', function(){
        abort('404');
    })->where('any', '.*');
        
    
});

Route::get('/', function () {
    return view('guest.home');
});
