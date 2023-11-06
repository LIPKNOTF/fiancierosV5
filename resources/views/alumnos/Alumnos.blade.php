@extends('layouts.app')
@section('content')
<!-- AQUI EMPIEZA LA VISTA -->
<div id="apiAlumno">
  <div class="card">
    <div class="card-body">
      <div class="row justify-content-center">


        <div class="card-header text-center fw-bold text-white" style="background-color: #2471A3; margin-bottom: 10px; border-radius: 5px;">
          <h4 class="mb-0">
            <i class="fa-sharp fa-regular fa-address-card" style="margin-right: 5px;"></i>
            {{ __('MODULO DE ALUMNOS') }}
          </h4>
        </div>

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
        <div class="d-flex justify-content-between align-items-center">
          <button type="button" class="btn btn-outline-success btn-sm text-white text-center" style="background-color: #28a717;" @click="mostrarModal()">
            <i class="fa-sharp fa-regular fa-address-card"></i> AGREGAR UN NUEVO ALUMNO
          </button>
          <div class="mx-2"></div> <!-- Espacio entre los botones -->
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-file-excel"></i> CARGAR ARCHIVO EXCEL
          </button>
        </div>




        <table id="myTableAlumnos" class="table table-bordered table-striped table-hover mt-4 table-responsive">
          <thead class="table-primary">
            <tr>
              <th scope="col" class="text-center">Matricula</th>
              <th scope="col" class="text-center">Nombres</th>
              <th scope="col" class="text-center">AP. Paterno</th>
              <th scope="col" class="text-center">AP. Materno</th>
              <th scope="col" class="text-center">Grado</th>
              <th scope="col" class="text-center">Grupo</th>
              <th scope="col" class="text-center">Carrera</th>
              <th scope="col" class="text-center">Turno</th>
              <th scope="col" class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr v-for="alu in alumnos">
              <td class="text-center">@{{alu.matricula}}</td>
              <td class="text-center">@{{alu.nombres}}</td>
              <td class="text-center">@{{alu.apellido_p}}</td>
              <td class="text-center">@{{alu.apellido_m}}</td>
              <td class="text-center">@{{alu.grado}}</td>
              <td class="text-center">@{{alu.grupo}}</td>
              <td class="text-center">@{{alu.carrera}}</td>
              <td class="text-center">@{{alu.turno}}</td>
              <td class="text-center">
                <div class="btn-group">

                  <button class="btn btn-success" @click="mostrarAlumno(alu.id)"><i class="fa-regular fa-calendar-plus"></i> CONSULTA</a></button>
                  <button class="btn btn-warning" @click="editarAlumno(alu.id)"><i class="fa-solid fa-pen-to-square"></i> EDITAR </a></button>
                  <button class="btn btn-danger" @click="eliminarAlumno(alu.id, alu.matricula, alu.nombres, alu.apellido_p, alu.apellido_m)"><i class="fa-solid fa-trash"></i></button>
                </div>


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
                  <label class="fw-bold">MATRICULA</label>
                  <input placeholder="Matricula" v-model="matricula" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
                </div>

                <div class="form-group">
                  <label class="fw-bold">NOMBRES</label>
                  <input placeholder="Nombres" v-model="nombres" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
                </div>

                <div class="form-group">
                  <label class="fw-bold">APELLIDO PATERNO</label>
                  <input placeholder="Apellido Paterno" v-model="apellido_p" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
                </div>

                <div class="form-group">
                  <label class="fw-bold">APELLIDO MATERNO</label>
                  <input placeholder="Apellido Materno" v-model="apellido_m" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="fw-bold">GRADO</label>
                  <input placeholder="Grado" v-model="grado" autofocus @input="convertirMayusculas" required type="text" class="form-control"></input>
                </div>

                <div class="form-group">
                  <label class="fw-bold">GRUPO</label>
                  <input placeholder="Grupo" v-model="grupo" autofocus @input="convertirMayusculas" required type="text" class="form-control"></input>
                </div>

                <div class="form-group">
                  <label class="fw-bold">CARRERA</label>
                  <input placeholder="Carrera" v-model="carrera" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
                </div>

                <div class="form-group">
                  <label class="fw-bold">TURNO</label>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn text-white" @click="agregarAlumno()" v-if="agregando" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
          <button type="button" class="btn text-white" @click="actualizarAlumno()" v-else :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
        </div>
      </div>
    </div>
  </div>






  <!-- VENTANA MODA CREAR UNA CONSULTA -->
  <div id="modalConsulta" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content row">
        <div class="modal-header text-white bg-success">
          <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel">AGREGAR UNA CONSULTA</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <!-- EMPIEZA EL FORMULARIO -->


            <div class="row">


              <div class="form-group col-6">

                <label class="fw-bold">MATRICULA</label>
                <input placeholder="Apellido Materno" v-model="matricula" @input="convertirMayusculas" class="form-control" disabled>

                <label class="fw-bold mt-2">APELLIDO PATERNO</label>
                <input placeholder="Apellido Paterno" v-model="apellido_p" class="form-control " disabled>

                <label class="fw-bold mt-2">FOLIO</label>
                <input placeholder="Folio" v-model="folio" @input="convertirMayusculas" disabled required type="text" class="form-control">

              </div>



              <div class="form-group col-6">

                <label class="fw-bold">NOMBRES</label>
                <input placeholder="Nombres" v-model="nombres" @input="convertirMayusculas" class="form-control" disabled>


                <label class="fw-bold mt-2">APELLIDO MATERNO</label>
                <input placeholder="Apellido Materno" v-model="apellido_m" class="form-control " disabled>

                <label class="fw-bold mt-2">FECHA</label>
                <input placeholder="Fecha" v-model="fecha" autofocus required type="date" class="form-control">
              </div>

              <div class="col-6 mb-3 " >
                <label class="fw-bold">CLAVE</label>
                <!-- <v-select  v-model="id_clave" :reduce="claves_p => claves_p.id" :options="claves_p" label="clave" type="text" v-on:keyup.enter="getClave(id_clave)"></v-select> -->
                <v-select v-model="id_clave" :reduce="claves_p => claves_p.id" :options="claves_p" label="clave" type="text"></v-select>
      <button class="btn btn-primary" @click="getClave(id_clave)">Buscar</button>
                
              </div>
              


           
              <div class="form-group">

                <table class="table table-stripped table-hover table-responsive">
                  <thead>
                    <tr>
                      <th>Cantidad</th>
                      <th>Descripcion</th>
                      <th>Precio</th>
                      <th>Importe</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(row,index) in claveConsulta">
                      <td><input type="number" class="form-control"  v-model="cantidades[index]" min="1"></td>
                      <td>@{{row.clave}}</td>
                      <td><input type="number" class="form-control"  v-model="cuotasObtenidas[index]"></td>
                      <td >@{{calcularImporte(index)}}</td>
                      <td><button class="btn btn-danger" @click="removeItem(index)"><i class="fa-solid fa-trash"></i></button></td>
                    </tr>
                  </tbody>
                </table>


              </div>

              <div class="form-group">
                
                <div class="col-md-8   mx-auto ">
                <div class="card">
                  <div class="card-body ">
                    <span class="fw-bold">Total a pagar es de: @{{subTotal}}</span> <br>
                    <span class="fw-bold mt-1">El total de articulos es de: @{{numeroArticulos}}</span>

                  </div>
                </div>
                </div>
              </div>




            </div>
            <!-- TERMINA EL FORMULARIO -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn text-white" @click="agregarConsulta()" style="background-color: #28a717;">GUARDAR</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@push('scripts')
<!-- IMPORTANTE PARA QUE NO OCURRA ERROR -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/vue-resource.js"></script>
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