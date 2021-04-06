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
  $colaborador_telefonos = App\Models\Empresas_colaboradore::with('telefonos_Ecol')->where('id',$colaborador_id)->get();
  $colaborador_correos = App\Models\Empresas_colaboradore::with('correos_ECol')->where('id',$colaborador_id)->get();
  dd($colaborador_correos, $colaborador_telefonos);
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/colaboradores/met',[UsuariosController::class, 'metColaboradores'])->name('MetColaboradores');
Route::get('/colaboradores/oshun',[UsuariosController::class, 'oshunColaboradores'])->name('OshunColaboradores');
Route::get('/colaboradores/mooc',[UsuariosController::class, 'moocColaboradores'])->name('MoocColaboradores');

Route::get('/colaboradores/registro', [UsuariosController::class, 'registroColaborador'])->name('RegistroColaborador');
Route::post('/usuarios/registrado', [UsuariosController::class, 'registrarColaborador'])->name('RegistrarColaborador');
Route::post('/login',[ UsuariosController::class,'loginUsuario'])->name('LoginUsuario');

Route::get('/', [UsuariosController::class, 'verWelcome'])->name('VerWelcome');
Route::get('/met', [UsuariosController::class, 'verMet'])->name('VerMet');
Route::get('/oshun',[UsuariosController::class, 'verOshun'])->name('VerOshun');
Route::get('/mooc',[UsuariosController::class, 'verMooc'])->name('VerMooc');
