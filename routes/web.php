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

Route::middleware('auth')->get('/', function () {
    return view('admin');
});
Route::middleware('auth')->get('/admin', function () {
    return view('admin');
});

Route::middleware('auth')->get('/home', function () {
    return view('admin');
});


// Route::get('/login', function () {
//     return view('login');
// });
Route::get('/register', function () {
    return view('register');
});
// Route::post('/login','Login\LoginController@login');
// Route::post('/register','Login\LoginController@register');
// Route::post('/logout','Login\LoginController@logout');
Route::middleware('auth')->post('/usuarios/activarToken','Tables\UsuariosController@activarToken');
Route::middleware('auth')->post('/usuarios/desactivarToken','Tables\UsuariosController@desactivarToken');

Auth::routes();

// Route::get('/home', 'layouts\HomeController@index')->name('home');

/* Productos */
Route::middleware('auth')->get("/productos",'Tables\ProductosController@index');
Route::middleware('auth')->post("/productos/save",'Tables\ProductosController@save');
Route::middleware('auth')->post("/productos/update",'Tables\ProductosController@update');
Route::middleware('auth')->post("/productos/delete",'Tables\ProductosController@delete');
/* Usuarios */
Route::middleware('auth')->get("/usuarios",'Tables\UsuariosController@index');
Route::middleware('auth')->post("/usuarios/save",'Tables\UsuariosController@save');
Route::middleware('auth')->post("/usuarios/update",'Tables\UsuariosController@update');
Route::middleware('auth')->post("/usuarios/delete",'Tables\UsuariosController@delete');

/* Proveedores */
Route::middleware('auth')->get("/proveedores",'Tables\ProveedoresController@index');
Route::middleware('auth')->post("/proveedores/save",'Tables\ProveedoresController@save');
Route::middleware('auth')->post("/proveedores/update",'Tables\ProveedoresController@update');
Route::middleware('auth')->post("/proveedores/delete",'Tables\ProveedoresController@delete');
/* Categorias */
Route::middleware('auth')->get("/categorias",'Tables\CategoriasController@index');
Route::middleware('auth')->post("/categorias/save",'Tables\CategoriasController@save');
Route::middleware('auth')->post("/categorias/update",'Tables\CategoriasController@update');
Route::middleware('auth')->post("/categorias/delete",'Tables\CategoriasController@delete');
/* Detalle Ventas */
Route::middleware('auth')->get("/detalleventas",'Tables\DetalleVentasController@index');
Route::middleware('auth')->post("/detalleventas/save",'Tables\DetalleVentasController@save');
Route::middleware('auth')->post("/detalleventas/update",'Tables\DetalleVentasController@update');
Route::middleware('auth')->post("/detalleventas/delete",'Tables\DetalleVentasController@delete');
/* Ventas */
Route::middleware('auth')->get("/ventas",'Tables\VentasController@index');
Route::middleware('auth')->post("/ventas/save",'Tables\VentasController@save');
Route::middleware('auth')->post("/ventas/update",'Tables\VentasController@update');
Route::middleware('auth')->post("/ventas/delete",'Tables\VentasController@delete');
