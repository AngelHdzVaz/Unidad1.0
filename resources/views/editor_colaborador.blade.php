@extends('layouts.app')

@section('content')
<?php
 ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-4">
            <div class="card">

                <div class="card-header align-center text-center">
                  <div class="row">
                        <div class="col-md-3 text-left">
                          <button type="submit" class="btn btn-primary " onclick="location.href='{{ route('ListaColaboradores',['empresa'=>$colaborador_datos->colaborador_CCor->empresa_ECol->empresa])}}'"> Regresar</button>
                        </div>

                        <div class="col-md-6">
                          <h3>{{ __('Datos de Colaborador') }}</h3>
                        </div>
                        <div class="col-md-3">
                        </div>
                  </div>

                </div>
                <div class="card-body  ">
                    <form method="POST" action="{{ route('RegistrarColaborador') }}">
                        @csrf

                        <div class="form-group row ">
                          <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Empresa') }}</label>
                            <div  class="p-3 text-md-right">
                                <select class="form-select form-control col-md-10" aria-label="Default select example" name='nombre_empresa'>
                                  <option selected hidden disabled>{{$colaborador_datos->colaborador_CCor->empresa_ECol->empresa }}</option>
                                  @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->empresa }}">{{ $empresa->empresa }}</option>
                                  @endforeach
                                </select>
                              </div>


                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Nombre') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_nombre" type="text" class="form-control " name="nombre" value="{{ $colaborador_datos->colaborador_CCor->nombre }}"  autofocus>

                            </div>
                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Apellido Paterno') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_apellido_paterno" type="text" class="form-control " name="apellido_paterno" value="{{  $colaborador_datos->colaborador_CCor->apellido_paterno }}"  autofocus>

                            </div>
                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Apellido Materno') }}</label>

                            <div class="p-2 col-md-6">
                                <input id="ipt_apellido_materno" type="text" class="form-control " name="apellido_materno" value="{{  $colaborador_datos->colaborador_CCor->apellido_materno}}"  autofocus>

                            </div>
                              <label for="name" class="p-3 col-md-4 col-form-label text-md-center" >{{ __('Area Empresarial') }}</label>
                                <div  class="p-3 text-md-right">
                                    <select class="form-select form-control col-md-10" aria-label="Default select example" name='area_empresarial'>
                                      <option selected hidden disabled>{{$colaborador_datos->colaborador_CCor->area_ECol->area_empresarial}}</option>
                                      @foreach($areas as $area_empresarial)
                                        <option value="{{ $area_empresarial->area_empresarial }}">{{ $area_empresarial->area_empresarial }}</option>
                                      @endforeach
                                    </select>
                                  </div>


                            <label for="name" class="p-2 col-md-4 col-form-label text-md-center">{{ __('Puesto') }}</label>
                              <div  class="p-2 text-md-right">
                                  <select class="form-select form-control col-md-12" aria-label="Default select example" name='puesto'>
                                    <option selected hidden disabled>{{$colaborador_datos->colaborador_CCor->puesto_ECol->puesto}}</option>
                                    @foreach($puestos as $puesto)
                                      <option value="{{ $puesto->puesto }}">{{ $puesto->puesto }}</option>
                                    @endforeach
                                  </select>
                                </div>
                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Telefono (10 digitos)') }}</label>
                            <div class="p-1 col-md-6">
                                <input id="ipt_telefono" type="text" class="form-control " name="telefono" value="{{  $colaborador_datos->colaborador_CCor->telefonos_ECol->first()->telefono  }}"  autofocus>

                            </div>
                            <label for="name" class="p-3 col-md-4 col-form-label text-md-center">{{ __('Correo') }}</label>
                            <div class="p-1 col-md-6">
                                <input id="ipt_correo" type="text" class="form-control " name="correo" value="{{ $correo }}"  autofocus>
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success align-center">
                                    {{ __('Guardar') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
