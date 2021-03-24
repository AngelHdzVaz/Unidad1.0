<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

use App\Models\Empresa;
use App\Models\Usuario;
class UsuariosController extends Controller
{

  public function registrarColaborador(Request $request){
    return view('registrarColaborador');
  }

  public function registrarUsuario(Request $request){
    try {
      $nombre_empresa = $request ->nombre_empresa;
      $nombre = $request->nombre;
      $apellido_paterno = $request->apellido_paterno;
      $apellido_materno = $request->apellido_materno;
      $area_empresarial = $request->area_empresarial;
      $puesto = $request->puesto;

      //validacion
      if ($nombre == null || $apellido_paterno == null || $puesto == null || $telefono == null || $correo == null ) {
        return redirect()->back()->with([
          'titulo' => 'Verifique los campos',
          'mensaje' => 'Alguno de los campos se encuentra vacío',
          'tipo' => 'warning'
        ]);
      }
      $existe_empresa = Empresa::select('id')->where('empresa', $nombre_empresa)->first();
      dd($existe_empresa);

      if($existe_empresa){

      }
      DB::beginTransaction();

      Usuario::create([
        'nombre_empresa' => $nombre_empresa,
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
  public function verWelcome(){
    return view('welcome');
  }

  public function verOshun(){
    return view('oshun');
  }
  public function verMooc(){
    return view('mooc');
  }

    public function metColaboradores(Request $request){
      try {
        $usuarios = Usuario::select('id','id_empresa','nombre','apellido_paterno','apellido_materno','area_empresarial','puesto')->get();
        return view('colaborador', compact('usuarios'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function oshunColaboradores(Request $request){
      try {
        $usuarios = Usuario::select('id','id_empresa','nombre','apellido_paterno','apellido_materno','area_empresarial','puesto')->get();
        return view('colaborador', compact('usuarios'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function moocColaboradores(Request $request){
      try {
        $usuarios = Usuario::select('id','id_empresa','nombre','apellido_paterno','apellido_materno','area_empresarial','puesto')->get();
        return view('colaborador', compact('usuarios'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }


}
