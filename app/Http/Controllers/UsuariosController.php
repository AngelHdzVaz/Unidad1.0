<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
//funciones de carga
use App\Models\Empresa;
use App\Models\Usuario;
use App\Models\Empresas_usuario;
use App\Models\Empresas_colaboradore as ECol;
use App\Models\Colaboradores_telefono as CTel ;
use App\Models\Cat_empresas_puesto as CEPue ;
class UsuariosController extends Controller
{

  public function registroColaborador(Request $request){
    $empresas = Empresa::select('empresa')->get();
    $puestos = CEPue::select('puesto')->where('puesto','!=','Dios')->get();
    return view('registro_colaborador',compact('empresas','puestos'));
  }

  public function loginUsuario(Request $request){
    return view('register');
  }

  public function registrarUsuario(Request $request){
    try {
      $nombre_empresa = $request ->nombre_empresa;
      $nombre = $request->nombre;
      $apellido_paterno = $request->apellido_paterno;
      $apellido_materno = $request->apellido_materno;
      $area_empresarial = $request->area_empresarial;
      $puesto = $request->puesto;
      $telefono = $request ->telefono;
      $correo = $request ->correo;
            //relacion de id_empresa
      $empresa_id = Empresa::select('id')->where('empresa', $nombre_empresa)->first();
        //validacion
      //comparacion a nulo de BD
      if(!$empresa_id){
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo empresa',
          'mensaje' => 'El valor recibido no se encuentra en los registros',
          'tipo' => 'error'
        ]);
        }
        //restriccion
        if (!ctype_alpha($nombre)) {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Nombre',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
        //validacion
        if (!is_numeric($telefono) && (strlen ($telefono)!=10)){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Telefono',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        $puesto_id = CEPue::select('id')->where('puesto', $puesto)->first();
         //validacion
        //comparacion a nulo de BD
        if(!$puesto_id){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Puesto',
            'mensaje' => 'El valor recibido no se encuentra en los registros',
            'tipo' => 'error'
          ]);
          }

          if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Correo',
              'mensaje' => 'El valor que ingresaste no es válido',
              'tipo' => 'error'
            ]);
          }


      DB::beginTransaction();


     ECol::create([
        'id_empresa' => $empresa_id,
        'nombre' => $nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'area_empresarial' => $area_empresarial,
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
        $usuarios =  ECol::select('id','id_empresa','nombre','apellido_paterno','apellido_materno','area_empresarial','puesto')->get();
        return view('colaborador', compact('usuarios'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function oshunColaboradores(Request $request){
      try {
        $usuarios =  ECol::select('id','id_empresa','nombre','apellido_paterno','apellido_materno','area_empresarial','puesto')->get();
        return view('colaborador', compact('usuarios'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function moocColaboradores(Request $request){
      try {
        $usuarios =  ECol::select('id','id_empresa','nombre','apellido_paterno','apellido_materno','area_empresarial','puesto')->get();
        return view('colaborador', compact('usuarios'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }


}
