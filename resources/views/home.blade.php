@extends('layouts.master')
@section('content')
<h1>Inicio</h1>
<div class="card-body">
    <a href="/alumno">
        <div class="carta"><i class="fa-solid fa-user-graduate"></i>
            @php
            use App\Models\Alumnos;
            $cant_alumnos = Alumnos::count();
            @endphp
            <h1>&nbsp;{{$cant_alumnos}}</h1>
        </div>
    </a>
    <a href="/consulta">
        <div class="carta"><i class="fa-solid fa-magnifying-glass"></i>
            @php
            use App\Models\Consultas;
            $cant_Consultas = Consultas::count();
            @endphp
            <h1>&nbsp;{{$cant_Consultas}}</h1>
        </div>
    </a>

    <a href="/clave">
        <div class="carta"><i class="fa-solid fa-shield-halved"></i>
            @php
            use App\Models\Clave;
            $cant_Clave = Clave::count();
            @endphp
            <h1>&nbsp;{{$cant_Clave}}</h1>
        </div>
    </a>
    <a href="/concentrado">
        <div class="carta"><i class="fa-solid fa-file-code"></i>
        </div>
    </a>
    <a href="/partida">
        <div class="carta"><i class="fa-solid fa-paste"></i>
            @php
            use App\Models\Partida;
            $cant_Partida= Partida::count();
            @endphp
            <h1>&nbsp;{{$cant_Partida}}</h1>
        </div>
    </a>
    <a href="/capitulo">
        <div class="carta"><i class="fa-solid fa-book"></i>
            @php
            use App\Models\Capitulo;
            $cant_Capitulo= Capitulo::count();
            @endphp
            <h1>&nbsp;{{$cant_Capitulo}}</h1>
        </div>
    </a>

    <a href="/descripcion">
        <div class="carta"><i class="fa-solid fa-clipboard"></i></i>
            @php
            use App\Models\Descripcion;
            $cant_Descripcion= Descripcion::count();
            @endphp
            <h1>&nbsp;{{$cant_Descripcion}}</h1>
        </div>
    </a>

    <a href="/listConcentrado">
        <div class="carta"><i class="fa-solid fa-database"></i></i>
            @php
            use App\Models\Concentrado;
            $cant_Concentrado= Concentrado::count();
            @endphp
            <h1>&nbsp;{{$cant_Concentrado}}</h1>
        </div>
    </a>

</div>
@auth
<br>
<footer class="footer">Sesion <span class="verde">activa</span> de {{ Auth::user()->name }}</footer>
@endauth
@endsection


@push('scripts')
<!-- IMPORTANTE PARA QUE NO OCURRA ERROR -->
<script src="js/bootstrap.bundle.min.js"></script>

@endpush