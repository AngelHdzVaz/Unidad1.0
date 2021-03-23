<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

use App\Models\Usuario;
class UsuariosController extends Controller
{
  public function registrarUsuario(Request $request){
    try {
      $nombre = $request->nombre;
      $apellido_paterno = $request->apellido_paterno;
      $apellido_materno = $request->apellido_materno;
      $area_empresarial = $request->area_empresarial;
      $puesto = $request->puesto;

      //validacion
      if ($nombre == null || $aprllido_paterno == null || $puesto == null || $telefono == null || $correo == null ) {
        return redirect()->back()->with([
          'titulo' => 'Verifique los campos',
          'mensaje' => 'Alguno de los campos se encuentra vacío',
          'tipo' => 'warning'
        ]);
      }
      DB::beginTransaction();

      Usuario::create([
        'nombre' => $nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'area_empresarial' => $area_empresarial,
        'puesto' => $puesto
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
      $usuarios = Usuario::select('id','id_empresa','nombre','apellido_paterno','apellido_materno','area_empresarial','puesto')->get();
      return view('welcome', compact('usuarios'));

    } catch (\Exception $e) {
      return $e->getMessage();
    }


  }
}
