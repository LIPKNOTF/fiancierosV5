<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
    <!-- <script src="https://unpkg.com/vue-multiselect@2.1.6"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">

    {{-- <script src="https://unpkg.com/vue@latest"></script> --}}

    <script src="https://unpkg.com/vue-select@3.0.0"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

</head>
<body>
    <div id="app">
        <div class="col-md-2 justify-content-center">
        
            
        </div>

        <nav class="navbar navbar-expand-md navbar-light  shadow-sm" style="background-color: #e3f2fd;">
            <div class="container" >
            <a class="navbar-brand" href="{{ url('home') }}">
            <a class="fw-bold fs-5 text-dark p-2 me-4" href="/home"><i class="fa-solid fa-house"></i></a>
                </a>
                <a class="navbar-brand" href="{{ url('alumno') }}">
                    {{  'Alumno' }}
                </a>
                <a class="navbar-brand" href="{{ url('consulta') }}">
                    {{'Consulta' }}
                </a>
                <a class="navbar-brand" href="{{ url('clave') }}">
                    {{'Clave' }}
                </a>
                <a class="navbar-brand" href="{{ url('concentrado') }}">
                    {{'Lectura de XML' }}
                </a>
                <a class="navbar-brand" href="{{ url('listConcentrado') }}">
                    {{'Concentrados' }}
                </a>
                <a class="navbar-brand" href="{{ url('partida') }}">
                    {{'Partidas' }}
                </a>
                <a class="navbar-brand" href="{{ url('capitulo') }}">
                    {{'Capitulos' }}
                </a>

               
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse"  id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto" >

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                      
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
    <script src="js/jquery.min.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/moment-with-locales.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.js"></script>


   
 
    <!-- Plugins -->

    <!-- Global Init -->
    



    


    {{-- sweft --}}
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="https://unpkg.com/vue-select@3.0.0"></script>
  
</body>
</html>
