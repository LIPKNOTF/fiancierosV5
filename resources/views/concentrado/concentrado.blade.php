@extends('layouts.app')
@section('titulo','alumnos')
@section('content')
<div id="concentrado">
    <div class="container">
    <div class="row mt-4">
            <div class="col-md-4 offset-md-4 mb-4">
                <div class="d-grid mx-auto">
                    <button class="btn btn-dark" @click="openModal()">
                        <i class="fa-solid fa-circle-plus"></i> Añadir
                    </button>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
            <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Partida</th>
                            <th>Fecha</th>
                            <th>Razon Social</th>
                            <th>RFC</th>
                            <th>Monto</th>
                            <th>Producto</th>   
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in concentrados">
                            <td>@{{row.id}}</td>
                            <td>@{{row.id_partida}}</td>
                            <td>@{{row.fecha}}</td>
                            <td>@{{row.razon_social}}</td>
                            <td>@{{row.rfc}}</td>
                            <td>@{{row.monto}}</td>
                            <td>@{{row.productos}}</td>
                            <td>
                                <button class="btn btn-info" @click="showConcentrado(row.id)">Editar</button>
                                <button class="btn btn-danger" @click="deleteConcentrado(row.id)">Elminar</button>
                            </td>
                        </tr>
                    </tbody>
                
            </table>
        </div>
        </div>
    </div>


    <!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalCon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true" >Registro de Concentrados</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false" >Editando Concentrados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label for="" class="form-label mt-2">Partida</label>
            <input type="number" class="form-control" v-model="id_partida" placeholder="Ingrese la Partida">

            <label for="" class="form-label mt-2">Fecha</label>
            <input type="date" class="form-control" v-model="fecha" placeholder="Ingrese la Fecha" v-if="agregando==true">
            <input type="text" class="form-control" v-model="fecha" placeholder="Ingrese la Fecha" v-if="agregando==false">

            <label for="" class="form-label mt-2">Razon Social</label>
            <input type="text" class="form-control" v-model="razon_social" placeholder="Ingrese la Razon Social">

            <label for="" class="form-label mt-2">RFC</label>
            <input type="text" class="form-control" v-model="rfc" placeholder="Ingrese el RFC">

            <label for="" class="form-label mt-2">Monto</label>
            <input type="number" class="form-control" v-model="monto" placeholder="Ingrese el Monto">

            <label for="" class="form-label mt-2">Producto</label>
            <input type="text" class="form-control" v-model="productos" placeholder="Ingrese el Producto">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="saveConcentrado()" v-if="agregando==true">Guardar</button>
        <button type="button" class="btn btn-primary" @click="updateConcentrado()" v-if="agregando==false">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->
</div>
@endsection
@push('scripts')
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/vue-resource.js"></script>
<script src="js/apis/apiConcentrado.js"></script>
<script src="js/XML/leerXML.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">