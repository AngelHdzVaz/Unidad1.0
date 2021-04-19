@extends('layouts.app')

@section('content')
<?php
  $empresa = 'MOOC chilaqueria';
 ?>
<div class="container">
  <div class="col">
    <div class=" row justify-content-end">
          <button type="submit" name='MOOC chilaqueria' id='MOOC chilaqueria' class="btn btn-light" onclick="location.href='{{ route('ListaColaboradores',['empresa'=>$empresa])}}'">Colaboradores</button>
    </div>
    <div class="row justify-content-center text-sm">
      <h1>MOOC </h1>
    </div>
    <div class="p-3 row justify-content-center text-sm">
      <img src="/images/logomooc.jpg" width="150" height="150" alt="">
    </div>
    <div class="p-3 row justify-content-center text-sm">
      <div class="text-start">
        <p align="center">
          "Somos el restaurante digital que siempre soñaste".<br>
          Pensamos en la comodidad y en las necesidades de nuestros clientes; es por eso que hemos incursionado en un nuevo concepto en
          línea con servicio únicamente a domicilio.
        </p>
        <h3 align="center">QUIENES SOMOS</h3>
        <p align="center">Medical Equipment Technology SMI SA DE CV, es una empresa de grupo SMI, especializada y dirigida al mercado distribuidor.
          Además de fabricar, importar y vender equipo médico, desarrollamos proyectos médicos que por su configuración suelen llamarse
          "equipamiento integral o llave en mano", para sector público y privado. Esto incluye la sección educacional.</p>

          <h3 align="center">MISIÓN</h3>

          <p align="center">Transformar el servicio que ofrece un restaurante físico de excelencia a un ambiente 100% digital,
            que además haga vivir a nuestros clientes una nueva experiencia de consumo; cuidando siempre aspectos como: sabor,
             servicio, presentación, higiene y velocidad.</p>

          <h3 align="center">VISIÓN</h3>

          <p align="center">Ser la primera empresa desarrolladora de Dark Kitchens en crear conceptos rentables en todo el país.
             Esto logrado con el apoyo del consumo de nuestros clientes derivado la buena calidad y referencia que dan nuestros servicios y productos. </p>

          <h3 align="p-3 center">VALORES</h3>
          <ul class="p-3">
              <li>Inovación</li>
              <li>Calidad</li>
              <li>Eficiencia</li>
              <li>Velocidad</li>
              <li>Versatilidad</li>
              <li>Inclusión</li>
              <li>Pasión</li>
          </ul>
      </div>
    </div>
  </div>
</div>
@endsection
