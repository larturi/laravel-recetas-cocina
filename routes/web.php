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

// Route::get('/recetas', 'RecetaController@index')->name('recetas.index');
// Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');
// Route::post('/recetas', 'RecetaController@store')->name('recetas.store');
// Route::get('/recetas/{receta}', 'RecetaController@show')->name('recetas.show');
// Route::get('/recetas/{receta}/edit', 'RecetaController@edit')->name('recetas.edit');
// Route::put('/recetas/{receta}', 'RecetaController@update')->name('recetas.update');

// Autenticacion
Auth::routes();

// Index
Route::get('/', 'RecetaController@index')->name('recetas.index');

// Resource Recetas
Route::resource('recetas', 'RecetaController');

// Resource Perfiles
Route::resource('perfils', 'PerfilController');

// Almacena los likes de las recetas
Route::post('/recetas/{receta}', 'LikesController@update')->name('likes.update');
