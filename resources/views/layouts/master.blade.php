<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PSC</title>
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
    <div class="nav-principal">
        &nbsp;<h1>P</h1>
        <h2>S</h2>
        <h3>C</h3>
        <nav class="nav-primaria">
            <!-- Inicio -->
            <a href="" title="Inicio">
                <i class="fa-solid fa-house hover-verde">hola</i>
            </a>
            <!-- Alumnos -->
            <a href="{{ url('alumno') }}" title="Alumnos">
                <i class="fa-solid fa-graduation-cap hover-verde"></i>
            </a>
            <!-- Consulata -->
            <a href="" title="Consulata">
                <i class="fa-solid fa-magnifying-glass hover-verde"></i>
            </a>
            <!-- Clave -->
            <a href="" title="Clave">
                <i class="fa-solid fa-key hover-verde"></i>
            </a>
            <!-- Lectura xml -->
            <a href="" title="Lector XML">
                <i class="fa-solid fa-file-code hover-verde"></i></i>
            </a>
            <!-- Consentrados -->
            <a href="" title="Consentrados">
                <i class="fa-solid fa-database hover-verde"></i>
            </a>
            <!-- Partidas -->
            <a href="" title="Partidas">
                <i class="fa-solid fa-paste hover-verde"></i>
            </a>
            <!-- Capitulos -->
            <a href="" title="Capitulos">
                <i class="fa-solid fa-book hover-verde"></i>
            </a>
        </nav>
        <nav class="nav-secumdaria">
            <!-- Cerrar Seccion -->
            <a href=""><i class="fa-solid fa-right-to-bracket"></i></a>
        </nav>
    </div>
    <main class="contenedor">
        @yield('content')
        <!-- lugar para el @yeld contenido -->
        <!-- <legend> 
            <h1>&nbsp; Titulo &nbsp;</h1>
        </legend> -->
        <!-- <button class="btn-modal" id="open-modal">Agregar
        </button>
        <table id="example" class="tabla display nowrap" style="width:100%">
      <thead class="fondo-negro">
        <tr>
          <th class="boder-inicio ">Matricula</th>
          <th>Nombres</th>
          <th>AP. Paterno</th>
          <th>AP. Materno</th>
          <th>Grado</th>
          <th>Grupo</th>
          <th>Carrera</th>
          <th>Turno</th>
          <th class="boder-fin">ACCIONES</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="alu in alumnos">
          <td>@{{alu.matricula}}</td>
          <td>@{{alu.nombres}}</td>
          <td>@{{alu.apellido_p}}</td>
          <td>@{{alu.apellido_m}}</td>
          <td>@{{alu.grado}}</td>
          <td>@{{alu.grupo}}</td>
          <td>@{{alu.carrera}}</td>
          <td>@{{alu.turno}}</td>
          <td>
            <button class="btn-edit" @click="mostrarAlumno(alu.id)"><i class="fa-solid fa-pen"></i></button>
            <button class="btn-edit" @click="mostrarAlumno(alu.id)"><i class="fa-solid fa-pen"></i></button>
            <button class="btn-delete" @click="eliminarAlumno(alu.id, alu.matricula, alu.nombres, alu.apellido_p, alu.apellido_m)"><i class="fa-solid fa-trash-can"></i></button>
          </td>
        </tr>
      </tbody>
    </table>-->

            
    </main>
    <script src="js/moment.min.js"></script>
    <script src="js/moment-with-locales.min.js"></script>
    {{-- sweft --}}
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/vue-select@3.0.0"></script>
</body>
@stack('scripts')
<script>
   
</script>

</html>