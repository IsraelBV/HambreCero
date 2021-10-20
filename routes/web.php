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
Route::get('/periodo', 'Auth\PeriodosController@managePeriodos');
Route::post('/redirectPeriodo', 'Auth\PeriodosController@redirectPeriodos');

//Route::resource('/cuestionario', 'CuestionarioController');//ruta para posterior actualizacion
//ENCUESTAS-----------------------------------------------------------------------------------------------------------------------------------------
Route::get('/', function () {
     if (session()->has('periodo')) {
          
          if (session('periodo') != 3) {
               return redirect('/registro2020');
          } else {
               return redirect('/registro');
          }
     } else {
          return redirect('/registro');
     }
});

Route::post('/findPersona2020', 'P2020\CuestionarioController@findPersona');

Route::resource('/registro2020', 'P2020\CuestionarioController');
// Route::get('/saved', function () {
//         return view('cuestionario.save');
// });
Route::get('/imprimir2020/{imprimir}', 'P2020\CuestionarioController@imprimir');//imprime un pdf <---------------------------------------

//LOGIN/REGISTRO-------------------------------------------------------------------------------------------------------------------------------------
Auth::routes();
Route::get('/home', [App\Http\Controllers\P2021\HomeController::class, 'index'])->name('home');
Route::get('/register/success', 'Auth\RegisterController@success');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/qwerty',function(){
//     return view('layouts.sidebar');
// });
//ADMIN/ENTRGAS 2020----------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin2020/entrega','P2020\Admin\EntregaController@index')->name('buscar');

Route::post('/admin2020/findPersonaEntrega', 'P2020\Admin\EntregaController@findPersonaEntrega');

Route::post('/admin2020/findListaEntregas/{entrega}', 'P2020\Admin\EntregaController@findEntregas');

Route::get('/admin2020/entrega/{entrega}/edit','P2020\Admin\EntregaController@editarEntrega');

Route::put('/admin2020/entrega/{entrega}','P2020\Admin\EntregaController@actualizarEntrega');// editar una entrega

Route::delete('/admin2020/entrega/revertirEntrega/{entrega}', 'P2020\Admin\EntregaController@revertirEntrega');//revertir las entregas por admins

Route::post('/admin2020/entrega/{entrega}', 'P2020\Admin\EntregaController@registrarEntrega');

Route::post('/admin2020/entrega/documentacion/{entrega}', 'P2020\Admin\EntregaController@registrarDocumentacion');

Route::post('/admin2020/findDocumentacion/{entrega}', 'P2020\Admin\EntregaController@findDocumentacion');



Route::get('/admin2020/entrega/xx','P2020\Admin\EntregaController@contra');//PARA LAS CONTRASEÑAS

//REPORTES------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin2020/reporte','P2020\Admin\ReporteController@index')->name('reporte');
Route::post('/admin2020/reporte/findcolonias/{reporte}','P2020\Admin\ReporteController@findcolonias');
Route::post('/admin2020/reporte/findReporte','P2020\Admin\ReporteController@findReporte');

//USUARIOS------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin2020/user','P2020\Admin\UsuarioController@index')->name('usuarios');
Route::get('/admin2020/user/{user}/edit','P2020\Admin\UsuarioController@editarUsuario');
Route::get('/admin2020/user/pass/{user}/edit','P2020\Admin\UsuarioController@editarcontraseña');
Route::put('/admin2020/user/{user}', 'P2020\Admin\UsuarioController@actualizarUsuario');//actualizar datos de usuario
Route::put('/admin2020/user/pass/{user}', 'P2020\Admin\UsuarioController@actualizarContraseña');//actualizar contraseña
Route::put('/admin2020/user/deshabilitar/{user}', 'P2020\Admin\UsuarioController@deshabilitarUsuario');//deshabilita al usuario

//ESPECIAL---------------------------------------------------------------------------------------------------
Route::get('/especial2020/direccion','P2020\LayoutController@direccion');/// especial para pasar la direccion concatenada a la direccion en la bitacora


/////2021/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////2021/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////2021/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::resource('/registro', 'P2021\CuestionarioController');

Route::post('/findPersona', 'P2021\CuestionarioController@findPersona');

Route::post('/registro/pass/{user}/edit','P2021\CuestionarioController@editPasswordPersona');
Route::put('/registro/pass/{user}', 'P2021\CuestionarioController@updatePasswordPersona');

Route::post('/registro/passlost','P2021\CuestionarioController@passwordRecover');//recuperacion de contraseña

Route::post('/registro/Entrega/solicitar/{user}', 'P2021\CuestionarioController@storeDocumentacion');

/////especial/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////especial/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     Route::get('/especial/import', function () {
          return view('2021.layouts.import');
     });
     Route::post('/especial/importepersonas', 'P2021\CuestionarioController@importePersonas');
/////especial/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::post('/documentacion/edit','P2021\CuestionarioController@buildFormDocumentos');

Route::get('/documentacion/download/{documento}/{idpersona}','P2021\CuestionarioController@downloadDocument');
Route::get('/documentacion/download/{documento}/{idpersona}/{iddocumentacion}','P2021\CuestionarioController@downloadDocument');

Route::post('/documentacion/update/{iddocumentacion}', 'P2021\CuestionarioController@updateDocumentacion');

Route::post('/documentacion/delete/{documento}', 'P2021\CuestionarioController@deleteDocument');


Route::get('/entrega/enUpdate','P2021\Admin\EntregaController@buildFormEntregaEnUpdate');

Route::post('/entrega/enUpdate/{entrega}', 'P2021\Admin\EntregaController@EntregaEnUpdate');


Route::get('/entrega/enUpdatePost','P2021\Admin\EntregaController@buildFormPostEntregaEnUpdate');

/////Administracion de catalogos y stock
Route::post('/catalogo/stock/update', 'P2021\Admin\EntregaController@stockUpdate');// hay que cambiar el controlador cuando de haga la parte de administracion de catalogo
Route::get('/catalogo/stock/update/centrose/{ce}', 'P2021\Admin\EntregaController@stockGetCentros');// obtiene los centros de entrega para listarlos
Route::post('/catalogo/stock/update/transferencia', 'P2021\Admin\EntregaController@stockTransferencia');// hace la transferencia de despensas

///// Utilidad
Route::get('/utils/localidad','P2021\CuestionarioController@findLocalidades');
Route::get('/utils/colonia','P2021\CuestionarioController@findColonias');
Route::get('/utils/buscarBeneficiario', function () { return view('2021.cuestionario.buscarbeneficiario');});
Route::get('/utils/buscarBeneficiario/coincidencia','P2021\CuestionarioController@findPersonasPorCoincidencia');//<==================================================

// Route::get('/utils/buscarBeneficiario','P2021\CuestionarioController@findPersonasPorCoincidencia');


//REPORTES------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin2021/reporte','P2021\Admin\ReporteController@index')->name('reporte2021');
Route::post('/admin2021/reporte/findReporte','P2021\Admin\ReporteController@findReporte');
// Route::get('/admin2021/reporte/downloadReporte','P2021\Admin\ReporteController@downloadReporte');


//Modulo entregas------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin2021/entrega','P2021\Admin\EntregaController@index')->name('buscar2021');
Route::get('/admin2021/entrega/edit','P2021\Admin\EntregaController@editarEntrega');
Route::put('/admin2021/entrega/{entrega}','P2021\Admin\EntregaController@actualizarEntrega');