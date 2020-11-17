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

// Route::get('/exl', function () {
//     return view('cuestionario.save');
// });

// Route::post('/exl', 'LayoutController@LectorExel');

// Route::get('/', 'LayoutController@index');

//Route::resource('/cuestionario', 'CuestionarioController');//ruta para posterior actualizacion

Route::post('/findPersona', 'CuestionarioController@findPersona');

Route::resource('/registro', 'CuestionarioController');
// Route::get('/saved', function () {
//         return view('cuestionario.save');
// });

