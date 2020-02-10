<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/admin', function (Request $request) {
    return view('admin');
});
Route::post('/registro','Login\LoginController@registro');
Route::post('/login','Login\LoginController@login');
Route::middleware('auth:api')->post('/logout', 'Login\LoginController@logout');
Route::post('/usuarios/login','Tables\UsuariosController@login');
Route::post('/usuarios/logout','Tables\UsuariosController@logout');



/* Productos */
Route::middleware('auth:api')->get("/productos",'Tables\ProductosController@index');
Route::middleware('auth:api')->post("/productos/save",'Tables\ProductosController@save');
Route::middleware('auth:api')->post("/productos/update",'Tables\ProductosController@update');
Route::middleware('auth:api')->post("/productos/delete",'Tables\ProductosController@delete');
/* Usuarios */
Route::middleware('auth:api')->get("/usuarios",'Tables\UsuariosController@index');
Route::middleware('auth:api')->post("/usuarios/save",'Tables\UsuariosController@save');
Route::middleware('auth:api')->post("/usuarios/update",'Tables\UsuariosController@update');
Route::middleware('auth:api')->post("/usuarios/delete",'Tables\UsuariosController@delete');
/* Proveedores */
Route::middleware('auth:api')->get("/proveedores",'Tables\ProveedoresController@index');
Route::middleware('auth:api')->post("/proveedores/save",'Tables\ProveedoresController@save');
Route::middleware('auth:api')->post("/proveedores/update",'Tables\ProveedoresController@update');
Route::middleware('auth:api')->post("/proveedores/delete",'Tables\ProveedoresController@delete');
/* Categorias */
Route::middleware('auth:api')->get("/categorias",'Tables\CategoriasController@index');
Route::middleware('auth:api')->post("/categorias/save",'Tables\CategoriasController@save');
Route::middleware('auth:api')->post("/categorias/update",'Tables\CategoriasController@update');
Route::middleware('auth:api')->post("/categorias/delete",'Tables\CategoriasController@delete');
/* Detalle Ventas */
Route::middleware('auth:api')->get("/detalleventas",'Tables\DetalleVentasController@index');
Route::middleware('auth:api')->post("/detalleventas/save",'Tables\DetalleVentasController@save');
Route::middleware('auth:api')->post("/detalleventas/update",'Tables\DetalleVentasController@update');
Route::middleware('auth:api')->post("/detalleventas/delete",'Tables\DetalleVentasController@delete');
/* Ventas */
Route::middleware('auth:api')->get("/ventas",'Tables\VentasController@index');
Route::middleware('auth:api')->post("/ventas/save",'Tables\VentasController@save');
Route::middleware('auth:api')->post("/ventas/update",'Tables\VentasController@update');
Route::middleware('auth:api')->post("/ventas/delete",'Tables\VentasController@delete');
