<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/usuarios', function () {
    return view('usuarios.index');
})->middleware('auth');

//Route::resource('usuarios', 'UserController')->middleware('auth');
// Route::resource('/usuarios/perfil', 'UserController@perfil');
Route::resource('userTipo', 'UserTipoController');
Route::resource('hogar', 'HogarController');

Route::get('/mifactura', 'FacturaController@mifactura');
Route::get('factura/{id}', 'FacturaController@index');
Route::post('/factura/create', 'FacturaController@store');
Route::resource('factura', 'FacturaController');


Route::get('consumo/{id}', 'ConsumoController@index');
Route::resource('consumo', 'ConsumoController');
//Route::patch('consumo/{id}', 'ConsumoController@index')->name('consumo.index');

//Route::patch('misvistas/docente/{id}', 'DocenteController@actualizarusuario');
//Route::patch('misvistas/docente/{id}', 'DocenteController@actualizarusuario')->name('docente.actualizarusuario');

Route::get('estancia/{id}', 'EstanciaController@index');
Route::post('/estancia/create', 'EstanciaController@store');
Route::resource('estancia', 'EstanciaController');

//olo con esta forma se valida para que si inicia sesion no puede entrar 
//otra dorma es en el controllores
Route::resource('tipoSensor', 'TipoSensorController');
Route::post('/tipoSensor/create', 'TipoSensorController@store');
Route::resource('sensores', 'DispositivoController');
Route::post('/sensores/create', 'DispositivoController@store');

Route::resource('administracion', 'AdministracionController');
Route::put('/administracion/create/{id}', 'AdministracionController@store');


Route::resource('administracionHogar', 'AdministracionHogarController');
Route::put('/administracionHogar/create/{id}', 'AdministracionHogarController@store');
//Route::post('/estancia/create', 'EstanciaController@store');

Route::get('almacenamiento/{id}', 'AlmacenamientoController@index');
Route::resource('almacenamiento', 'AlmacenamientoController');

Route::resource('/notas/todas', 'NotaController');
Route::get('/notas/favoritas', 'NotaController@favoritas');
Route::get('/notas/archivadas', 'NotaController@archivadas');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//  Route::get ('estancia/{id_hogar?}', function ( $id_hogar =null){
//      return  $id_hogar;
//  });


//enviar variable atravez de un parametro
//<a  href=”{{ (‘parametro/2’)}}”>Valor del Parametro</a>
//Route::get(‘parametro/{id}’,’Ctrl_parametro@index’)->name(‘parametro’);

// public function index (Request $request, $id){
//     echo $id;
//  }
