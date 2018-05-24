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

    Route::get('clients','ClientsController@index')->name('getAllClients');
    Route::get('clients/{id}','ClientsController@get')->name('getClient');
    Route::post('clients','ClientsController@add')->name('addClient');
    Route::post('clients/{id}','ClientsController@edit')->name('editClient');
    Route::get('clients/delete/{id}','ClientsController@delete')->name('deleteClient');
});
