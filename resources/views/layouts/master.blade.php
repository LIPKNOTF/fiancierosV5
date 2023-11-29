<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PsC</title>
    <!-- css master -->
    <link rel="stylesheet" href="css_new/master.css">
    <!-- foundawison css-->
    <link rel="stylesheet" href="css_new/all.min.css">
    
    <!-- foundawison script -->
    <script src="js_new/all.min.js"></script>
    <!-- datatable -->
    <script src="js_new/jquery.js"></script>
    <script src="js_new/jquery.data.js"></script>
    <script src="js_new/datable.responsive.js"></script>
    <link rel="stylesheet" href="css_new/datatable.responsive.css">
    <link rel="stylesheet" href="css_new/datatable.css">
    <!-- datatable fin -->
    <!-- master anterior -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
    <script src="https://unpkg.com/vue-multiselect@2.1.6"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">

    {{-- <script src="https://unpkg.com/vue@latest"></script> --}}

    <script src="https://unpkg.com/vue-select@3.0.0"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
</head>

<body>
    <div class="loader-overlay" id="loaderOverlay">
        <div class="contenedor-loader">
            <div class="loader"></div>
        </div>
    </div>
    @auth
    <div class="nav-principal">
        &nbsp;<h1>P</h1>
        <h2>S</h2>
        <h3>C</h3>
        <nav class="nav-primaria">
            <!-- Inicio -->
            <a href="{{ url('home') }}" title="Inicio" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
                <i class="fa-solid fa-house hover-verde"></i>
            </a>
            <!-- Alumnos -->
            <a href="{{ url('alumno') }}" title="Alumnos" class="nav-link {{ Request::is('alumno*') ? 'active' : '' }}">
                <i class="fa-solid fa-graduation-cap hover-verde"></i>
            </a>
            <!-- Consulta -->
            <a href="{{ url('consulta') }}" title="Consulta" class="nav-link {{ Request::is('consulta*') ? 'active' : '' }}">
                <i class="fa-solid fa-magnifying-glass hover-verde"></i>
            </a>
            <!-- Clave -->
            <a href="{{ url('clave') }}" title="Clave" class="nav-link {{ Request::is('clave*') ? 'active' : '' }}">
                <i class="fa-solid fa-shield-halved hover-verde "></i>
            </a>
            <!-- Lectura xml -->
            <a href="{{ url('xml') }}" title="Lector XML" class="nav-link {{ Request::is('xml*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-code hover-verde"></i>
            </a>
            <!-- Consentrados -->
            <a href="{{ url('listConcentrado') }}" title="listConcentrado" class="nav-link {{ Request::is('listConcentrado*') ? 'active' : '' }}">
                <i class="fa-solid fa-database color-rojo"></i>
            </a>
            <!-- Partidas -->
            <a href="{{ url('partida') }}" title="Partidas" class="nav-link {{ Request::is('partida*') ? 'active' : '' }}">
                <i class="fa-solid fa-paste hover-verde"></i>
            </a>
            <!-- Capitulos -->
            <a href="{{ url('capitulo') }}" title="Capitulos" class="nav-link {{ Request::is('capitulo*') ? 'active' : '' }}">
                <i class="fa-solid fa-book hover-verde"></i>
            </a>
            <a href="{{ url('finanzas') }}" title="finanzas" class="nav-link {{ Request::is('finanzas*') ? 'active' : '' }}">
                <i class="fa-solid fa-landmark hover-verde"></i>
            </a>
        </nav>

        <nav class="nav-secumdaria">
            <!-- Cerrar Seccion -->
            @guest
            @if (Route::has('login'))

            <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket verde"></i></i></a>

            @endif
            @else
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="SALIR">
                <i class="fa-solid fa-right-from-bracket rojo"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @endguest
        </nav>
    </div>
    @endauth
    <main class="contenedor">
        @yield('content')
    </main>
    <script src="js/moment.min.js"></script>
    <script src="js/moment-with-locales.min.js"></script>
    {{-- sweft --}}
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/vue-resource.js"></script>
    <script src="https://unpkg.com/vue-select@3.0.0"></script>

    @stack('scripts')
    <script>
        // Muestra la ventana de carga
        function showLoader() {
            document.getElementById('loaderOverlay').style.display = 'flex';
        }

        function hideLoader() {
            document.getElementById('loaderOverlay').style.display = 'none';
        }

        window.addEventListener("load", function() {
            const path = window.location.pathname;

            if (path === '/login') {
                return;
            }

            setTimeout(function() {
                hideLoader();
                console.log((path === '/alumno') ? "alumnos" : path.substring(1));
            }, (path === '/alumno') ? 1500 : 0);

            if (['/consulta', '/clave', '/concentrado', '/partida', '/capitulo','/finanzas'].includes(path)) {
                setTimeout(function() {
                    hideLoader();
                    console.log("Demas");
                }, 200);
            }
        });
    </script>

</body>

</html>