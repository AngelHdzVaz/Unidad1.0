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
  $colaborador_telefonos = App\Models\Empresas_colaboradore::with('telefonos_CTel')->where('id',$colaborador_id)->get();
  dd($colaborador_telefonos);
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [UsuariosController::class, 'verWelcome'])->name('VerWelcome');
Route::get('/met',[UsuariosController::class, 'metColaboradores'])->name('MetColaboradores');
Route::get('/colaboradores/registro', [UsuariosController::class, 'registroColaborador'])->name('RegistroColaborador');
Route::get('/usuarios/registrado', [UsuariosController::class, 'registrarUsuario'])->name('RegistrarUsuario');
Route::post('/login',[ UsuariosController::class,'loginUsuario'])->name('LoginUsuario');
Route::get('/oshun',[UsuariosController::class, 'verOshun'])->name('VerOshun');
Route::get('/mooc',[UsuariosController::class, 'verMooc'])->name('VerMooc');
