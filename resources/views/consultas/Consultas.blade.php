@extends('index')
@section('titulo','consultas')
@section('contenido')
<div id="apiConsulta">
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
@click="mostrarModal()">
  AGREGAR CONSULTA
</button>
<!-- Modal -->
<div class="modal fade" id="modalConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h1 class="modal-title fs-5" id="staticBackdropLabel"v-if="agregando==true">AGREGAR ALUMNO</h1>
      <h1 class="modal-title fs-5" id="staticBackdropLabel" v-if="agregando==false">EDITAR ALUMNO</h1>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
    
        <input  placeholder="id_alumno"
             v-model="id_alumno" autofocus required type="text" class="mt-1 block w-full"></input>

            <input  placeholder="importe"
            v-model="importe" autofocus required type="text" class="mt-1 block w-full"></input>

            <input placeholder="clave"
             v-model="clave" autofocus required type="text" class="mt-1 block w-full"></input>

            <input placeholder="cantidad"
             v-model="cantidad" autofocus required type="text" class="mt-1 block w-full"></input>

            <input placeholder="cuota"
             v-model="cuota" autofocus required type="text" class="mt-1 block w-full"></input>

            <input  placeholder="fecha"
             v-model="fecha" autofocus required type="text" class="mt-1 block w-full"></input>

            <input placeholder="folio"
            v-model="folio" autofocus required type="text" class="mt-1 block w-full"></input>

            <input  placeholder="concepto"
            v-model="concepto" autofocus required type="text" class="mt-1 block w-full"></input>
           
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="agregarConsulta()" v-if="agregando==true">GUARDAR</button>
        <button type="button" class="btn btn-warning" @click="actualizarConsulta()" v-if="agregando==false">GUARDAR</button>
      </div>
    </div>
  </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ALUMNO</th>
      <th scope="col">IMPORTE</th>
      <th scope="col">CLAVE</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">CUOTA</th>
      <th scope="col">FECHA</th>
      <th scope="col">FOLIO</th>
      <th scope="col">CONCEPTO</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <tr v-for="con in consultas">
      <td>@{{con.id_alumno}}</td>
      <td>@{{con.importe}}</td>
      <td>@{{con.clave}}</td>
      <td>@{{con.cantidad}}</td>
      <td>@{{con.cuota}}</td>
      <td>@{{con.fecha}}</td>
      <td>@{{con.folio}}</td>
      <td>@{{con.concepto}}</td>
      <td>
      <button type="submit" class="btn btn-warning" @click="editarConsulta(con.id)"><i class="fa-solid fa-pen-to-square"></i></button>
     <button type="button" class="btn btn-danger" @click="eliminarConsulta(con.id,con.concepto,con.folio )"><i class="fa-solid fa-trash"></i></button>
     </td>
    </tr>
  </tbody>
</table>
</div>

@endsection


@push('scripts')
 <script src="js/bootstrap.bundle.min.js"></script>
<script src="js/vue-resource.js"></script>
<script src="js/apis/apiConsulta.js"></script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">