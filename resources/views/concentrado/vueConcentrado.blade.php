@extends('layouts.app')
@section('titulo','alumnos')
@section('content')
<div id="concentrado">
    <div class="container">
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <th>Partida</th>
                <th>Fecha</th>
                <th>Razon Social Emisor</th>
                <th>Razon Social Receptor</th>
                <th>RFC Emisor</th>
                <th>RFC Receptor</th>
                <th>Regimen Fiscar Emisor</th>
                <th>Regimen Fiscar Receptor</th>
                <th>Total</th>
                <th>Sub Total</th>
                <th>Impuesto Traslado</th>
                <th>Impuesto Retenido</th>
                <th>Productos</th>
                <th>Descripcion</th>
            </thead>
            <tbody>
                <tr v-for="row in concentrados">
                    <td>@{{row.id_partida}}</td>
                    <td>@{{row.fecha}}</td>
                    <td>@{{row.razon_social_emisor}}</td>
                    <td>@{{row.razon_social_receptor}}</td>
                    <td>@{{row.rfc_emisor}}</td>
                    <td>@{{row.rfc_receptor}}</td>
                    <td>@{{row.regimen_emisor}}</td>
                    <td>@{{row.regimen_receptor}}</td>
                    <td>@{{row.total}}</td>
                    <td>@{{row.sub_total}}</td>
                    <td>@{{row.impuesto_traslado}}</td>
                    <td>@{{row.impuesto_retenido}}</td>
                    <td>@{{row.productos}}</td>
                    <td>@{{row.descripcion}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- Ventana modal -->
     <!-- VENTANA MODA CREAR UNA CONSULTA -->
     <div class="modal fade" id="modalConcentrado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white bg-success">
        <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" >AGREGAR CONCENTRADO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <!-- EMPIEZA EL FORMULARIO -->
   <div class="row">
  <div class="col-md-6">
  
  <div class="form-group">
      <label  class="fw-bold">PARTIDA</label>
      <input  placeholder="Partida" type="number" v-model="id_partida"  class="form-control" >
    </div>
    <div class="form-group">
      <label  class="fw-bold">FECHA</label>
      <input  placeholder="Fecha" type="date" v-model="fecha"  class="form-control" >
    </div>
    <div class="form-group">
      <label  class="fw-bold">EMISOR: RAZON SOCIAL</label>
      <input  placeholder="Razon social del emisor" v-model="razon_social_emisor" class="form-control">
    </div>

  <div class="form-group">
      <label  class="fw-bold">EMISOR: RFC</label>
      <input  placeholder="RFC del emisor" v-model="rfc_emisor"  type="text" class="form-control" >
    </div>

    <div class="form-group">
      <label class="fw-bold">EMISOR: REGIIMEN FISCAL</label>
      <input type="text" v-model="regimen_emisor" placeholder="Regimen fiscal del emisor" class="form-control">
    </div>

    <div class="form-group">
      <label  class="fw-bold">RECEPTOR: RAZON SOCIAL</label>
      <input  placeholder="Razon social receptor" v-model="regimen_receptor" type="text" class="form-control">
    </div>


    <div class="form-group">
      <label  class="fw-bold">RECEPTOR: RFC</label>
      <input  placeholder="Rfc del Receptor " v-model="rfc_receptor" type="text" class="form-control">
    </div>
  </div>

  <div class="col-md-6">

  <div class="form-group">
      <label  class="fw-bold">RECEPTOR: REGIMEN FISCAL</label>
      <input  placeholder="Regimen fiscal del receptor" v-model="receptor_regimen" class="form-control" >
    </div>

    <div class="form-group">
      <label  class="fw-bold">TOTAL</label>
      <input placeholder="Total" v-model="total"  type="number" class="form-control">
    </div>

    <div class="form-group">
      <label class="fw-bold">SUB TOTAL</label>
      <input  placeholder="Sub total" v-model="sub_total"  type="number" class="form-control">
    </div>    
    <div class="form-group">
      <label  class="fw-bold">IMPUESTO DE TRASLADO</label>
      <input  placeholder="Impuesto de traslado" v-model="impuesto_traslado"  type="number" class="form-control">
    </div>

    <div class="form-group">
      <label  class="fw-bold">IMPUESTO RETENIDO</label>
      <input  placeholder="Impuesto retenido" v-model="impuesto_retenido" type="number" class="form-control">
    </div>

    <div class="form-group">
      <label  class="fw-bold">PRODUCTOS</label>
      <input  placeholder="Productos" v-model="productos"  type="text" class="form-control">
    </div>

    <div class="form-group">
      <label  class="fw-bold">DESCRIPCION</label>
      <input  placeholder="Descripcion" v-model="descripcion"   required type="number" class="form-control">
    </div>
 
  </div>
</div>
 <!-- TERMINA EL FORMULARIO -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn text-white" @click="agregarConsulta()"  style="background-color: #28a717;">GUARDAR</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/vue-resource.js"></script>
<script src="js/apis/apiConcentrado.js"></script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">