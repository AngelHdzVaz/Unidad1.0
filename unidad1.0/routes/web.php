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
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/usuarios/registrar', [UsuariosController::class, 'registrarUsuario'])->name('RegistrarUsuario');

Route::get('/', [UsuariosController::class, 'verWelcome'])->name('VerWelcome');
Route::get('/met',[UsuariosController::class, 'metColaboradores'])->name('MetColaboradores');
Route::get('/usuarios/registrarColaborador', [UsuariosController::class, 'registrarColaborador'])->name('RegistrarColaborador');
Route::post('/usuarios/registrado', [UsuariosController::class, 'registrarUsuario'])->name('RegistrarUsuario');
Route::get('/oshun',[UsuariosController::class, 'verOshun'])->name('VerOshun');
Route::get('/mooc',[UsuariosController::class, 'verMooc'])->name('VerMooc');
