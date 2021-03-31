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
        @foreach($usuarios as $usuario)
          <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->nombre }}</td>
            <td>{{ $usuario->apellido_paterno }}</td>
            <td>{{ $usuario->apellido_materno }}</td>
            <td>{{ $usuario->area_empresarial }}</td>
            <td>{{ $usuario->puesto }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
