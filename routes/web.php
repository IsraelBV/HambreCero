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

 Route::get('/', function () {
     return redirect('/registro');
});

Route::post('/findPersona', 'CuestionarioController@findPersona');

Route::resource('/registro', 'CuestionarioController');
// Route::get('/saved', function () {
//         return view('cuestionario.save');
// });


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register/success', 'Auth\RegisterController@success');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/qwerty',function(){
//     return view('layouts.sidebar');
// });

Route::post('/admin/findPersonaEntrega', 'Admin\EntregaController@findPersonaEntrega');

Route::get('/admin/entrega','Admin\EntregaController@index')->name('buscar');

Route::put('/admin/entrega/{entrega}', 'Admin\EntregaController@registrarEntrega');

Route::post('/admin/entrega/documentacion/{entrega}', 'Admin\EntregaController@registrarDocumentacion');

Route::post('/admin/findDocumentacion', 'Admin\EntregaController@findDocumentacion');

Route::put('/admin/entrega/revertirEntrega/{entrega}', 'Admin\EntregaController@revertirEntrega');//revertir las entregas por admins


Route::get('/admin/entrega/xx','Admin\EntregaController@contra');

