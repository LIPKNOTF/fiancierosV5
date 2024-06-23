@extends('layouts.master')
@section('titulo','Lectura de XML')
@section('content')
<div id="concentrado2">

  <legend>
    <h1>&nbsp; lector XML &nbsp;</h1>
  </legend>

  <div>
    <label for="xmlFile">Ingrese su archivo XML</label>
    <input class="btn-azul wt" name="archivo" type="file" id="xmlFile" accept=".xml">
  </div>
  <button @click.prevent="leerArchivoXML2()" class="btn-modal">Cargar Archivo</button>
  <div class="gup-ino">
    <div>
      <label for="" class="form-label">Fecha</label>
      <input type="text" v-model="datos.fecha" class="form-control mt-2" disabled>
    </div>

    <div>
      <label for="" class="form-label">Receptor: RFC</label>
      <input type="text" v-model="datos.rfcReceptor" class="form-control mt-2" readonly>
    </div>

    <div>
      <label for="" class="form-label">Receptor: Razon Social</label>
      <input type="text" class="form-control mt-2" v-model="datos.razon_socialReceptor" readonly>
    </div>

    <div>
      <label for="" class="form-label">Receptor: Regimen Fiscal</label>
      <input type="text" class="form-control mt-2" v-model="datos.regimenFiscalReceptor" readonly>
    </div>

    <div>
      <label for="" class="form-label">Emisor: RFC</label>
      <input type="text" v-model="datos.rfcEmisor" class="form-control mt-2 " readonly>
    </div>

    <div>
      <label for="" class="form-label">Emisor: Razon Social</label>
      <input type="text" class="form-control mt-2" v-model="datos.razon_socialEmisor" readonly>
    </div>

    <div>
      <label for="" class="form-label">Emisor: Regimen Fiscal</label>
      <input type="text" class="form-control mt-2" v-model="datos.regimenFiscalEmisor" readonly>
    </div>

    <div>
      <label for="" class="form-label">Producto</label>
      <input type="text" class="form-control mt-2" v-model="datos.producto" readonly>
    </div>

    <div>
      <label for="" class="form-label">Impuesto de Retenido</label>
      <input type="text" class="form-control mt-2" v-model="datos.impuestoRetenido">
    </div>

    <div>
      <label for="" class="form-label">Impuesto de Traslado</label>
      <input type="text" class="form-control mt-2 " v-model="datos.impuestoTraslado" readonly>
    </div>

    <div>
      <label for="" class="form-label">Sub Total</label>
      <input type="text" v-model="datos.subTotal" class="form-control mt-2 ">
    </div>

    <div>
      <label for="" class="form-label">Total</label>
      <input type="text" v-model="datos.total" class="form-control mt-2">
    </div>


    <!-- <div>
      <label for="" class="form-label">Partida</label>
      <select name="" v-model="id_partida" class="form-control">
        <option value="" selected>Seleciona una partida</option>
        <option v-for="row in partidas" :value="row.id">@{{row.codigo}} : @{{row.nombre}}</option>
      </select>
    </div> -->

    <div>
      <label for="" class="form-label">Descripción</label>
      <input type="text" class="form-control" placeholder="Descripción" v-model="descripcion">
    </div>
    </div>
  <div class="gup-ino">
  
    <div class="mt-2 mb-2">
        <table class="table table-bordered table-responsive">
          <thead>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>IVA</th>
            <th>Importe</th>
            <th>Partida</th>
          </thead>
          <tbody>
            <tr v-for="(row, index) in conceptos">
              <td>@{{row.descripcion}}</td>
              <td>@{{row.cantidad}}</td>
              <td>@{{row.precioUnitario}}</td>
              <td>@{{row.iva}}</td>
              <td>@{{row.importe}}</td>
              <td>
              <select name="" class="form-control" @change="updatePartida(index, $event.target.value)" >
                <option value="" selected>Seleciona una partida</option>
                <option v-for="row in partidas" :value="row.id">@{{row.codigo}} : @{{row.nombre}}</option>
              </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
  
    </div>
    <button @click="saveConcentrado()" class="btn-modal">Guardar</button>

</div>
@endsection
@push('scripts')
<script src="js/apis/concentrado.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>


@endpush
<input type="hidden" name="route" value="{{ url('/') }}">