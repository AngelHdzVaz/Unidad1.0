@extends('layouts.app')

@section('content')
<?php
 ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar Colaborador') }}</div>

                <div class="card-body  ">
                    <div  class="p-1 text-md-right">
                        <select class="form-select form-control col-md-4" aria-label="Default select example">
                          <option selected hidden disabled>Selecciona</option>
                          @foreach($empresas as $empresa)
                            <option value="{{ $empresa->empresa }}">{{ $empresa->empresa }}</option>
                          @endforeach
                        </select>
                      </div>
                    <form method="POST" action="{{ route('RegistrarUsuario') }}">
                        @csrf

                        <div class="form-group row ">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_nombre" type="text" class="form-control " name="nombre" value="{{ old('nombre') }}"  autofocus>

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_apellido_paterno" type="text" class="form-control " name="apellido_paterno" value="{{ old('apellido_paterno') }}"  autofocus>

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_apellido_materno" type="text" class="form-control " name="apellido_materno" value="{{ old('apellido_materno') }}"  autofocus>

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Area Empresarial') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_area_empresarial" type="text" class="form-control " name="area_empresarial" value="{{ old('area_empresarial') }}"  autofocus>

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Puesto') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="ipt_puesto" type="text" class="form-control " name="puesto" value="{{ old('puesto') }}"  autofocus>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
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
