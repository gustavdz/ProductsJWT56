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
    Route::post('clients/edit/{id}','ClientsController@update')->name('editaClientweb');
    Route::post('clients/edit_picture/{id}','ClientsController@update_picture')->name('editaClientweb');
    Route::get('clients/delete/{id}','ClientsController@destroy')->name('deleteClientweb');
    //Route::post('clients','ClientsController@indexview')->name('searchClientweb');
});
