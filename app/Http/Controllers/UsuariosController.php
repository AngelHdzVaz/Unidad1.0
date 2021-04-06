<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
//funciones de carga
use App\Models\Empresa;
use App\Models\Usuario;
use App\Models\Empresas_usuario;
use App\Models\Empresas_colaboradore as ECol ;
use App\Models\Cat_empresas_puesto as CEPue ;
use App\Models\Cat_empresas_area as CEAre ;
use App\Models\Colaboradores_telefono as CTel ;
use App\Models\Colaboradores_correo as CCor ;

class UsuariosController extends Controller
{

  public function registroColaborador(Request $request){
    $empresas = Empresa::select('empresa')->get();
    $areas = CEAre::select('area_empresarial')->get();
    $puestos = CEPue::select('puesto')->where('puesto','!=','Dios')->get();

    return view('registro_colaborador',compact('empresas','puestos','areas'));
  }

  public function loginUsuario(Request $request){
    return view('register');
  }

  public function registrarColaborador(Request $request){
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
            //pluck-> para devolver solo el string no el objeto
      $empresa_id = Empresa::select('id')->where('empresa', $nombre_empresa)->pluck('id')->first();


      $area_empresarial_id = CEAre::select('id')->where('area_empresarial', $area_empresarial)->pluck('id')->first();

      $puesto_id = CEPue::select('id')->where('puesto', $puesto)->first();
      $id_puesto = $puesto_id->id;


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

     $colaborador = ECol::create([
        'id_empresa' => $empresa_id,
        'nombre' => $nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'id_area_empresarial' => $area_empresarial_id,
        'id_puesto' => $id_puesto
      ]);

      CTel::create([
        'id_colaborador' => $colaborador->id,
        'id_empresa' =>$empresa_id,
        'telefono' =>$telefono
      ]);

      CCor::create([
        'id_colaborador' => $colaborador->id,
        'id_empresa' =>$empresa_id,
        'correo' =>$correo
      ]);

      DB::commit();

      return redirect()->back()->with([
        'titulo' => 'Colaborador registrado exitosamente',
        'mensaje' => '',
        'tipo' => 'success'
      ]);

    } catch (\Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
  }

  public function verWelcome(){
    return view('welcome');
  }

  public function verMet(){
    return view('met');
  }

  public function verOshun(){
    return view('oshun');
  }
  public function verMooc(){
    return view('mooc');
  }

    public function metColaboradores(Request $request){
      try {

        $empresa = '1';
        $colaboradores =  ECol::where('id_empresa',$empresa)->with('area_ECol')->with('telefonos_ECol')->with('correos_ECol')->get();
        return view('colaborador', compact('colaboradores'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function oshunColaboradores(Request $request){
      try {
        $empresa = '2';
        $colaboradores =  ECol::where('id_empresa',$empresa)->with('telefonos_ECol')->with('correos_ECol')->get();
        return view('colaborador', compact('colaboradores'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function moocColaboradores(Request $request){
      try {

        $empresa = '3';
        $colaboradores =  ECol::where('id_empresa',$empresa)->with('telefonos_ECol')->with('correos_ECol')->get();
        return view('colaborador  ', compact('colaboradores'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }


}
