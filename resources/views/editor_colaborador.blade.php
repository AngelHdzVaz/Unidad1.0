@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-4">
            <div class="card">
                <div class="card-header align-center text-center">
                  <div class="row">
                        <div class="col-md-3 text-left">
                          <button type="button" class="btn btn-primary " onclick="location.href='{{ route('ListaColaboradores',['empresa'=>$colaborador_datos->colaborador_CCor->empresa_ECol->empresa])}}'"> Regresar</button>
                        </div>
                        <div class="col-md-6">
                          <h3>{{ __('Datos de Colaborador') }}</h3>
                        </div>
                        <div class="col-md-3">
                        </div>
                  </div>
                </div>
                <div class="card-body  ">
                <form method="POST" action="{{ route('ActualizarColaborador', ['correo' => $correo]) }}" id='frm_editor'>
                        @csrf

                        <div class="form-group row ">

                              <label for="sel_empresa" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Empresa') }} <span class="text-red">*</span></label>
                              <div  class="p-3 text-md-right">
                                <select  id="sel_empresa" class="form-control col-md-10"  name='empresa' required>
                                  <option selected>{{$colaborador_datos->colaborador_CCor->empresa_ECol->empresa }} </option>
                                  @foreach($empresas as $empresa)
                                    @if($colaborador_datos->colaborador_CCor->empresa_ECol->empresa != $empresa->empresa)
                                    <option value="{{ $empresa->empresa }}">{{ $empresa->empresa }}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div>


                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Nombre') }} <span class="text-red">*</span></label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_nombre" type="text" class="form-control " name="nombre" value="{{ $colaborador_datos->colaborador_CCor->nombre }}"  autofocus required>

                            </div>
                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Apellido Paterno') }} <span class="text-red">*</span></label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_apellido_paterno" type="text" class="form-control " name="apellido_paterno" value="{{ $colaborador_datos->colaborador_CCor->apellido_paterno }}"  autofocus required>

                            </div>
                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Apellido Materno') }}</label>

                            <div class="p-2 col-md-6">
                                <input id="ipt_apellido_materno" type="text" class="form-control " name="apellido_materno" value="{{ $colaborador_datos->colaborador_CCor->apellido_materno }}"  autofocus>

                            </div>
                              <label for="name" class="p-3 col-md-4 col-form-label text-md-center" >{{ __('Area Empresarial') }} <span class="text-red">*</span></label>
                                <div  class="p-3 text-md-right">
                                    <select class="form-select form-control col-md-10" name='area_empresarial' required>
                                      <option selected >{{$colaborador_datos->colaborador_CCor->area_ECol->area_empresarial}}</option>
                                      @foreach($areas as $area_empresarial)
                                      @if($colaborador_datos->colaborador_CCor->area_ECol->area_empresarial!=$area_empresarial->area_empresarial)
                                        <option value="{{ $area_empresarial->area_empresarial }}">{{ $area_empresarial->area_empresarial }}</option>
                                      @endif
                                      @endforeach
                                    </select>
                                  </div>


                            <label for="name" class="p-2 col-md-4 col-form-label text-md-center">{{ __('Puesto') }} <span class="text-red">*</span></label>
                              <div  class="p-2 text-md-right">
                                  <select class="form-select form-control col-md-12" name='puesto' required>
                                    <option selected >{{$colaborador_datos->colaborador_CCor->puesto_ECol->puesto}} </option>
                                    @foreach($puestos as $puesto)
                                    @if($colaborador_datos->colaborador_CCor->puesto_ECol->puesto!=$puesto->puesto)
                                      <option value="{{ $puesto->puesto }}">{{ $puesto->puesto }}</option>
                                    @endif
                                    @endforeach
                                  </select>
                                </div>
                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Telefono (10 digitos)') }}</label>
                            <div class="p-1 col-md-6">
                                <input id="ipt_telefono" type="text" class="form-control " name="telefono" value="{{  (($colaborador_datos->colaborador_CCor->telefonos_ECol->isEmpty())? '' : $colaborador_datos->colaborador_CCor->telefonos_ECol->pluck('telefono')->first())  }}"  autofocus>

                            </div>
                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Correo') }} <span class="text-red">*</span></label>
                            <div class="p-1 col-md-6">
                                <input id="ipt_correo" type="text" class="form-control " name="correo" value="{{ $correo }}"  autofocus required>
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                          <div class="col-md-2 ">
                          </div>
                          <div class="col-md-4 text-right">

                            <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('Guardar') }}
                            </button>
                          </div>
                          <div class="col-md-6 ">
                            <span class="text-red">*</span><h7>Estos datos son obligatorios</h7>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header align-center text-center">
                  <div class="row">
                        <div class="col text-center">
                          <h6>{{ __('Telefonos alternos') }}</h6>
                        </div>
                  </div>
                </div>
                <div class="p-2 card-body  ">
                  <form method="POST" action="{{ route('ActualizarTelefonosColaborador',['correo'=>$correo]) }}"  id='frm_editortelefonos'>
                        @csrf

                        <input type="hidden" name="nombre_empresa" value="{{ $colaborador_datos->colaborador_CCor->empresa_ECol->empresa }}">
                    <label for="name" class="col-md-6 col-form-label text-left"><i class="fas fa-phone"></i> #1</label><br>
                      <div class="col-md-11">
                        <input id="ipt_telefono1" type="text" class="form-control " name="telefono1"  value="{{   $colaborador_datos->colaborador_CCor->telefonos_ECol->pluck('telefono')->get(1) }}" autofocus>
                        </div>
                      <label for="name" class="col-md-6 col-form-label text-left"><i class="fas fa-phone"></i> #2</label>
                        <div class="col-md-11">
                          <input id="ipt_telefono2" type="text" class="form-control " name="telefono2" value="{{   $colaborador_datos->colaborador_CCor->telefonos_ECol->pluck('telefono')->get(2) }}"  autofocus>

                        </div>

                </div>
                <div class="form-group row mb-2">
                    <div class="col-md-3">
                      </div>
                    <div class="p-3 col-md-6 ">
                        <button class="btn btn-primary" type="submit" >Guardar </button>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
                    </form>
                </div>
                <br>
                <div class="card">
                    <div class="card-header align-center text-center">
                      <div class="row">
                            <div class="col text-center">
                              <h6>{{ __('Correos alternos') }}</h6>
                            </div>
                      </div>
                    </div>
                    <div class="p-2 card-body  ">
                      <form method="POST" action="{{ route('ActualizarCorreosColaborador',['correo'=>$correo]) }}"  id='frm_editor'>
                            @csrf
                        <input type="hidden" name="nombre_empresa" value="{{ $colaborador_datos->colaborador_CCor->empresa_ECol->empresa }}">
                        <label for="name" class="col-md-6 col-form-label text-left"><i class="fas fa-envelope "></i> #1</label><br>
                          <div class="col-md-11">
                              <input id="ipt_telefono" type="text" class="form-control " name="correo1" value="{{ $colaborador_datos->colaborador_CCor->correos_ECol->pluck('correo')->get(1)  }}"  autofocus>
                          </div>
                          <label for="name" class="col-md-6 col-form-label text-left"><i class="fas fa-envelope "></i> #2</label>
                            <div class="col-md-11">
                                <input id="ipt_telefono" type="text" class="form-control " name="correo2" value="{{ $colaborador_datos->colaborador_CCor->correos_ECol->pluck('correo')->get(2)}}"  autofocus>
                            </div>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-md-3">
                          </div>
                        <div class="p-3 col-md-6 ">
                            <button class="btn btn-primary" type="submit" >Guardar </button>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

@endsection
