<?php

use Illuminate\Support\Facades\Route;

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
/*
 Route::get('/crear', 'App\Http\Controllers\ClienteController@create')->name('agregar');
 Route::post('/agregar', 'App\Http\Controllers\ClienteController@store')->name('store');
 Route::get('/mostrar', 'App\Http\Controllers\ClienteController@show')->name('show');
 Route::get('/editar', 'App\Http\Controllers\ClienteController@update')->name('update');
 Route::get('/eliminar', 'App\Http\Controllers\ClienteController@eliminar')->name('borrar');
 Route::delete('/borrar/{dni}', 'App\Http\Controllers\ClienteController@destroy')->name('destroy'); */

Route::get('/', 'App\Http\Controllers\ClienteController@index')->name('inicio');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homeFactura', [App\Http\Controllers\HomeFacturaController::class, 'index'])->name('homeFactura');
Route::get('/homeEmpleado', [App\Http\Controllers\HomeEmpleadoController::class, 'index'])->name('homeEmpleado');
Route::get('/homeCliente', [App\Http\Controllers\HomeClienteController::class, 'index'])->name('homeCliente');

Route::resource('/clientes', App\Http\Controllers\ClienteController::class);
Route::resource('/facturas', App\Http\Controllers\FacturaController::class);
Route::resource('/empleados', App\Http\Controllers\EmpleadoController::class);
