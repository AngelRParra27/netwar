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
    return view('welcome');
});
Route::get('/getCiudades', 'contactosController@getCiudades');
route::resource('/contactos', 'contactosController');
Route::resource('/citas', 'citasControlles');
Route::get('/reporte', 'citasControlles@reporteCitas');
route::get('/getCitasMes', 'citasControlles@reporteCitasMes');
