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
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
    Route::group(['prefix' => 'admin', 'namespace'=>'Admin', 'as'=>'admin.'], function () {
        Route::get('login', 'AuthController@showLoginForm')->name('login')->middleware('guest');
        Route::post('login', 'AuthController@login')->name('login')->middleware('guest');
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::group(['middleware'=>'admin'], function () {
            Route::get('/', 'LandingController@index')->name('index');
            Route::resource('users', 'UsersController');
        });
    });

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});