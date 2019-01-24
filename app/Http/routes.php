<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/acerca', function () {
    return view('acerca');
});

Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/proveedor','ProveedorController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('ventas/venta','VentaController');
Route::resource('seguridad/usuario','UsuarioController');
Route::resource('seguridad/backup','BackupController');
Route::resource('salida','SalidaController');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('caja/resumen', 'ResumenCajaController@resumen');
Route::get('caja/cierre', 'ResumenCajaController@index');
Route::get('caja/create', 'ResumenCajaController@create');
Route::post('caja/create', 'ResumenCajaController@store');
Route::get('caja/edit/{id}',['as' => 'caja.edit', 'uses'=>'ResumenCajaController@edit']);
Route::put('caja/{id}', ['as' => 'caja.update', 'uses' => 'ResumenCajaController@update']);
// Route::put('caja/edit', 'ResumenCajaController@update');
//Route::get('herramientas/backup', 'BackupController@index');

Route::get('imprimir', 'VentaController@imprimir');
Route::get('estado', 'EstadoController@vistaestado');
//Reportes
Route::get('reportecategorias', 'CategoriaController@reporte');
Route::get('reportearticulos', 'ArticuloController@reporte');
Route::get('reporteclientes', 'ClienteController@reporte');
Route::get('reportecliente/{id}', 'ClienteController@report');
Route::get('reporteproveedores', 'ProveedorController@reporte');
Route::get('reporteventas/{searchText}', 'VentaController@reporte');
Route::get('reporteventa/{id}', 'VentaController@reportec');
Route::get('reportecajas/{searchText}', 'ResumenCajaController@reporte');
Route::get('reportecaja/{id}', 'ResumenCajaController@reportec');
Route::get('reportesalida/{id}', 'SalidaController@reportec');
Route::get('reporteingresos', 'IngresoController@reporte'); 
Route::get('reporteingreso/{id}', 'IngresoController@reportec'); 
Route::get('reportecuentas/{cliente?}/{credito?}', 'EstadoController@reporte'); 
Route::get('/{slug?}', 'HomeController@index');
