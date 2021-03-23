@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Lista de usuarios</h3>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Nombre</th>
        <th scope="col">apellido_paterno</th>
        <th scope="col">apellido_materno</th>
        <th scope="col">area_empresarial</th>
        <th scope="col">puesto</th>
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

@endsection
