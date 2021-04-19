<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

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
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/pruebas',function(){
  $colaborador_id = 1;
  //whereHas condicion anonima default
  //$colaborador_telefonos = App\Models\Empresas_colaboradore::with('telefonos_Ecol')->where('id',$colaborador_id)->get();
  //$colaborador_correos = App\Models\Empresas_colaboradore::with('correos_ECol')->where('id',$colaborador_id)->get();
  dd(\Hash::make('Master21'));
  //dd($colaborador_correos, $colaborador_telefonos);
});

Route::get('/logeo',[UsuariosController::class,'verLogin'])->name('VerLogin');
Route::post('/iniciar_sesion',[ UsuariosController::class,'loginUsuario'])->name('LoginUsuario');

Route::get('/', [UsuariosController::class, 'verWelcome'])->name('VerWelcome');
Route::get('/met', [UsuariosController::class, 'verMet'])->name('VerMet');
Route::get('/oshun',[UsuariosController::class, 'verOshun'])->name('VerOshun');
Route::get('/mooc',[UsuariosController::class, 'verMooc'])->name('VerMooc');


Route::get('/{empresa}/colaboradores/lista',[UsuariosController::class, 'listaColaboradores'])->name('ListaColaboradores');

Auth::routes();
Route::get('/home',[UsuariosController::class,'verHome'])->name('Home');
Route::any('/{empresa}/colaboradores/registro', [UsuariosController::class, 'registroColaborador'])->name('RegistroColaborador');
Route::post('/usuarios/registrar', [UsuariosController::class, 'registrarColaborador'])->name('RegistrarColaborador');
Route::get('/colaboradores/editor/{correo}',[UsuariosController::class,'editorColaborador'])->name('EditorColaborador');
Route::post('/colaboradores/actualizar/{correo}',[UsuariosController::class,'actualizarColaborador'])->name('ActualizarColaborador');
Route::get('/colaboradores/borrar/{correo}',[UsuariosController::class,'borrarColaborador'])->name('BorrarColaborador');
