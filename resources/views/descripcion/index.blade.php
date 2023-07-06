@extends('layouts.app')
@section('content')
<!-- AQUI EMPIEZA LA VISTA -->

<div id="apiDescripcion">
<div class="card">
<div class="card-body">
    <div class="row justify-content-center">


    <div class="card-header text-center fw-bold text-white" style="background-color: #17A589; margin-bottom: 10px; border-radius: 5px;">
  <h4 class="mb-0">
  <i class="fa-solid fa-book"></i>
    {{ __('MODULO DE DESCRIPCIÓN') }}
  </h4>
</div>

    <!-- INICIA BOTON PARA CARGAR A EXCEL -->
    <div class="container">


    <div class="text-center mb-3">
  <button type="button" class="btn btn-outline-success btn-sm text-white text-center" style="background-color: #28a717;" @click="mostrarModal()">
  <i class="fa-solid fa-book"></i> AGREGAR UNA NUEVA DESCRIPCION DE LA PARTIDA
  </button>
  </div>


  


<table id="myTableDescripcion" class="table table-bordered table-striped table-hover mt-4 ">
  <thead class="table-primary">
    <tr>
    <th scope="col" class="text-center">ID</th>
      <th scope="col" class="text-center">CODIGO</th>
      <th scope="col" class="text-center">NOMBRE</th>
      <th scope="col" class="text-center">DESCRIPCION</th>
      <th scope="col" class="text-center">ACCIONES</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <tr v-for="des in descripcion_partida">
    <td class="text-center">@{{des.id}}</td>
    <td class="text-center">@{{des.partida.codigo}}</td>
      <td class="text-center">@{{des.partida.nombre}}</td>
      <td class="text-center">@{{des.descripcion}}</td>
      <td class="text-center">
      <div class="btn-group">
 
    <button class="btn btn-warning"  @click="mostrarDescripcion(des.id)"><i class="fa-solid fa-pen-to-square"></i> EDITAR </a></button>
<button class="btn btn-danger"  @click="eliminarDescripcion(des.id,des.partida.codigo,des.partida.nombre)"><i class="fa-solid fa-trash"></i></button>
</div>


      </td>
    </tr>
  </tbody>
</table>
          </div>
          </div>
      </div>


      <!-- VENTANA MODA -->
      <div class="modal fade" id="modalDescripcion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">
        <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-if="agregando">AGREGAR UNA CONSULTA</h1>
        <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-else>EDITAR UNA CONSULTA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <!-- EMPIEZA EL FORMULARIO -->
        <div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label  class="fw-bold">PARTIDA</label>
      <v-select v-model="id_partida" :reduce="partida => partida.id" :options="partida" label="codigo" ></v-select>
    </div>
  
  </div>

 
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label fw-bold">DESCRIPCION</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="descripcion" autofocus required type="text"></textarea>
</div>
 <!-- TERMINA EL FORMULARIO -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn text-white" @click="agregarDescripcion()" v-if="agregando" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
        <button type="button" class="btn text-white" @click="actualizarDescripcion()" v-else :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
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
<script src="js/vue-resource.js"></script>
<script src="js/apis/apiDescripcion.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">