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

Route::middleware(['cors','jwt.auth'])->group(function(){

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

    Route::get('empresas','EmpresaController@getAll')->name('getAllEmpresas');
    Route::get('empresas/{id}','EmpresaController@get')->name('getEmpresa');
    Route::post('empresas','EmpresaController@add')->name('addEmpresa');
    Route::post('empresas/{id}','EmpresaController@edit')->name('editEmpresa');
    Route::get('empresas/delete/{id}','EmpresaController@delete')->name('deleteEmpresa');

    Route::get('ptoventas','PtoVentasController@getAll')->name('getAllptoVentas');
    Route::get('ptoventa/{id}','PtoVentasController@get')->name('getptoVenta');
    Route::post('ptoventa','PtoVentasController@add')->name('addptoVenta');
    Route::post('ptoventa/{id}','PtoVentasController@edit')->name('editptoVenta');
    Route::get('ptoventa/delete/{id}','PtoVentasController@delete')->name('deleteptoVenta');

    Route::get('cabfacturas','CabFacturasController@getAll')->name('getAllcabfacturas');
    Route::get('cabfactura/{id}','CabFacturasController@get')->name('getcabfactura');
    Route::post('cabfactura','CabFacturasController@add')->name('addcabfactura');
    Route::post('cabfactura/{id}','CabFacturasController@edit')->name('editcabfactura');
    Route::get('cabfactura/delete/{id}','CabFacturasController@delete')->name('deletecabfactura');

    Route::get('detfacturas/{cabfacturas_id}','DetFacturasController@getAll')->name('getAlldetfacturas');
    Route::get('detfactura/{id}','DetFacturasController@get')->name('getdetfacturas');
    Route::post('detfactura','DetFacturasController@add')->name('adddetfacturas');
    Route::post('detfactura/{id}','DetFacturasController@edit')->name('editdetfacturas');
    Route::get('detfactura/delete/{id}','DetFacturasController@delete')->name('deletedetfacturas');

    Route::get('auth/user', 'AuthenticateController@user')->name('me');
    Route::post('auth/logout', 'AuthenticateController@logout')->name('logout');
    Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthenticateController@refresh')->name('refresh_token');

});

Route::middleware(['cors'])->group(function(){
  Route::post('login','AuthenticateController@authenticate')->name('login');
  Route::post('register','AuthenticateController@register')->name('register');
});
