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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/',  'Auth\LoginController@showLoginForm');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('clients','ClientsController@indexview')->name('getAllClientsweb');
    Route::get('clients/create','ClientsController@createview')->name('getAllClientsweb');
    Route::post('clients/store','ClientsController@store')->name('addClientweb');
    Route::get('clients/edit/{id}','ClientsController@getview')->name('editClientweb');
    Route::post('clients/edit/{id}','ClientsController@update')->name('updateClientweb');
    Route::post('clients/edit_picture/{id}','ClientsController@update_picture')->name('editPicClientweb');
    Route::get('clients/delete/{id}','ClientsController@destroy')->name('deleteClientweb');

    Route::get('products','ProductsController@indexview')->name('getAllProductsweb');
    Route::get('products/create','ProductsController@createview')->name('getAllProductsweb');
    Route::post('products/store','ProductsController@store')->name('addProductweb');
    Route::get('products/edit/{id}','ProductsController@getview')->name('editProductweb');
    Route::post('products/edit/{id}','ProductsController@update')->name('updateProductweb');
    Route::post('products/edit_picture/{id}','ProductsController@update_picture')->name('editPicProductweb');
    Route::get('products/delete/{id}','ProductsController@destroy')->name('deleteProductweb');
});
