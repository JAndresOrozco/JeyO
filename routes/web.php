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

Route::get('/', function () {
    return view('admin');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::post('/login','Login\LoginController@login');
Route::post('/register','Login\LoginController@register');
Route::post('/logout','Login\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Productos */
Route::get("/productos",'Tables\ProductosController@index');
Route::post("/productos/save",'Tables\ProductosController@save');
Route::post("/productos/update",'Tables\ProductosController@update');
Route::post("/productos/delete",'Tables\ProductosController@delete');
/* Usuarios */
Route::get("/usuarios",'Tables\UsuariosController@index');
Route::post("/usuarios/save",'Tables\UsuariosController@save');
Route::post("/usuarios/update",'Tables\UsuariosController@update');
Route::post("/usuarios/delete",'Tables\UsuariosController@delete');
/* Proveedores */
Route::get("/proveedores",'Tables\ProveedoresController@index');
Route::post("/proveedores/save",'Tables\ProveedoresController@save');
Route::post("/proveedores/update",'Tables\ProveedoresController@update');
Route::post("/proveedores/delete",'Tables\ProveedoresController@delete');
/* Categorias */
Route::get("/categorias",'Tables\CategoriasController@index');
Route::post("/categorias/save",'Tables\CategoriasController@save');
Route::post("/categorias/update",'Tables\CategoriasController@update');
Route::post("/categorias/delete",'Tables\CategoriasController@delete');
/* Detalle Ventas */
Route::get("/detalleventas",'Tables\DetalleVentasController@index');
Route::post("/detalleventas/save",'Tables\DetalleVentasController@save');
Route::post("/detalleventas/update",'Tables\DetalleVentasController@update');
Route::post("/detalleventas/delete",'Tables\DetalleVentasController@delete');
/* Ventas */
Route::get("/ventas",'Tables\VentasController@index');
Route::post("/ventas/save",'Tables\VentasController@save');
Route::post("/ventas/update",'Tables\VentasController@update');
Route::post("/ventas/delete",'Tables\VentasController@delete');