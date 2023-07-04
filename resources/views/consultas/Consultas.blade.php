@extends('layouts.app')
@section('content')
<div id="apiConsulta">
<div class="card">
<div class="card-body">
    <div class="row justify-content-center">
       
    
    <div class="card-header text-center fw-bold text-white" style="background-color: #21618C; margin-bottom: 10px; border-radius: 5px;">
  <h4 class="mb-0">
    <i class="fa-solid fa-ticket" style="margin-right: 5px;"></i>
  {{ __('MODULO DE CONSULTAS') }}
  </h4>
</div>


<div class="text-center mb-3">
  <div class="d-flex justify-content-center">
    <button type="button" class="btn btn-outline-success btn-sm text-white text-center" style="background-color: #28a717;" @click="mostrarModal()">
      <i class="fa-solid fa-ticket"></i> AGREGAR UNA NUEVA CONSULTA
    </button>
  </div>
</div>

<div class="text-center">
  <div class="col-md-6 d-inline-block">
    <div class="input-group">
      <span class="input-group-text">Fecha Inicial</span>
      <input placeholder="FECHA DE TERMINO" v-model="fecha_f" type="date" class="form-control" />
      <span class="input-group-text">Fecha Final</span>
      <input placeholder="FECHA INICIO" v-model="fecha_i" type="date" class="form-control" />
      <button type="button" class="btn btn-outline-success btn-sm text-white text-center" style="background-color: #28a717;" @click="limpiar()">
        <i class="fa-solid fa-broom"></i> LIMPIAR
      </button>
    </div>
  </div>
</div>


<table id="myTable" class="table table-bordered table-striped table-hover mt-4 ">
  <thead class="table-primary"> 
    <tr>
    <th scope="col" class="text-center">Matricula</th>
      <th scope="col" class="text-center">Nombre</th>
      <th scope="col" class="text-center">AP. Paterno</th>
      <th scope="col" class="text-center">AP. Materno</th>
      <th scope="col" class="text-center">Cantidad</th>
      <th scope="col" class="text-center">Clave</th>
      <th scope="col" class="text-center">Concepto</th>
      <th scope="col" class="text-center">Cuota</th>
      <th scope="col" class="text-center">Importe</th>
      <th scope="col" class="text-center">Fecha</th>
      <th scope="col" class="text-center">Folio</th>
      <th scope="col" class="text-center">Total</th>
      <th scope="col" class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="con in filtrarfechas ">
     <td class="text-center">@{{con.alumno.matricula}}</td>
      <td class="text-center">@{{con.alumno.nombres}}</td>
      <td class="text-center">@{{con.alumno.apellido_p}}</td>
      <td class="text-center">@{{con.alumno.apellido_m}}</td>
      <td class="text-center">@{{con.cantidad}}</td>
      <td class="text-center">@{{con.claves_p.clave}}</td>
      <td class="text-center">@{{con.claves_p.concepto}}</td>
      <td class="text-center">@{{con.cuota}}</td>
      <td class="text-center">@{{con.importe}}</td>
      <td class="text-center">@{{con.fecha}}</td>
      <td class="text-center">@{{con.folio}}</td>
      <td class="text-center">@{{con.total}}</td>
      
      <td class="text-center">
        <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
 Acciones
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item"  @click="editarConsulta(con.id)"><i class="fa-solid fa-pen-to-square"></i> Editar</a></li>
    <li><a class="dropdown-item"  @click="eliminarConsulta(con.id,con.claves_p.clave,con.alumno.matricula)"><i class="fa-solid fa-trash"></i> Eliminar</a></li>
  </ul>
</div>
      </td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>

<!-- VENTANA MODA -->
<div class="modal fade" id="modalConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
      <label class="fw-bold">FOLIO</label>
      <input placeholder="Folio" v-model="folio" @input="convertirMayusculas" autofocus required type="text" class="form-control"></input>
    </div>
    <div class="form-group">
      <label class="fw-bold">ALUMNO</label>
      <v-select v-model="id_alumno" :reduce="alumno => alumno.id" :options="alumnos" label="matricula"></v-select>
    </div>
    <div class="form-group">
      <label class="fw-bold">CLAVE</label>
      <v-select v-model="id_clave" :reduce="claves_p => claves_p.id" :options="claves_p" label="concepto"></v-select>
    </div>
    <div class="form-group">
      <label class="fw-bold">IMPORTE</label>
      <input placeholder="Importe(Valor)" v-model="importe" @input="convertirMayusculas" autofocus required type="number" class="form-control"></input>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="fw-bold">CANTIDAD</label>
      <input placeholder="Cantidad(Valor) " v-model="cantidad" @input="convertirMayusculas" autofocus required type="number" class="form-control"></input>
    </div>
    <div class="form-group">
      <label class="fw-bold">CUOTA</label>
      <input placeholder="Cuota(Valor)" v-model="cuota" autofocus @input="convertirMayusculas" required type="number" class="form-control"></input>
    </div>
    <div class="form-group">
      <label class="fw-bold">FECHA</label>
      <input placeholder="Fecha" v-model="fecha" autofocus @input="convertirMayusculas" required type="date" class="form-control"></input>
    </div>
    <div class="form-group">
      <label class="fw-bold">TOTAL</label>
      <input placeholder="TOTAL (VALOR)" v-model="total" @input="convertirMayusculas" autofocus required type="number" class="form-control"></input>
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