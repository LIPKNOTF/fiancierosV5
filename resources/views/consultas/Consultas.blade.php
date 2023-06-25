@extends('layouts.app')
@section('titulo','alumnos')
@section('content')
<div id="apiConsulta">
<div class="card">
<div class="card-body">
    <div class="row justify-content-center">
       
      
              
            <div class="card-header text-center fw-bold text-white" style="background-color: #5D6D7E; margin-bottom: 10px;" >{{ __('MODULO DE COSULTAS') }} </div>

    <!-- Button trigger modal -->
    <div class="d-flex justify-content-center">
  <button type="button" class="btn btn-outline-success btn-sm text-white text-center" style="background-color: #28a717;" 
  @click="mostrarModal()">
  <i class="fa-solid fa-ticket-simple"></i>  AGREGAR UNA NUEVA CONSULTA
  </button>
</div>

<table id="myTable" class="table table-bordered table-striped table-hover mt-6">
  <thead class="table-primary">
    <tr>
    <th scope="col" class="text-center">Matricula</th>
      <th scope="col" class="text-center">Nombre</th>
      <th scope="col" class="text-center">AP. Paterno</th>
      <th scope="col" class="text-center">AP. Materno</th>
      <th scope="col" class="text-center">Importe</th>
      <th scope="col" class="text-center">Clave</th>
      <th scope="col" class="text-center">Cantidad</th>
      <th scope="col" class="text-center">Cuota</th>
      <th scope="col" class="text-center">Fecha</th>
      <th scope="col" class="text-center">Folio</th>
      <th scope="col" class="text-center">Concepto</th>
      <th scope="col" class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="con in consultas">
     <td class="text-center">@{{con.alumno.matricula}}</td>
      <td class="text-center">@{{con.alumno.nombres}}</td>
      <td class="text-center">@{{con.alumno.apellido_p}}</td>
      <td class="text-center">@{{con.alumno.apellido_m}}</td>
      <td class="text-center">@{{con.importe}}</td>
      <td class="text-center">@{{con.clave}}</td>
      <td class="text-center">@{{con.cantidad}}</td>
      <td class="text-center">@{{con.cuota}}</td>
      <td class="text-center">@{{con.fecha}}</td>
      <td class="text-center">@{{con.folio}}</td>
      <td class="text-center">@{{con.concepto}}</td>
      <td class="text-center">
        <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
 Acciones
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item"  @click="editarConsulta(con.id)"><i class="fa-solid fa-pen-to-square"></i> Editar</a></li>
    <li><a class="dropdown-item"  @click="eliminarConsulta(con.id,con.concepto,con.folio)"><i class="fa-solid fa-trash"></i> Eliminar</a></li>
  </ul>
</div>
      </td>
    </tr>
  </tbody>
</table>



<div class="card-body">
                  
                  </div>
          </div>
          </div>
      </div>
      




 <!-- VENTANA MODA -->
 <div class="modal fade" id="modalConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">
        <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-if="agregando">AGREGAR UNA NUEVA CONSULTA</h1>
        <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-else>EDITAR UNA NUEVA CONSULTA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
   <!-- EMPIEZA EL FORMULARIO -->
   <div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label  class="fw-bold">ALUMNO</label>
      <v-select  v-model="id_alumno" :reduce="alumnos => alumnos.id" :options="alumnos" label="matricula"></v-select>

    </div>

    <div class="form-group">
      <label  class="fw-bold">IMPORTE</label>
      <input  placeholder="Importe(Valor)" v-model="importe" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label  class="fw-bold">CLAVE</label>
      <input  placeholder="Clave " v-model="clave" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label  class="fw-bold">CANTIDAD</label>
      <input  placeholder="Cantidad(Valor) " v-model="cantidad" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label  class="fw-bold">CUOTA</label>
      <input placeholder="Cuota(Valor)" v-model="cuota" autofocus @input="convertirMayusculas" required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label class="fw-bold">FECHA</label>
      <input  placeholder="Fecha" v-model="fecha" autofocus @input="convertirMayusculas" required type="date" class="form-control"></input>
    </div>

    <div class="form-group">
      <label  class="fw-bold">CONCEPTO</label>
      <input  placeholder="Concepto" v-model="concepto" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>

    <div class="form-group">
      <label  class="fw-bold">FOLIO</label>
      <input  placeholder="Folio" v-model="folio" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>
  </div>
</div>
 <!-- TERMINA EL FORMULARIO -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn text-white" @click="agregarConsulta()" v-if="agregando" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
        <button type="button" class="btn text-white" @click="actualizarConsulta()" v-else :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">GUARDAR</button>
      </div>
    </div>
  </div>
</div>
</div>

@endsection
 

@push('scripts')
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/vue-resource.js"></script>
<script src="js/apis/apiConsulta.js"></script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">