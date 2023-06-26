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
    <a href="/alumno" class="text-home text-decoration-none">
        <div class="home card text-white " style="background-color: #0a58ca; margin-bottom: 10px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h5 class="text-center mb-3 fw-bold">Consultas</h5>
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
        <div class="home card text-white " style="background-color: #087990; margin-bottom: 10px;">
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
   


               

              
            </div>
        </div>
    </div>

                <div class="card-body">
                  
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
