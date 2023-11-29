@extends('layouts.master')
@section('content')
<!-- AQUI EMPIEZA LA VISTA -->

<div id="apiDescripcion">
  <legend>
    <h1>&nbsp; Descripcion &nbsp;</h1>
  </legend>
  <!-- INICIA BOTON PARA CARGAR A EXCEL -->

  <button type="button" class="btn-modal" @click="mostrarModal()">Agregar</button>

  <table class="tabla display nowrap" style="width:100%">
    <thead class="fondo-negro">
      <tr>
        <th class="boder-inicio">ID</th>
        <th>CODIGO</th>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th class="boder-fin">ACCIONES</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <tr v-for="des in descripcion_partida">
        <td>@{{des.id}}</td>
        <td>@{{des.partida.codigo}}</td>
        <td>@{{des.partida.nombre}}</td>
        <td>@{{des.descripcion}}</td>
        <td>

          <button class="btn-edit" @click="mostrarDescripcion(des.id)"><i class="fa-solid fa-pen"></i></button>
          <button class="btn-delete" @click="eliminarDescripcion(des.id,des.partida.codigo,des.partida.nombre)"><i class="fa-solid fa-trash"></i></button>

        </td>
      </tr>
    </tbody>
  </table>




  <!-- VENTANA MODA -->
  <div class="modal fade" id="modalDescripcion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-body">
        <div class="modal-header text-white" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">
          <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-if="agregando">AGREGAR UNA CONSULTA</h1>
          <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-else>EDITAR UNA CONSULTA</h1>

        </div>
        <br>

        <form>
          <!-- EMPIEZA EL FORMULARIO -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="fw-bold">PARTIDA</label>
                <v-select v-model="id_partida" :reduce="partida => partida.id" :options="partida" label="codigo"></v-select>
              </div>
            </div>

          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label fw-bold">DESCRIPCION</label><br>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="descripcion" autofocus required type="text"></textarea>
          </div>
          <!-- TERMINA EL FORMULARIO -->
        </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn text-white" @click="agregarDescripcion()" v-if="agregando" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
          <button type="button" class="btn text-white" @click="actualizarDescripcion()" v-else :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
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
<script src="js/apis/apiDescripcion.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">