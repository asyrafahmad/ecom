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

Route::prefix('/admin')->namespace('Admin')->group(function(){
    // All the admin routes will be defined here
    Route::match(['get','post'],'/','AdminController@login');               // url: http://127.0.0.1:8000/admin/

    Route::group(['middleware'=>['admin']], function(){

        Route::get('dashboard','AdminController@dashboard');                // url: http://127.0.0.1:8000/admin/dashboard
        Route::get('logout','AdminController@logout');
    });
});
