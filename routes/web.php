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

//Ruta principal que manda al login
/* Route::get('/', '\App\Http\Controllers\Auth\LoginController@login'); */
Route::get('/', '\App\Http\Controllers\Auth\LoginController@logeoInicial');


Route::get('/home', function () { //modificado antes solo era / 
    return view('contenido/contenido');
});

Auth::routes();

/* Route::get('/home', 'HomeController@index')->name('home'); */

//ruta para deslogear
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
//ruta para logear
/* Route::get('/login', '\App\Http\Controllers\Auth\LoginController@login'); */

//---------Rutas para el UserController-----------
Route::get('/usuario','Admin\UserController@index');
Route::post('/usuario/registrar','Admin\UserController@store');
Route::put('/usuario/actualizar','Admin\UserController@update');
Route::delete('/usuario/{usuario}','Admin\UserController@destroy');
Route::put('/usuario/desactivar','Admin\UserController@desactivar');
Route::put('/usuario/activar','Admin\UserController@activar');