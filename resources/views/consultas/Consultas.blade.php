@extends('layouts.master')
@section('content')
<div id="apiConsulta">
  <div class="card">



    <legend>
      <h1>&nbsp; Consulta &nbsp;</h1>
    </legend>

    <button class="btn-modal" @click="mostrarModal()">Agregar</button>

    <div class="text-center">

      <span class="input-group-text">Fecha Inicial</span>
      <input placeholder="FECHA DE TERMINO" v-model="fecha_f" type="date" class="input" />

      <span class="input-group-text">Fecha Final</span>
      <input placeholder="FECHA INICIO" v-model="fecha_i" type="date" class="input" />

      <button type="button" class="btn-edit" @click="limpiar()">
        <i class="fa-solid fa-broom"></i>
      </button>


    </div>


    <table id="myTable" class="tabla display nowrap" style="width:100%">
      <thead class="fondo-negro">
        <tr>
          <th class="boder-inicio">Matricula</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">AP. Paterno</th>
          <th class="text-center">AP. Materno</th>
          <th class="text-center">Cantidad</th>
          <th class="text-center">Clave</th>
          <th class="text-center">Concepto</th>
          <th class="text-center">Total</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Folio</th>
          <th class="text-center">Total</th>
          <th class="boder-fin">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="con in filtrarfechas ">
          <td>@{{con.alumno.matricula}}</td>
          <td>@{{con.alumno.nombres}}</td>
          <td>@{{con.alumno.apellido_p}}</td>
          <td>@{{con.alumno.apellido_m}}</td>
          <td>@{{con.cantidad}}</td>
          <td>@{{con.claves_p ? con.claves_p.clave : 'Sin Clave'}}</td>
          <td>@{{con.claves_p ? con.claves_p.concepto : 'Sin Concepto'}}</td>
          <td>@{{con.total}}</td>
          <td>@{{con.fecha}}</td>
          <td>@{{con.folio}}</td>
          <td>@{{con.total}}</td>
          <td>
            <button class="btn-edit" @click="editarConsulta(con.id)"><i class="fa-solid fa-pen"></i></button>
            <button class="btn-delete" @click="eliminarConsulta(con.id)"><i class="fa-solid fa-trash-can"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- VENTANA MODA -->
  <div class="modal fade" id="modalConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-body">
        <div class="modal-header text-white" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">
          <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-if="agregando">AGREGAR UNA CONSULTA</h1>
          <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-else>EDITAR UNA CONSULTA</h1>
        </div>
        <br>
        <br>
        <form>
          <!-- EMPIEZA EL FORMULARIO -->
          <div class="row">
            <div class="form-group col-6">

              <label class="fw-bold mt-2">FOLIO</label>
              <span>@{{folio}}</span>
              <input placeholder="Folio" v-model="folio" @input="convertirMayusculas" disabled required type="text" class="form-control">
              <label class="fw-bold mt-2">FECHA</label>
              <input placeholder="Fecha" v-model="fecha" autofocus @input="convertirMayusculas" required type="date" class="form-control"></input>
            </div><br>

            <div class="form-group">

              <label class="fw-bold mt-2">ALUMNO</label>
              <v-select class="texto-blanco" v-model="id_alumno" :reduce="alumno => alumno.id" :options="alumnos" label="matricula"></v-select>

              <label class="fw-bold mt-2">CLAVE</label>
              <v-select class="texto-blanco" v-model="id_clave" :reduce="claves_p => claves_p.id" :options="claves_p" label="clave"></v-select>
              <button class="btn-azul" @click="getClave(id_clave)">Buscar</button>

            </div>

          </div>

          <table id="myTableAlumnos" class="tabla display nowrap" style="width:100%">
            <thead class="fondo-negro">
              <tr>
                <th class="boder-inicio">Cantidad</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Importe</th>
                <th>Acciones</th>
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

            <div class="col-md-8   mx-auto ">
              <div class="card">
                <div class="card-body ">
                  <span class="fw-bold">Total a pagar es de: @{{subTotal}}</span> <br>
                  <span class="fw-bold mt-1">El total de articulos es de: @{{numeroArticulos}}</span>

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-rojo" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn-modal" @click="agregarConsulta()" v-if="agregando" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
            <button type="button" class="btn-azul" @click="actualizarConsulta()" v-else :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
          </div>



      </div>
      <!-- TERMINA EL FORMULARIO -->
      </form>

    </div>

  </div>
</div>
</div>
</div>

@endsection


@push('scripts')
<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/apis/apiConsulta.js"></script>

@endpush

<input type="hidden" name="route" value="{{ url('/') }}">