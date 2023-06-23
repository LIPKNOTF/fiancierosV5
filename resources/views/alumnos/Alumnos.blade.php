
@extends('layouts.app')
@section('titulo','alumnos')
@section('content')

<div class="container">
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ __($error) }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

                        @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
<i class="fa-solid fa-file-excel"></i>CARGAR
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title fw-bold" id="importModalLabel">IMPORTAR DATOS DESDE UN EXCEL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/import" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="file">Asegúrate de que el formato sea el correcto</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="file" name="file" onchange="handleFileSelect(event)">
              <label class="custom-file-label" for="file" id="fileLabel">SELECCIONA O ARRASTRA AQUÍ.</label>
            </div>
          </div>

          <button type="submit" class="btn btn-success">Importar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function handleFileSelect(event) {
    const file = event.target.files[0];
    const fileLabel = document.getElementById('fileLabel');
    fileLabel.innerHTML = file.name;
  }
</script>
</div>
<div id="apiAlumno">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20"> <!-- Cambiado a col-md-10 para un ancho más amplio -->
            <div class="card">
              
                <div class="card-header text-center text-white" style="background-color: #087990; margin-bottom: 10px;" >{{ __('Modulo Alumno') }} </div>

    <!-- Button trigger modal -->
    <div class="d-flex justify-content-center">
  <button type="button" class="btn btn-outline-success btn-sm text-white text-center" style="background-color: #28a717;" 
  @click="mostrarModal()">
  <i class="fa-sharp fa-regular fa-address-card"></i>  AGREGAR ALUMNOS
  </button>
</div>
  


<table class="table table-bordered  table-striped table-hover mt-4" >
  <thead>
    <tr>
    <th scope="col">Matricula</th>
      <th scope="col">Nombres</th>
      <th scope="col">AP. Paterno</th>
      <th scope="col">AP. Materno</th>
      <th scope="col">Grado</th>
      <th scope="col">Grupo</th>
      <th scope="col">Carrera</th>
      <th scope="col">Turno</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
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
      <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
 Acciones
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item"  @click="editarAlumno(alu.id)"><i class="fa-solid fa-pen-to-square"></i> Editar</a></li>
    <li><a class="dropdown-item"  @click="eliminarAlumno(alu.id, alu.matricula, alu.nombres, alu.apellido_p, alu.apellido_m)"><i class="fa-solid fa-trash"></i> Eliminar</a></li>
  </ul>
</div>


      </td>
    </tr>
  </tbody>
</table>

</div>

<div class="card-body">
                  
                  </div>
              </div>
          </div>
      </div>


      <!-- VENTANA MODA -->
      <div class="modal fade" id="modalAlumno" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">
        <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-if="agregando">AGREGAR UN ALUMNO</h1>
        <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-else>EDITAR ALUMNO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <!-- EMPIEZA EL FORMULARIO -->
        <div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="matricula" class="fw-bold">MATRICULA</label>
      <input id="matricula" placeholder="Matricula" v-model="matricula" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label for="nombres" class="fw-bold">NOMBRES</label>
      <input id="nombres" placeholder="Nombres" v-model="nombres" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label for="apellido_p" class="fw-bold">APELLIDO PATERNO</label>
      <input id="apellido_p" placeholder="Apellido Paterno" v-model="apellido_p" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label for="apellido_m" class="fw-bold">APELLIDO MATERNO</label>
      <input id="apellido_m" placeholder="Apellido Materno" v-model="apellido_m" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label for="grado" class="fw-bold">GRADO</label>
      <input id="grado" placeholder="Grado" v-model="grado" autofocus @input="convertirMayusculas" required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label for="grupo" class="fw-bold">GRUPO</label>
      <input id="grupo" placeholder="Grupo" v-model="grupo" autofocus @input="convertirMayusculas" required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label for="carrera" class="fw-bold">CARRERA</label>
      <input id="carrera" placeholder="Carrera" v-model="carrera" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label for="turno" class="fw-bold">TURNO</label>
      <input id="turno" placeholder="Turno" v-model="turno" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>
  </div>
</div>
 <!-- TERMINA EL FORMULARIO -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn text-white" @click="agregarAlumno()" v-if="agregando" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
        <button type="button" class="btn text-white" @click="actualizarAlumno()" v-else :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
      </div>
    </div>
  </div>
</div>
  </div>
  
@endsection


@push('scripts')
 <script src="js/bootstrap.bundle.min.js"></script>
<script src="js/vue-resource.js"></script>
<script src="js/apis/apiAlumno.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">