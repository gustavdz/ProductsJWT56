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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
})->name('user');*/

Route::middleware(['jwt.auth'])->group(function(){

    Route::get('products','ProductsController@getAll')->name('getAllProducts');
    Route::get('products/{id}','ProductsController@get')->name('getProduct');
    Route::post('products','ProductsController@add')->name('addProduct');
    Route::post('products/{id}','ProductsController@edit')->name('editProduct');
    Route::get('products/delete/{id}','ProductsController@delete')->name('deleteProduct');

    Route::get('clients','ClientsController@getAll')->name('getAllClients');
    Route::get('clients/{id}','ClientsController@get')->name('getClient');
    Route::post('clients','ClientsController@add')->name('addClient');
    Route::post('clients/{id}','ClientsController@edit')->name('editClient');
    Route::get('clients/delete/{id}','ClientsController@delete')->name('deleteClient');

    Route::get('ptoventas','ClientsController@getAll')->name('getAllptoVentas');
    Route::get('ptoventa/{id}','ClientsController@get')->name('getptoVenta');
    Route::post('ptoventa','ClientsController@add')->name('addptoVenta');
    Route::post('ptoventa/{id}','ClientsController@edit')->name('editptoVenta');
    Route::get('ptoventa/delete/{id}','ClientsController@delete')->name('deleteptoVenta');

    Route::get('cabfacturas','ClientsController@getAll')->name('getAllcabfacturas');
    Route::get('cabfactura/{id}','ClientsController@get')->name('getcabfactura');
    Route::post('cabfactura','ClientsController@add')->name('addcabfactura');
    Route::post('cabfactura/{id}','ClientsController@edit')->name('editcabfactura');
    Route::get('cabfactura/delete/{id}','ClientsController@delete')->name('deletecabfactura');

    Route::get('detfacturas','ClientsController@getAll')->name('getAlldetfacturas');
    Route::get('detfactura/{id}','ClientsController@get')->name('getdetfacturas');
    Route::post('detfactura','ClientsController@add')->name('adddetfacturas');
    Route::post('detfactura/{id}','ClientsController@edit')->name('editdetfacturas');
    Route::get('detfactura/delete/{id}','ClientsController@delete')->name('deletedetfacturas');

    Route::get('auth/user', 'AuthenticateController@getAuthenticatedUser')->name('me');
    Route::post('auth/logout', 'AuthenticateController@logout')->name('logout');
    Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthenticateController@refresh')->name('refresh_token');

});

Route::post('login','AuthenticateController@authenticate')->name('login');






