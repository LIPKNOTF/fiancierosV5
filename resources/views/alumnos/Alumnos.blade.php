@extends('layouts.master')
@section('content')
<!-- AQUI EMPIEZA LA VISTA -->
<div id="apiAlumno">
  <div class="card">
    <div class="card-body">
      <div class="row justify-content-center">

        <legend>
          <h1>&nbsp; Alumnos &nbsp;</h1>
        </legend>
        <!-- INICIA BOTON PARA CARGAR A EXCEL -->
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
        </div>
        <!-- TERMINA BOTON PARA CARGAR A EXCEL -->
        <button class="btn-modal" @click="mostrarModal()">Agregar</button>
        <button class="btn-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Importar</button>
        <table id="myTableAlumnos" class="tabla display nowrap" style="width:100%">
          <thead class="fondo-negro">
            <tr>
              <th class="boder-inicio">Matricula</th>
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
                <button class="btn-ver" @click="mostrarAlumno(alu.id)"><i class="fa-solid fa-clipboard-list"></i></button>
                <button class="btn-edit" @click="editarAlumno(alu.id)"><i class="fa-solid fa-pen"></i></button>
                <button class="btn-delete" @click="eliminarAlumno(alu.id, alu.matricula, alu.nombres, alu.apellido_p, alu.apellido_m)"><i class="fa-solid fa-trash-can"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- VENTANA MODA -->
  <div class="modal fade" id="modalAlumno" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-body">
        <div class="modal-header text-white" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">
          <h1 class="modal-title" id="staticBackdropLabel" v-if="agregando">AGREGAR UN ALUMNO</h1>
          <h1 class="modal-title" id="staticBackdropLabel" v-else>EDITAR ALUMNO</h1>
        </div>
        <br>
        <br>
        <div>
          <form>

            <div class="row">
              <div class="gruup-input">
                <input placeholder="Matricula" v-model="matricula" @input="convertirMayusculas" autofocus required type="text" class="input"></input>

                <input placeholder="Nombres" v-model="nombres" @input="convertirMayusculas" autofocus required type="text" class="input"></input>

                <input placeholder="Apellido Paterno" v-model="apellido_p" @input="convertirMayusculas" autofocus required type="text" class="input"></input>

                <input placeholder="Apellido Materno" v-model="apellido_m" @input="convertirMayusculas" autofocus required type="text" class="input"></input>

                <input placeholder="Grado" v-model="grado" autofocus @input="convertirMayusculas" required type="text" class="input"></input>

                <input placeholder="Grupo" v-model="grupo" autofocus @input="convertirMayusculas" required type="text" class="input"></input>

                <input placeholder="Carrera" v-model="carrera" @input="convertirMayusculas" autofocus required type="text" class="input"></input>
              </div>

              <div class="form-group">
                <label class="fw-bold">TURNO</label><br>
                <select v-model="turno" required class="form-control">
                  <option value="MATUTINO">MATUTINO</option>
                  <option value="VESPERTINO">VESPERTINO</option>
                  <option value="OTRO">OTRO</option>
                </select>
              </div>
            </div>
        </div>
        <!-- TERMINA EL FORMULARIO -->
        </form>
        <div class="modal-footer">
          <button type="button" class="btn-rojo" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn-modal" @click="agregarAlumno()" v-if="agregando" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
          <button type="button" class="btn-azul" @click="actualizarAlumno()" v-else :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
        </div>
      </div>
    </div>
  </div>

  <!-- VENTANA MODA CREAR UNA CONSULTA -->
  <div id="modalConsulta" class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-body">
        <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel">AGREGAR UNA CONSULTA</h1>
        <br>
        <div class="felex">
          <label class="fw-bold">MATRICULA</label><br>
          <input placeholder="Apellido Materno" v-model="matricula" @input="convertirMayusculas" class="form-control" disabled>
        </div>
        <div class="felex">
          <label class="fw-bold mt-2">APELLIDO PATERNO</label><br>
          <input placeholder="Apellido Paterno" v-model="apellido_p" class="form-control " disabled>
        </div>
        <div class="felex">
          <label class="fw-bold mt-2">FOLIO</label><br>

          <input placeholder="Folio" v-model="folio" @input="convertirMayusculas" disabled required type="text" class="form-control">
        </div>

        <div class="felex">
          <label class="fw-bold">NOMBRES</label><br>
          <input placeholder="Nombres" v-model="nombres" @input="convertirMayusculas" class="form-control" disabled>
        </div>
        <div class="felex">
          <label class="fw-bold mt-2">APELLIDO MATERNO</label><br>
          <input placeholder="Apellido Materno" v-model="apellido_m" class="form-control " disabled>
        </div>

        <div class="felex">
          <label class="fw-bold mt-2">FECHA</label><br>
          <input placeholder="Fecha" v-model="fecha" autofocus type="date" class="form-control">
        </div>

        <div>
          <label>CLAVE</label>
          <!-- <v-select  v-model="id_clave" :reduce="claves_p => claves_p.id" :options="claves_p" label="clave" type="text" v-on:keyup.enter="getClave(id_clave)"></v-select> -->
          <v-select class="texto-blanco" v-model="id_clave" :reduce="claves_p => claves_p.id" :options="claves_p" label="clave" type="text"></v-select>
          <button class="btn-azul" @click="getClave(id_clave)">Buscar</button>
        </div>

        <table id="myTableAlumnos" class="tabla display nowrap" style="width:100%">
          <thead class="fondo-negro">
            <tr>
              <th class="boder-inicio">Cantidad</th>
              <th>Descripcion</th>
              <th>Precio</th>
              <th>Importe</th>
              <th class="boder-fin">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row,index) in claveConsulta">
              <td><input type="number" class="input" v-model="cantidades[index]" min="1"></td>
              <td>@{{row.clave}}</td>
              <td><input type="number" class="input" v-model="cuotasObtenidas[index]"></td>
              <td>@{{calcularImporte(index)}}</td>
              <td><button class="btn-delete" @click="removeItem(index)"><i class="fa-solid fa-trash"></i></button></td>
            </tr>
          </tbody>
        </table>

        <div class="form-group">
          <span class="fw-bold">Total a pagar es de: @{{subTotal}}</span> <br>
          <span class="fw-bold mt-1">El total de articulos es de: @{{numeroArticulos}}</span>
        </div>
        <button type="button" class="btn-rojo" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn-modal" @click="agregarConsulta()">GUARDAR</button>
      </div>
    </div>
    <!-- TERMINA EL FORMULARIO -->
  </div>
</div>


@endsection


@push('scripts')
<!-- IMPORTANTE PARA QUE NO OCURRA ERROR -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/apis/apiAlumno.js"></script>
<script>
  function handleFileSelect(event) {
    const file = event.target.files[0];
    const fileLabel = document.getElementById('fileLabel');
    fileLabel.innerHTML = file.name;
  }
</script>


@endpush
<input type="hidden" name="route" value="{{ url('/') }}">