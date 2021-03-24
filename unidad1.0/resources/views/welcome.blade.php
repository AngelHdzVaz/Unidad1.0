@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col">
    <div class=" row justify-content-end">
          <button type="button" class="btn btn-light" onclick="location.href='{{ route('MetColaboradores')}}'">Colaboradores</button>
    </div>
    <div class="row justify-content-center text-sm">
      <h1>SIMULADORES MÉDICOS </h1>
    </div>
    <div class="p-3 row justify-content-center text-sm">
      <img src="/images/logomet.jpg" width="150" height="150" alt="">
    </div>
    <div class="p-3 row justify-content-center text-sm">
      <div class="text-start">
        <p>
          SIMULADORES MÉDICOS MET es una empresa Mexicana dedicada a la importación, distribución y venta de equipo médico
          de alta calidad. Contamos con sucursales físicas y virtuales en Ciudad de México, Estado de México, Queretaro,
          Puebla y Veracruz.
        </p>
        <h3 align="center">QUIENES SOMOS</h3>
        <p align="center">Medical Equipment Technology SMI SA DE CV, es una empresa de grupo SMI, especializada y dirigida al mercado distribuidor.
          Además de fabricar, importar y vender equipo médico, desarrollamos proyectos médicos que por su configuración suelen llamarse
          "equipamiento integral o llave en mano", para sector público y privado. Esto incluye la sección educacional.</p>

          <h3 align="center">MISIÓN</h3>

          <p align="center">Brindar certeza y eficiencia a los clientes del mercado médico en general en la compra de equipo
          médico, Por medio de procesos de venta confiables y éticos, dando siempre a través de nuestros
          consultores médicos una buena asesoría.</p>

          <h3 align="center">VISIÓN</h3>

          <p align="center">Ser la empresa número 1 a nivel nacional en nuestro giro, en la distribución de equipo médico.
          Siendo reconocidos por nuestros clientes en todo el país  por ofrecer soluciones integrales, que le
          permitan tener la seguridad de que con nosotros se obtiene el mejor equipo, con las mejores
          condiciones y al mejor precio.</p>

          <h3 align="p-3 center">VALORES</h3>
          <ul class="p-3">
              <li>Eficiencia</li>
              <li>Certeza</li>
              <li>Lealtad</li>
              <li>Astucia</li>
            </tr>
            <tr>
              <li>Innovación</li>
              <li>Honestidad</li>
              <li>Ética</li>
              <li>Espiritu de servicio</li>
            </tr>
          </ul>


      </div>
    </div>
  </div>
</div>
@endsection
