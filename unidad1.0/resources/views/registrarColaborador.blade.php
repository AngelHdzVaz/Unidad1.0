@extends('layouts.app')

@section('content')
<?php
 ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar Colaborador') }}</div>

                <div class="card-body">
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Empresa</option>
                    <option value="MET">MET</option>
                    <option value="OSHUN">OSHUN</option>
                    <option value="MOOC">MOOC</option>
                  </select>
                    <form method="POST" action="{{ route('RegistrarUsuario') }}">
                        @csrf

                        <div class="form-group row ">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}"  autofocus>

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}"  autofocus>

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}"  autofocus>

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="p-1 col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}"  autofocus>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
