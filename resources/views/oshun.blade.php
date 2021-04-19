@extends('layouts.app')

@section('content')
<?php
  $empresa = 'OSHUN TRADING';
 ?>
<div class="container">
  <div class="col">
    <div class=" row justify-content-end">
          <button type="submit" name='OSHUN TRADING' id='OSHUN TRADING' class="btn btn-light" onclick="location.href='{{ route('ListaColaboradores',['empresa'=>$empresa])}}'">Colaboradores</button>
    </div>
    <div class="row justify-content-center text-sm">
      <h1>OSHUN</h1>
    </div>
    <div class="p-3 row justify-content-center text-sm">
      <img src="/images/logooshun2.jpg" width="150" height="150" alt="">
    </div>
    <div class="p-3 row justify-content-center text-sm">
      <div class="text-start">

        <h3 align="center">QUIENES SOMOS</h3>
        <p align="center">TOTEK es una empresa Mexicana con marca registrada perteneciente a Oshun International Trading Company SA de CV, dedicada a la fabricación,
         exportación y comercialización de, mezcal, productos alimenticios y ropa.<br>

      Cada uno de los productos tiene su propia marca y sistemas de comercialización independiente; pero, sin dejar de ser parte de un ambiente
       denominado UNIVERSO TOTEK.</p>

          <h3 align="center">MISIÓN</h3>

          <p align="center">La misión de Mezcal Totek es vender nuestro Mezcal  y sus productos complentarios con responsabilidad a los consumidores de todo el mundo.
             Esto lo haremos con un modelo de negocios innovador, diseñado meticulosamente para siempre proteger y difundir la cultura del Mezcal, el Estado de Oaxaca, México y nuestro Dios Desollado.</p>

          <h3 align="center">VISIÓN</h3>

          <p align="center"> Mezcal Totek será en 5 años una de las 10 marcas de Mezcal más vendidas en México y una de las 5 más representativas de este destilado en
            el extranjero, teniendo operación en 5 continentes.</p>

          <h3 align="p-3 center">VALORES</h3>
          <ul class="p-3">
              <li>Inovación</li>
              <li>Calidad</li>
              <li>Eficiencia</li>
              <li>Integridad</li>
              <li>Responsabilidad</li>
              <li>Lealtad</li>
              <li>Amor</li>
              <li>Comunicación</li>
          </ul>


      </div>
    </div>
  </div>
</div>
@endsection
