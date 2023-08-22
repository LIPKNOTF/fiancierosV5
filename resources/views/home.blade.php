@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15"> <!-- Cambiado a col-md-10 para un ancho más amplio -->
            <div class="card">
                <div class="card-header text-center "  style="background-color:#e3f2fd">{{ __('PANEL DE CONTROL') }}</div>
    <div class="section-body">

        <div class="card-body">
            <div class="row">
    

                <!-- CARD DE SERVICIOS -->
                <div class="col-md-4 col-xl-4">
    <a href="/consulta" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #21618C; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold">CONSULTAS</h5>
                                @php
                                use App\Models\Consultas;
                                $cant_Consultas = Consultas::count();
                                @endphp
                                <h2 class="text-right"><i class="fa-solid fa-wallet"></i><span> {{$cant_Consultas}}</span></h2>
                                </div>
        </div>
    </a>
</div>
                <!-- FIN CARD DE CONSULTA -->


                  <!-- EMPIEZA CARD DE ALUMNOS-->
                  <div class="col-md-4 col-xl-4">
    <a href="/alumno" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #2471A3; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold">ALUMNOS</h5>
                @php
                use App\Models\Alumnos;
                $cant_alumnos = Alumnos::count();
                @endphp
                <h2 class="text-center"><i class="fa-solid fa-users"></i> <span class="ml-2">{{$cant_alumnos}}</span></h2>
            </div>
        </div>
    </a>
</div>
   <!-- FIN CARD DE ALUMNOS-->

   <!-- EMPIEZA CARD DE ALUMNOS-->
   <div class="col-md-4 col-xl-4">
    <a href="/clave" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #5DADE2; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold">CLAVES</h5>
                @php
                use App\Models\Clave;
                $cant_Clave = Clave::count();
                @endphp
                <h2 class="text-center"><i class="fa-solid fa-key"></i><span class="ml-2">{{$cant_Clave}}</span></h2>
            </div>
        </div>
    </a>
</div>
   <!-- FIN CARD DE ALUMNOS-->
     <!-- EMPIEZA CARD DE ALUMNOS-->
     <div class="col-md-4 col-xl-4">
    <a href="/partida" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #117864 ; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold">PARTIDA</h5>
                @php
                use App\Models\Partida;
                $cant_Partida= Partida::count();
                @endphp
                <h2 class="text-center"><i class="fa-solid fa-bookmark"></i><span class="ml-2"> {{$cant_Partida}}</span></h2>
            </div>
        </div>
    </a>
</div>
   <!-- FIN CARD DE ALUMNOS-->
     <!-- EMPIEZA CARD DE ALUMNOS-->
     <div class="col-md-4 col-xl-4">
    <a href="/capitulo" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #148F77 ; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold">CAPITULO</h5>
                @php
                use App\Models\Capitulo;
                $cant_Capitulo= Capitulo::count();
                @endphp
                <h2 class="text-center"><i class="fa-solid fa-book-bookmark"></i><span class="ml-2">{{$cant_Capitulo}}</span></h2>
            </div>
        </div>
    </a>
</div>
   <!-- FIN CARD DE ALUMNOS-->

    <!-- EMPIEZA CARD DE ALUMNOS-->
    <div class="col-md-4 col-xl-4">
    <a href="/descripcion" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #17A589 ; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold"> DESCRIPCION DE CLAVES</h5>
                @php
                use App\Models\Descripcion;
                $cant_Descripcion= Descripcion::count();
                @endphp
                <h2 class="text-center"><i class="fa-solid fa-book"></i> {{ $cant_Descripcion}}</span></h2>
            </div>
        </div>
    </a>
</div>
   <!-- FIN CARD DE ALUMNOS-->
   <!-- EMPIEZA CARD DE XML CONCENTRADOS-->
   <div class="col-md-4 col-xl-4">
    <a href="/concentrado" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #EF7A4A ; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold"> LECTURA DE XML</h5>
                
                <h2 class="text-center"><i class="fa-solid fa-file"></i></span></h2>
            </div>
        </div>
    </a>
</div>
   <!-- FIN CARD DE XML DE CONCENTRADOS-->
   <!-- EMPIEZA CARD DE CONCENTRADOS CON VUE-->
   <div class="col-md-4 col-xl-4">
    <a href="/listConcentrado" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #B04AEF ; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold"> LISTA DE CONCENTRADOS</h5>
                @php
                use App\Models\Concentrado;
                $cant_Concentrado= Concentrado::count();
                @endphp
                <h2 class="text-center"><i class="fa-solid fa-clipboard-list"></i> {{ $cant_Concentrado}}</span></h2>
            </div>
        </div>
    </a>
</div>
   <!-- FIN CARD DE  CONCENTRADOS CON VUE-->
   
   


               

   
            </div>
        </div>
    </div>

               
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<!-- IMPORTANTE PARA QUE NO OCURRA ERROR -->
<script src="js/bootstrap.bundle.min.js"></script>

@endpush
