@extends('layouts.master')
@section('content')
<!-- AQUI EMPIEZA LA VISTA -->

<div id="apiclaves">

  <legend>
    <h1>&nbsp; Claves &nbsp;</h1>
  </legend>

  <button class="btn-modal" @click="mostrarModal()">Agregar</button>

  <table id="myTableClave" class="tabla display nowrap" style="width:100%">
    <thead class="fondo-negro">
      <tr>
        <th class="boder-inicio">ID</th>
        <th class="text-center">CLAVE</th>
        <th class="text-center">CONCEPTO</th>
        <th class="text-center">PRECIO</th>
        <th class="boder-fin">ACCIONES</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <tr v-for="cla in claves">
        <td class="text-center">@{{cla.id}}</td>
        <td class="text-center">@{{cla.clave}}</td>
        <td class="text-center">@{{cla.concepto}}</td>
        <td class="text-center">@{{cla.precio}}</td>
        <td class="text-center">
          <div class="btn-group">
            <button class="btn-edit" @click="editarClave(cla.id)"><i class="fa-solid fa-pen"></i></button>
            <button class="btn-delete" @click="eliminarClave(cla.id,cla.clave, cla.concepto)"><i class="fa-solid fa-trash-can"></i></button>
            <a :href="'/Polizapdf/' + cla.id" class="btn-download" target="_blank"><i class="fa-solid fa-download"></i> Descargar</a>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- VENTANA MODA -->
  <div class="modal fade" id="modalClave" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-body">
        <div class="modal-header text-white" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">
          <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-if="agregando">AGREGAR UNA CONSULTA</h1>
          <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-else>EDITAR UNA CONSULTA</h1>

        </div><br>

        <form>
          <!-- EMPIEZA EL FORMULARIO -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="fw-bold">CLAVE</label><br>
                <input placeholder="Clave" v-model="clave" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
              </div>
              <div class="form-group">
                <label class="fw-bold">PRECIO</label><br>
                <input placeholder="Precio" v-model="precio" autofocus required type="text" class="form-control"></input>
              </div>

            </div>

          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label fw-bold">CONCEPTO</label><br>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="concepto" autofocus @input="convertirMayusculas" required type="text"></textarea>
          </div>
          <!-- TERMINA EL FORMULARIO -->
        </form>

        <div class="modal-footer">
          <button type="button" class="btn-rojo" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn-modal" @click="agregarClave()" v-if="agregando" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
          <button type="button" class="btn-azul" @click="actualizarClave()" v-else :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection


@push('scripts')
<!-- IMPORTANTE PARA QUE NO OCURRA ERROR -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/apis/apiClave.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">