@extends('layouts.master')
@section('titulo','Listado de Concentrados')
@section('content')
<div id="concentrado">
  <legend>
    <h1>&nbsp; Concentrados &nbsp;</h1>
  </legend><br>
  <a class="btn-modal" href="/con">Agregar Concentrado</a>
  <br>
  <br>

  <div class="input-group">
    <span class="input-group-text">Fecha Final</span>
    <input placeholder="FECHA INICIO" v-model="fecha_i" type="date" class="form-control" />
    <button type="button" class="btn-azul" style="background-color: #28a717;" @click="limpiar()">
      <i class="fa-solid fa-broom"></i>
    </button>
    <span class="input-group-text">Fecha Inicial</span>
    <input placeholder="FECHA DE TERMINO" v-model="fecha_f" type="date" class="form-control" />
  </div>

  <table id="myTable" class="display nowrap tabla " style="width:100%">
    <thead class="fondo-negro">
      <tr>
        <th class="boder-inicio">Partida Codigo</th>
        <th>Partida Nombre</th>
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
        <th class="boder-fin">ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="row in filtrarfechas">
        <td>@{{row.partida.codigo}}</td>
        <td>@{{row.partida.nombre}}</td>
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
        <td>
          <button class="btn btn-edit" @click="showConcentrado(row.id)"><i class="fa-solid fa-pencil"></i></button>
          <button class="btn btn-delete" @click="deleteConcentrado(row.id)"><i class="fa-solid fa-trash"></i></button>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- VENTANA MODA CREAR UNA CONSULTA -->
  <div class="modal fade" id="modalCon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-body">
        <div class="modal-content">
          <div class="modal-header text-white " style="background-color: #2471A3;">
            <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-if="agregando==true">AGREGAR CONCENTRADO</h1>
            <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel" v-if="agregando==false">EDITAR CONCENTRADO</h1>
          </div>

          <form>
            <!-- EMPIEZA EL FORMULARIO -->
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <label class="fw-bold">PARTIDA</label>
                  <v-select v-model="id_partida" :reduce="partida => partida.id" :options="partidas" label="nombre"></v-select>
                </div>
                <div class="form-group">
                  <label class="fw-bold">FECHA</label>
                  <input placeholder="Fecha" type="date" v-model="fecha" v-if="agregando==true" class="form-control">
                  <input placeholder="Fecha" type="text" v-model="fecha" v-if="agregando==false" class="form-control">
                </div>
                <div class="form-group">
                  <label class="fw-bold">EMISOR: RAZON SOCIAL</label>
                  <input placeholder="Razon social del emisor" v-model="razon_social_emisor" class="form-control">
                </div>

                <div class="form-group">
                  <label class="fw-bold">EMISOR: RFC</label>
                  <input placeholder="RFC del emisor" v-model="rfc_emisor" type="text" class="form-control">
                </div>

                <div class="form-group">
                  <label class="fw-bold">EMISOR: REGIIMEN FISCAL</label>
                  <input type="number" v-model="regimen_emisor" placeholder="Regimen fiscal del emisor" class="form-control">
                </div>

                <div class="form-group">
                  <label class="fw-bold">RECEPTOR: RAZON SOCIAL</label>
                  <input placeholder="Razon social receptor" v-model="razon_social_receptor" type="text" class="form-control">
                </div>


                <div class="form-group">
                  <label class="fw-bold">RECEPTOR: RFC</label>
                  <input placeholder="Rfc del Receptor " v-model="rfc_receptor" type="text" class="form-control">
                </div>
              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <label class="fw-bold">RECEPTOR: REGIMEN FISCAL</label>
                  <input type="number" placeholder="Regimen fiscal del receptor" v-model="regimen_receptor" class="form-control">
                </div>

                <div class="form-group">
                  <label class="fw-bold">TOTAL</label>
                  <input placeholder="Total" v-model="total" type="number" class="form-control">
                </div>

                <div class="form-group">
                  <label class="fw-bold">SUB TOTAL</label>
                  <input placeholder="Sub total" v-model="sub_total" type="number" class="form-control">
                </div>
                <div class="form-group">
                  <label class="fw-bold">IMPUESTO DE TRASLADO</label>
                  <input placeholder="Impuesto de traslado" v-model="impuesto_traslado" type="number" class="form-control">
                </div>

                <div class="form-group">
                  <label class="fw-bold">IMPUESTO RETENIDO</label>
                  <input placeholder="Impuesto retenido" v-model="impuesto_retenido" type="number" class="form-control">
                </div>

                <div class="form-group">
                  <label class="fw-bold">PRODUCTOS</label>
                  <input placeholder="Productos" v-model="productos" type="text" class="form-control">
                </div>

                <div class="form-group">
                  <label class="fw-bold">DESCRIPCION</label>
                  <input placeholder="Descripcion" v-model="descripcion" type="text" class="form-control">
                </div>

              </div>
            </div>
            <!-- TERMINA EL FORMULARIO -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn text-white" @click="saveConcentrado()" v-if="agregando==true" style="background-color: #28a717;">GUARDAR</button>
          <button type="button" class="btn btn-warning text-white" @click="updateConcentrado()" v-if="agregando==false" style="background-color: #28a717;">GUARDAR</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/apis/apiConcentrado.js"></script>

@endpush

<input type="hidden" name="route" value="{{ url('/') }}">