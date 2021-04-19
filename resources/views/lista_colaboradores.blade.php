@extends('layouts.app')

@section('content')

<?php

 ?>
<script>
  var nombre_empresa = '{{ $nombre_empresa }}';

</script>
  <script src="{{ asset('js/lista_colaboradores.js') }}"></script>


<div class="container">
    <h3>Lista de Colaboradores </h3>
    <div class=" row justify-content-end">
      @auth
        @if(Auth::user()->email == 'admin@oshun.com')
          <form action="{{ route('RegistroColaborador',['empresa'=>$nombre_empresa]) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary" >Nuevo</button>
          </form>
        @endif
      @endauth
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Área Empresarial</th>
          <th scope="col">Puesto</th>
          <th scope="col">Telefonos</th>
          <th scope="col">Correos</th>
          @auth
          @if(Auth::user()->email == 'admin@oshun.com')
            <th scope="col">Operaciones</th>
          @endif
          @endauth
        </tr>
      </thead>
      <tbody>
        @foreach($colaboradores as $colaborador)
          <tr>
            <td>{{ $colaborador->nombre ." ". $colaborador->apellido_paterno ." ".$colaborador->apellido_materno  }}</td>
            <td>{{ $colaborador->area_ECol->area_empresarial }}</td>
            <td>{{ $colaborador->puesto_ECol->puesto }}</td>
            <td>
              @foreach($colaborador->telefonos_ECol as $telefono)

                  {{ $telefono-> telefono }} <br>

              @endforeach
            </td>
            <td>
              @foreach($colaborador->correos_ECol as $correo)
                  {{ $correo-> correo }} <br>
              @endforeach
            </td>

            @auth
            @if(Auth::user()->email == 'admin@oshun.com')
            <td><button class="btn" type="button" onclick= "location.href='{{ route('EditorColaborador',['correo'=>$colaborador->correos_ECol->pluck('correo')->first() ]) }}'"><i class="fas fa-edit "></i> Editar</button>
                <button class="btn" type="button" onclick= "location.href='{{ route('BorrarColaborador',['correo'=>$colaborador->correos_ECol->pluck('correo')->first() ]) }}'"><i class="fas fa-dumpster-fire"></i>Eliminar</button>
            </td>
            @endif
            @endauth
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
