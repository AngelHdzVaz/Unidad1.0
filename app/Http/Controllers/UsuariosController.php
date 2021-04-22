<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//encriptar caracteres
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Log;
//funciones de carga
use App\Models\Empresa;
use App\Models\Usuario;
use App\Models\Empresas_usuario as EUsu;
use App\Models\Empresas_colaboradore as ECol ;
use App\Models\Cat_empresas_puesto as CEPue ;
use App\Models\Cat_empresas_area as CEAre ;
use App\Models\Colaboradores_telefono as CTel ;
use App\Models\Colaboradores_correo as CCor ;

class UsuariosController extends Controller
{

  public function registroColaborador(Request $request){
    $nombre_empresa = $request->empresa;
    $empresas = Empresa::select('empresa')->get();
    $areas = CEAre::select('area_empresarial')->get();
    $puestos = CEPue::select('puesto')->where('puesto','!=','Dios')->get();

    return view('registro_colaborador',compact('empresas','puestos','areas','nombre_empresa'));
  }

  public function loginUsuario(Request $request){
    try {

      $correo = $request->correo;
      $contrasenia = $request->contrasenia;
      Log::debug('1');
      if(!$correo){
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo correo',
          'mensaje' => 'El valor recibido no se encuentra en los registros',
          'tipo' => 'error'
        ]);
        }
          Log::debug('2');
      if(!$contrasenia){
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo contraseña',
          'mensaje' => 'El campo no debe estar vacio',
          'tipo' => 'error'
        ]);
        }

          Log::debug('3');
        $credencial = ['email' => $correo, 'password' => $contrasenia];
        $remember = 'off';

        if(Auth::attempt($credencial)) {
            Log::debug('3.1');
          return redirect()->route('Home');
        } else {
            Log::debug('3.2');
          return redirect()->back()->with([
            'titulo' => 'Verifica los datos de inicio de sesión',
            'mensaje' => ' ',
            'tipo' => 'error'
          ]);

        }
          Log::debug('4');

    } catch (\Exception $e) {
      Log::debug('UsuariosController@loginUsuario'.$e->getMessage());
      return null;
      //return view('errorInterno'); hacer vista
    }
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
      $contrasenia =$request ->contrasenia;
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
        if(!$telefono){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Telefono',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }

        if (!is_numeric($telefono) ){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Telefono',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }

        if (strlen ($telefono)!=10){
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

          if(!$contrasenia){
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Contraseña',
              'mensaje' => 'El campo no debe estar vacío',
              'tipo' => 'error'
            ]);
            }
            $existecorreo = CCor::select('id')->where('correo',$correo)->first();

            if($existecorreo!=null){
              return redirect()->back()->with([
                'titulo' => 'Correo no aceptado',
                'mensaje' => 'El correo ya ha sido registrado',
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

      EUsu::create([
        'id_empresa' => $empresa_id,
        'id_colaborador' => $colaborador->id,
        'email' =>$correo,
        'password' =>Hash::make($contrasenia)
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

  public function verLogin(){
    return view('auth.login');
  }
  public function verHome(){
    return view('home');
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

  public function listaColaboradores(Request $request){
      try {
        //dd($request->empresa);
        $nombre_empresa = $request->empresa;
        $empresa_id = Empresa::select('id')->where('empresa', $nombre_empresa)->pluck('id')->first();
        if(!$empresa_id){

          //log para verificar entrada de rutas de acceso
            return redirect()->back()->with([
              'titulo' => 'Ha ocurrido un error',
              'mensaje' => 'Intenta nuevamente mas tarde',
              'tipo' => 'error'
            ]);
        }
        // la forma sucia $empresa = '1';
        $colaboradores =  ECol::where('id_empresa',$empresa_id)->with('area_ECol')->with('telefonos_ECol')->with('correos_ECol')->get();
        return view('lista_colaboradores', compact('colaboradores','nombre_empresa'));

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

  public function editorColaborador(Request $request){
    try {
        $empresas = Empresa::select('empresa')->get();
        $areas = CEAre::select('area_empresarial')->get();
        $puestos = CEPue::select('puesto')->where('puesto','!=','Dios')->get();
        $correo = $request->correo;


        if(!$correo) {
          Log::debug('UsuariosController@editorColaborador no se recibio correo');
          return redirect()->back()->with([
            'titulo' => 'Ha ocurrido un error',
            'mensaje' => 'Intenta nuevamente mas tarde',
            'tipo' => 'error'
          ]);}

          if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
              Log::debug('UsuariosController@editorColaborador se recibio correo invalido');
            return redirect()->back()->with([
              'titulo' => 'Ha ocurrido un error',
              'mensaje' => 'Intenta nuevamente mas tarde',
              'tipo' => 'error'
            ]);
          }

          $existe = CCor::select('id')->where('correo', $correo)->pluck('id')->first();

          if(!$existe){
            Log::debug('UsuariosController@editorColaborador el correo no se encuentra en la Base de Datos');
            return redirect()->back()->with([
              'titulo' => 'Ha ocurrido un error',
              'mensaje' => 'Intenta nuevamente mas tarde',
              'tipo' => 'error'
            ]);
            }

            $colaborador_datos = CCor::with(['colaborador_CCor' => function($q1){
              $q1->with('empresa_ECol')
                  ->with('telefonos_ECol')
                  ->with('area_ECol')
                  ->with('puesto_ECol');
            }])->where('correo',$correo)->first();
            //  dd($colaborador_datos->colaborador_CCor->nombre);
            return view('editor_colaborador', compact('colaborador_datos','correo','empresas','areas','puestos'));
    } catch (\Exception $e) {
      Log::debug('UsuariosController@editorColaborador'.$e->getMessage());
      return null;

    }

  }

  public function actualizarColaborador(Request $request){
    try {
      $nombre_empresa = $request->empresa;
      $nombre = $request->nombre;
      $apellido_paterno = $request->apellido_paterno;
      $apellido_materno = $request->apellido_materno;
      $area_empresarial = $request->area_empresarial;
      $puesto = $request->puesto;
      $telefono = $request->telefono;
      $correo = $request->correo;


            //relacion de id_empresa
            //pluck-> para devolver solo el string no el objeto
      $colaborador_id= CCor::select('id')->where('correo',$correo)->pluck('id')->first();
      $empresa_id = Empresa::select('id')->where('empresa', $nombre_empresa)->pluck('id')->first();
      $area_empresarial_id = CEAre::select('id')->where('area_empresarial', $area_empresarial)->pluck('id')->first();
      $puesto_id = CEPue::select('id')->where('puesto', $puesto)->pluck('id')->first();
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
        //  dd($empresa_id,$nombre,$apellido_paterno,$apellido_materno,$area_empresarial_id,$id_puesto);
      Log::debug('1');
      DB::beginTransaction();
      Log::debug('2');
     ECol::where('id',$colaborador_id)->where('id_empresa',$empresa_id)->update([
        'id_empresa' => $empresa_id,
        'nombre' => $nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'id_area_empresarial' => $area_empresarial_id,
        'id_puesto' => $puesto_id
      ]);
      Log::debug('3');
      CTel::where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->update([
        'id_empresa' =>$empresa_id,
        'telefono' =>$telefono
      ]);
      Log::debug('4');
      CCor::where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->update([
       'id_empresa' =>$empresa_id,
        'correo' =>$correo
      ]);
      Log::debug('5');
      EUsu::where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->update([
        'id_empresa' => $empresa_id,
        'email' =>$correo
      ]);

      DB::commit();

      return redirect()->back()->with([
        'titulo' => 'Colaborador actualizado exitosamente',
        'mensaje' => '',
        'tipo' => 'success'
      ]);

    } catch (\Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
  }

  public function borrarColaborador(Request $request){
      try {
        $correo = $request->correo;
        $colaborador_id= CCor::select('id')->where('correo',$correo)->pluck('id')->first();

        DB::beginTransaction();
        ECol::where('id',$colaborador_id)->delete();
        CTel::where('id_colaborador',$colaborador_id)->delete();
        CCor::where('id_colaborador',$colaborador_id)->delete();
        EUsu::where('id_colaborador',$colaborador_id)->delete();
        DB::commit();
        return redirect()->back()->with([
          'titulo' => 'Colaborador borrado exitosamente',
          'mensaje' => '',
          'tipo' => 'success'
          ]);
      } catch (\Exception $e) {
        return $e->getMessage();
      }
  }

  public function actualizarTelefonosColaborador(Request $request){
    try {
      $nombre_empresa = $request->nombre_empresa;
      $telefono1 = $request->telefono1;
      $telefono2 = $request->telefono2;
      $correo = $request->correo;
            //relacion de id_empresa
            //pluck-> para devolver solo el string no el objeto
      $colaborador_id= CCor::select('id')->where('correo',$correo)->pluck('id')->first();
      $empresa_id = Empresa::select('id')->where('empresa', $nombre_empresa)->pluck('id')->first();
      $telefono1_actual =  CTel::select('telefono')->where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->pluck('telefono')->get(1);
      $telefono2_actual =   CTel::select('telefono')->where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->pluck('telefono')->get(2);
        //validacion
      //comparacion a nulo de BD
      if(!$empresa_id){
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo empresa',
          'mensaje' => 'El valor recibido no se encuentra en los registros',
          'tipo' => 'error'
        ]);
        }
        //validacion
          if($telefono1){
            if (!is_numeric($telefono1) && (strlen ($telefono1)!=10)  ){
              return redirect()->back()->with([
                'titulo' => 'Verifica el campo Telefono',
                'mensaje' => 'El valor que ingresaste no es válido',
                'tipo' => 'error'
              ]);
            }
          }

          if($telefono2){
            if (!is_numeric($telefono2) && (strlen ($telefono2)!=10)  ){
              return redirect()->back()->with([
                'titulo' => 'Verifica el campo Telefono',
                'mensaje' => 'El valor que ingresaste no es válido',
                'tipo' => 'error'
              ]);
            }
          }
          //dd($telefono1,$telefono1_actual)
        DB::beginTransaction();
        //crear correos en caso de no existir
        //dd($telefono1,$telefono2,$telefono1_actual,$telefono2_actual);
          Log::debug('1');
          if ($telefono1_actual && $telefono1!==null) {
                CTel::select('id')->where('id_colaborador',$colaborador_id)
                ->where('id_empresa',$empresa_id)
                ->where('telefono',$telefono1_actual)
                ->update(['telefono' =>$telefono1]);
          Log::debug('2');
          } else if($telefono1==null){
              Log::debug('3');
            CTel::where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->where('telefono',$telefono1_actual)->delete();
          } else if($telefono1){
            Log::debug('4');
                CTel::create([
                  'id_colaborador' =>$colaborador_id,
                  'id_empresa' =>$empresa_id,
                  'telefono' =>$telefono1
                ]);
          }

          if ($telefono2_actual && $telefono2!==null) {
                CTel::select('id')->where('id_colaborador',$colaborador_id)
                ->where('id_empresa',$empresa_id)
                ->where('telefono',$telefono2_actual)
                ->update(['telefono' =>$telefono2]);
          }else if($telefono2==null){
            CTel::select('id')->where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->where('telefono',$telefono2_actual)->delete();
          }else if($telefono2){
                $telefono2 = CTel::create([
                  'id_colaborador' =>$colaborador_id,
                  'id_empresa' =>$empresa_id,
                  'telefono' =>$telefono2
                ]);
          }

      DB::commit();
      return redirect()->back()->with([
        'titulo' => 'Telefonos actualizados exitosamente',
        'mensaje' => '',
        'tipo' => 'success'
      ]);
    } catch (\Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
  }

  public function actualizarCorreosColaborador(Request $request){
    try {
        $nombre_empresa = $request->nombre_empresa;
        $correo1 = $request->correo1;
        $correo2 = $request->correo2;
        $correo = $request->correo;

        Log::debug('1');
              //relacion de id_empresa
              //pluck-> para devolver solo el string no el objeto
        $colaborador_id= CCor::select('id')->where('correo',$correo)->pluck('id')->first();
        $empresa_id = Empresa::select('id')->where('empresa', $nombre_empresa)->pluck('id')->first();
        $correoBDI= CCor::select('correo')->where('correo',$correo)->pluck('correo')->first();
        $correo1_actual =  CCor::select('correo')->where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->pluck('correo')->get(1); //primera alterno
        $correo2_actual =   CCor::select('correo')->where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->pluck('correo')->get(2);
          //validacion
        //comparacion a nulo de BD

            if (!filter_var($correo1, FILTER_VALIDATE_EMAIL)) {
              return redirect()->back()->with([
                'titulo' => 'Verifica el campo Correo',
                'mensaje' => 'El valor que ingresaste no es válido',
                'tipo' => 'error'
              ]);
            }


            if (!filter_var($correo2, FILTER_VALIDATE_EMAIL)) {
              return redirect()->back()->with([
                'titulo' => 'Verifica el campo Correo',
                'mensaje' => 'El valor que ingresaste no es válido',
                'tipo' => 'error'
              ]);
            }


          DB::beginTransaction();
          $existecorreo1 = CCor::where('correo',$correo1)->first();
          $existecorreo2 = CCor::where('correo',$correo2)->first();

          //dd($correo,$correo1,$correo2,$correo1_actual,$correo2_actual);

          if($existecorreo1){
            return redirect()->back()->with([
              'titulo' => 'Correo ya existente',
              'mensaje' => 'Mal',
              'tipo' => 'error'
            ]);
          }else{
            if ($correo1_actual && $correo1!==null) {
                  CCor::select('id')->where('id_colaborador',$colaborador_id)
                  ->where('id_empresa',$empresa_id)
                  ->where('correo',$correo1_actual)
                  ->update(['correo' =>$correo1]);
            Log::debug('2');
          } else if($correo1==null){
                Log::debug('3');
              CCor::where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->where('correo',$correo1_actual)->delete();
            } else if($correo1){
              Log::debug('4');
                  CCor::create([
                    'id_colaborador' =>$colaborador_id,
                    'id_empresa' =>$empresa_id,
                    'correo' =>$correo1
                  ]);
            }
          }

          if($existecorreo2){
            return redirect()->back()->with([
              'titulo' => 'Correo ya existente',
              'mensaje' => 'Mal',
              'tipo' => 'error'
            ]);
          }else{
            if ($correo2_actual && $correo2!==null) {
                  CCor::select('id')->where('id_colaborador',$colaborador_id)
                  ->where('id_empresa',$empresa_id)
                  ->where('correo',$correo1_actual)
                  ->update(['correo' =>$correo2]);
            Log::debug('2');
          } else if($correo2==null){
                Log::debug('3');
              CCor::where('id_colaborador',$colaborador_id)->where('id_empresa',$empresa_id)->where('correo',$correo2_actual)->delete();
            } else if($correo2){
              Log::debug('4');
                  CCor::create([
                    'id_colaborador' =>$colaborador_id,
                    'id_empresa' =>$empresa_id,
                    'correo' =>$correo2
                  ]);
            }
          }
          DB::commit();
          Log::debug('6');
          return redirect()->back()->with([
            'titulo' => 'Correos actualizados exitosamente',
            'mensaje' => '',
            'tipo' => 'success'
          ]);
        } catch (\Exception $e) {
          DB::rollback();
          return $e->getMessage();
        }
  }
}
