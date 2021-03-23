<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UsuariosController extends Controller
{
  public function registrarUsuario(Request $request){
    dd($request);
    try {
      $nombre = $request->name;
      $area = $request->area;
      $puesto = $request->puesto;
      
      //validacion
      if ($nombre == null || $area == null || $puesto == null || $telefono == null || $correo == null ) {
        return redirect()->back()->with([
          'titulo' => 'Verifique los campos',
          'mensaje' => 'Alguno de los campos se encuentra vacío',
          'tipo' => 'warning'
        ]);
      }
      DB::beginTransaction();

      Usuario::create([
        'nombre' => $nombre,
        'area' => $area,
        'puesto' => $puesto,
        'telefono' => $telefono,
        'correo' => $correo
      ]);

      DB::commit();

      //return redirect()->route('VerWelcome');
      return view('welcome', compact('variable'));
    } catch (\Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
  }
  public function verWelcome(Request $request){
    try {
      $usuarios = Usuario::select('id','nombre','correo')->get();
      return view('welcome', compact('usuarios'));

    } catch (\Exception $e) {
      return $e->getMessage();
    }


  }
}
