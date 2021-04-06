@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Lista de Colaboradores Medical Technology</h3>
    <div class=" row justify-content-end">
          <button type="button" class="btn btn-light" onclick="location.href='{{ route('RegistroColaborador')}}'">Nuevo</button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Área Empresarial</th>
          <th scope="col">Puesto</th>
          <th scope="col">Telefonos</th>
          <th scope="col">Correos</th>
          
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
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
