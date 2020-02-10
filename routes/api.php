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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/registro','Login\LoginController@registro');
Route::post('/login','Login\LoginController@login');
Route::middleware('auth:api')->post('/logout', 'Login\LoginController@logout');
Route::post('/mostrar','Tables\TableController@mostrarProductos');
