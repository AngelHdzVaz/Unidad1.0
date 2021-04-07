@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Lista de Colaboradores </h3>
    <div class=" row justify-content-end">
      @auth
        @if(Auth::user()->email == 'admin@oshun.com')

          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('RegistroColaborador')}}'">Nuevo</button>
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

            <td><button class="btn"><i class="fas fa-edit fa-2x "></i> Editar</button>
                <button class="btn"><i class="fas fa-dumpster-fire fa-2x"></i>Eliminar</button>
            </td>

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
