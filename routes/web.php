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

//SELECTOR DE PERIODOS
Route::get('/periodo', 'HomeController@managePeriodos');
Route::post('/redirectPeriodo', 'HomeController@redirectPeriodos');

//Route::resource('/cuestionario', 'CuestionarioController');//ruta para posterior actualizacion
//ENCUESTAS-----------------------------------------------------------------------------------------------------------------------------------------
Route::get('/', function () {
     return redirect('/registro');
});

Route::post('/findPersona', 'CuestionarioController@findPersona');

Route::resource('/registro', 'CuestionarioController');
// Route::get('/saved', function () {
//         return view('cuestionario.save');
// });
Route::get('/imprimir/{imprimir}', 'CuestionarioController@imprimir');//imprime un pdf <---------------------------------------

//LOGIN/REGISTRO-------------------------------------------------------------------------------------------------------------------------------------
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register/success', 'Auth\RegisterController@success');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/qwerty',function(){
//     return view('layouts.sidebar');
// });
//ADMIN/ENTRGAS----------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin/entrega','Admin\EntregaController@index')->name('buscar');

Route::post('/admin/findPersonaEntrega', 'Admin\EntregaController@findPersonaEntrega');

Route::post('/admin/findListaEntregas/{entrega}', 'Admin\EntregaController@findEntregas');

Route::delete('/admin/entrega/revertirEntrega/{entrega}', 'Admin\EntregaController@revertirEntrega');//revertir las entregas por admins


Route::post('/admin/entrega/{entrega}', 'Admin\EntregaController@registrarEntrega');

Route::post('/admin/entrega/documentacion/{entrega}', 'Admin\EntregaController@registrarDocumentacion');

Route::post('/admin/findDocumentacion/{entrega}', 'Admin\EntregaController@findDocumentacion');



Route::get('/admin/entrega/xx','Admin\EntregaController@contra');//PARA LAS CONTRASEÑAS

//REPORTES------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin/reporte','Admin\ReporteController@index')->name('reporte');
Route::post('/admin/reporte/findcolonias/{reporte}','Admin\ReporteController@findcolonias');
Route::post('/admin/reporte/findReporte','Admin\ReporteController@findReporte');

//USUARIOS------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin/user','Admin\UsuarioController@index')->name('usuarios');
Route::get('/admin/user/{user}/edit','Admin\UsuarioController@editarUsuario');
Route::get('/admin/user/pass/{user}/edit','Admin\UsuarioController@editarcontraseña');
Route::put('/admin/user/{user}', 'Admin\UsuarioController@actualizarUsuario');//actualizar datos de usuario
Route::put('/admin/user/pass/{user}', 'Admin\UsuarioController@actualizarContraseña');//actualizar contraseña
Route::put('/admin/user/deshabilitar/{user}', 'Admin\UsuarioController@deshabilitarUsuario');//deshabilita al usuario

//ESPECIAL---------------------------------------------------------------------------------------------------
Route::get('/especial/direccion','LayoutController@direccion');
