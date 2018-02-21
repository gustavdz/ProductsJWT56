<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Ejoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['jwt.auth'])->group(function(){
    Route::get('products','ProductsController@getAll')->name('getAllProducts');
    Route::get('products/{id}','ProductsController@get')->name('getProduct');
    Route::post('products','ProductsController@add')->name('addProducts');
    Route::post('products/{id}','ProductsController@edit')->name('editProduct');
    Route::get('products/delete/{id}','ProductsController@delete')->name('deleteProduct');
    Route::get('auth/user', 'AuthenticateController@user')->name('me');
    Route::post('auth/logout', 'AuthenticateController@logout')->name('logout');
    Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthenticateController@refresh')->name('refresh_token');
});

Route::post('login','AuthenticateController@authenticate')->name('login');




