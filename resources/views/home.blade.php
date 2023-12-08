@extends('layouts.master')
@section('content')
<h1>Inicio</h1>
<div class="owl-carousel card-body">
    <a href="/alumno" class="carta">
        <div class="caja">
            <div class="icono">
                <div class="icono-caja"><i class="fa-solid fa-user-graduate carta-icono"></i></div>
            </div>
            <div class="card-contenido">
                <h2 class="mb-1">Alumnos</h2>
                <p class="informacion mb-1">Registrar, editar y eliminar Alumnos.</p>
                @php
                use App\Models\Alumnos;
                $cant_alumnos = Alumnos::count();
                @endphp
                <h1>{{$cant_alumnos}}</h1>
                <button class="btn-card">VER</button>
            </div>
        </div>
    </a>
    <a href="/informacion" class="carta">
        <div class="caja">
            <div class="icono">
                <div class="icono-caja"> <i class="fa-solid fa-magnifying-glass carta-icono"></i></div>
            </div>
            <div class="card-contenido">
                <h2 class="mb-1">Consultas</h2>
                <p class="informacion mb-1">Registrar, editar, eliminar y descargar Consultas.</p>
                @php
                use App\Models\Consultas;
                $cant_Consultas = Consultas::count();
                @endphp
                <h1>{{$cant_Consultas}}</h1>
                <button class="btn-card">VER</button>
            </div>
        </div>
    </a>
    <a href="/clave" class="carta">
        <div class="caja">
            <div class="icono">
                <div class="icono-caja"> <i class="fa-solid fa-shield-halved carta-icono"></i></div>
            </div>
            <div class="card-contenido">
                <h2 class="mb-1">Claves</h2>
                <p class="informacion mb-1">Registrar, editar, eliminar y descargar Claves.</p>
                @php
                use App\Models\Clave;
                $cant_Clave = Clave::count();
                @endphp
                <h1>{{$cant_Clave}}</h1>
                <button class="btn-card">VER</button>
            </div>
        </div>
    </a>
    <a href="/partida" class="carta">
        <div class="caja">
            <div class="icono">
                <div class="icono-caja"><i class="fa-solid fa-paste carta-icono"></i></div>
            </div>
            <div class="card-contenido">
                <h2 class="mb-1">Partidas</h2>
                <p class="informacion mb-1">Registrar, editar y eliminar Partidas.</p>
                @php
                use App\Models\Partida;
                $cant_Partida= Partida::count();
                @endphp
                <h1>{{$cant_Partida}}</h1>
                <button class="btn-card">VER</button>
            </div>
        </div>
    </a>
    <a href="/capitulo" class="carta">
        <div class="caja">
            <div class="icono">
                <div class="icono-caja"><i class="fa-solid fa-book carta-icono"></i></div>
            </div>
            <div class="card-contenido">
                <h2 class="mb-1">Capitulos</h2>
                <p class="informacion mb-1">Registrar, editar y eliminar Capitulos.</p>
                @php
                use App\Models\Capitulo;
                $cant_Capitulo= Capitulo::count();
                @endphp
                <h1>{{$cant_Capitulo}}</h1>
                <button class="btn-card">VER</button>
            </div>
        </div>
    </a>
    <a href="/listConcentrado" class="carta">
        <div class="caja">
            <div class="icono">
                <div class="icono-caja"><i class="fa-solid fa-database carta-icono"></i></div>
            </div>
            <div class="card-contenido">
                <h2 class="mb-1">Concentrados</h2>
                <p class="informacion mb-1">Registrar, editar y eliminar Concentrados.</p>
                @php
                use App\Models\Concentrado;
                $cant_Concentrado= Concentrado::count();
                @endphp
                <h1>{{$cant_Concentrado}}</h1>
                <button class="btn-card">VER</button>
            </div>
        </div>
    </a>
</div>
@auth
<br>
<footer class="footer">Sesion <span class="verde">activa</span> de {{ Auth::user()->name }}</footer>
@endauth
@endsection
@push('scripts')
<!-- Agrega la librería Owl Carousel -->
<link rel="stylesheet" href="css_new/owl.carousel.min.css">
<link rel="stylesheet" href="css_new/owl.theme.default.min.css">

<!-- Agrega Owl Carousel -->
<script src="js_new/owl.carousel.min.js"></script>

<script>
    $(document).ready(function() {
        // Calcula el número de elementos según el ancho de la pantalla
        var itemsToShow = calculateItemsToShow();

        // Inicializa el carrusel con el número calculado de elementos
        $(".owl-carousel").owlCarousel({
            items: itemsToShow,
            margin: 20,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });

        // Vuelve a calcular el número de elementos cuando cambia el tamaño de la pantalla
        $(window).resize(function() {
            itemsToShow = calculateItemsToShow();
            $(".owl-carousel").trigger('destroy.owl.carousel').owlCarousel({
                items: itemsToShow,
                margin: 20,
                loop: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true
            });
        });

        // Función para calcular el número de elementos según el ancho de la pantalla
        function calculateItemsToShow() {
            var screenWidth = window.innerWidth;
            var itemsToShow = screenWidth >= 1800 ? 5 : screenWidth >= 1000 ? 4 : (screenWidth >= 768 ? 2 : 1);
            return itemsToShow;
        }
    });
</script>
@endpush