<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::namespace('App\Http\Controllers')->group(function () {

    Route::post('/login', 'Auth\AuthController@login');
    Route::post('/register', 'Auth\AuthController@register');


    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'Auth\AuthController@logout');
        Route::resource('/product', ProductController::class);
        Route::resource('/category', CategoryController::class);
        Route::resource('/profile', ProfileController::class);
    });
    Route::resource('/order', OrderController::class);
    Route::get('/product', 'ProductController@index');
    Route::get('/category', 'CategoryController@index');
    Route::get('/link', 'LinkController@index');
    Route::resource('/country', CountryController::class);
    Route::resource('/city', CityController::class);
    Route::resource('/state', StateController::class);
    Route::get('/settings', 'SettingController@index');
    Route::resource('/email', EmailController::class);
});
