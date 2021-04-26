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

Route::get('/home','App\Http\Controllers\RegistrosController@index');
Route::get('/','App\Http\Controllers\RegistrosController@index');
Route::post('/registro','App\Http\Controllers\RegistrosController@registro');
Route::get('/archivo/{id}','App\Http\Controllers\RegistrosController@archivo');
Route::post('/insert','App\Http\Controllers\RegistrosController@insertRegistro');