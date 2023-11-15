@extends('layouts.master')
@section('titulo','Lectura de XML')
@section('content')
<div id="concentrado2">
<div>
    
<div class="row mb-2">
      <div class="col-md-3 "></div>
      <div class="col-md-6 mb-2">
        <label for="xmlFile" class="form-label">Ingrese su archivo XML</label>
        <input class="form-control" name="archivo" type="file" id="xmlFile" accept=".xml">
      </div>
      <div class="col-md-4 offset-md-4">
        <div class="d-grid mx-auto">
          <button @click.prevent="leerArchivoXML2()" class="btn btn-primary">Cargar Archivo</button>
        </div>
      </div>
    </div>
    


    
    <!-- Aqui ira los input en donde se alojaran de lo que se traiga de los xml -->
    <div>
    <div class="row">
  <div class="col-md-2"></div>
    <div class="col-md-4 m-3 ">
      <label for="" class="form-label">Fecha</label>
      <input type="text" v-model="datos.fecha" class="form-control mt-2" disabled>

      
    </div>


    <div class="col-md-4 m-3">
      <label for="" class="form-label">Receptor: RFC</label>
      <input type="text"  v-model="datos.rfcReceptor" class="form-control mt-2" readonly>
      
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-4 m-3 reponsive">
      <label for="" class="form-label">Receptor: Razon Social</label>
      <input type="text"  class="form-control mt-2" v-model="datos.razon_socialReceptor" readonly>
    </div>

    <div class="col-md-4 m-3">
      <label for="" class="form-label">Receptor: Regimen Fiscal</label>
      <input type="text"  class="form-control mt-2" v-model="datos.regimenFiscalReceptor" readonly>
      
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-4 m-3">
      <label for="" class="form-label">Emisor: RFC</label>
      <input type="text"  v-model="datos.rfcEmisor" class="form-control mt-2 " readonly>
      
    </div>


    <div class="col-md-4 m-3">
      <label for="" class="form-label">Emisor: Razon Social</label>
      <input type="text"  class="form-control mt-2" v-model="datos.razon_socialEmisor" readonly>
      
    </div>


    <div class="col-md-2"></div>
    <div class="col-md-4 m-3">
      <label for="" class="form-label">Emisor: Regimen Fiscal</label>
      <input type="text"   class="form-control mt-2" v-model="datos.regimenFiscalEmisor" readonly>
     
    </div>

    <div class="col-md-4 m-3 reponsive">
      <label for="" class="form-label">Producto</label>
      <input type="text"  class="form-control mt-2" v-model="datos.producto" readonly>
      
    </div>



    <div class="col-md-2"></div>
    <div class="col-md-4 m-3">
      <label for="" class="form-label">Impuesto de Retenido</label>
      <input type="text"   class="form-control mt-2" v-model="datos.impuestoRetenido">
    </div>
    

    <div class="col-md-4 m-3">
      <label for="" class="form-label">Impuesto de Traslado</label>
      <input type="text"   class="form-control mt-2 " v-model="datos.impuestoTraslado" readonly>
    </div>
   


    <div class="col-md-2"></div>
    <div class="col-md-4 m-3 ">
      <label for="" class="form-label">Sub Total</label>
      <input type="text"   v-model="datos.subTotal" class="form-control mt-2 ">
      
    </div>

    <div class="col-md-4 m-3 ">
      <label for="" class="form-label">Total</label>
      <input type="text"  v-model="datos.total" class="form-control mt-2">
      
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-4 m-3">
        <label for="" class="form-label">Partida</label>
        <select name="" v-model="id_partida" class="form-control" >
            <option value="" selected>Seleciona una partida</option>
            <option v-for="row in partidas" :value="row.id">@{{row.codigo}} : @{{row.nombre}}</option>
        </select>
    </div>

    <div class="col-md-4 m-3">
        <label for="" class="form-label">Descripción</label>
        <input type="text" class="form-control" placeholder="Descripción" v-model="descripcion">

        
    </div>

    <div class="col-md-4 offset-md-4">
        <div class="d-grid mx-auto">
          <button @click="saveConcentrado()" class="btn btn-primary">Guardar</button>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="js/apis/concentrado.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>


@endpush
<input type="hidden" name="route" value="{{ url('/') }}">