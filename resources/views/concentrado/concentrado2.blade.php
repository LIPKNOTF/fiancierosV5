@extends('layouts.app')
@section('titulo','alumnos')
@section('content')
<div id="concentrado2">
<div>
    <input type="file" @change="leerArchivoXML">
    
    <div v-if="xmlData">
      <!-- Muestra los datos XML como desees -->
      @{{ xmlData }}
    </div>

    <input v-model="datosNecesarios" placeholder="Datos necesarios para la base de datos">
    
    <button @click="enviarDatos">Enviar a la base de datos</button>
  </div>
</div>

<!-- <div class="container-fluid">
  <div class="card">
    <div class="card-body">

    
<form id="xmlForm">
  <div class="row mb-2">
    <div class="col-md-3 "></div>
    <div class="col-md-6 mb-2 ">
    <label for="xmlFile" class="form-label">Ingrese su archivo XML</label>
    <input class="form-control" name="archivo" type="file" id="xmlFile" accept=".xml">
    </div>
    <div class="col-md-4 offset-md-4">
      <div class="d-grid mx-auto">
        <button type="submit" class="btn btn-primary">Cargar Archivo</button>
      </div>
    </div>
  </div>
</form>



 
  <div class="row">
  <div class="col-md-2"></div>
    <div class="col-md-4 m-3 ">
      <label for="" class="form-label">Fecha</label>
      <input type="text" name="fecha" id="fecha" class="form-control mt-2" readonly>
      
    </div>


    <div class="col-md-4 m-3">
      <label for="" class="form-label">Receptor: RFC</label>
      <input type="text" name="rfc_receptor" id="rfcReceptor" class="form-control mt-2" readonly>
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-4 m-3 reponsive">
      <label for="" class="form-label">Receptor: Razon Social</label>
      <input type="text" name="razon_social_receptor" id="razon_socialReceptor" class="form-control mt-2" readonly>
    </div>

    <div class="col-md-4 m-3">
      <label for="" class="form-label">Receptor: Regimen Fiscal</label>
      <input type="text" name="regimen_receptor" id="regimenFiscalReceptor" class="form-control mt-2" readonly>
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-4 m-3">
      <label for="" class="form-label">Emisor: RFC</label>
      <input type="text" name="rfc_emisor" id="rfcEmisor" class="form-control mt-2" readonly>
    </div>


    <div class="col-md-4 m-3">
      <label for="" class="form-label">Emisor: Razon Social</label>
      <input type="text" name="razon_social_emisor" id="razon_socialEmisor" class="form-control mt-2" readonly>
    </div>


    <div class="col-md-2"></div>
    <div class="col-md-4 m-3">
      <label for="" class="form-label">Emisor: Regimen Fiscal</label>
      <input type="text" name="regimen_emisor" id="regimenFiscalEmisor" class="form-control mt-2" readonly>
    </div>

    <div class="col-md-4 m-3 reponsive">
      <label for="" class="form-label">Producto</label>
      <input type="text" name="productos" id="producto" class="form-control mt-2" readonly>
    </div>



    <div class="col-md-2"></div>
    <div class="col-md-4 m-3">
      <label for="" class="form-label">Impuesto de Retenido</label>
      <input type="text" name="impuesto_retenido" id="impuestoRetenido" class="form-control mt-2"id="impuestoRetenido">
    </div>
    

    <div class="col-md-4 m-3">
      <label for="" class="form-label">Impuesto de Traslado</label>
      <input type="text" name="impuesto_traslado" id="impuestoTraslado" class="form-control mt-2" id="impuestoTraslado" readonly>
    </div>
    


    <div class="col-md-2"></div>
    <div class="col-md-4 m-3 ">
      <label for="" class="form-label">Sub Total</label>
      <input type="text" name="sub_total" id="subTotal" class="form-control mt-2" readonly>
    </div>

    <div class="col-md-4 m-3 ">
      <label for="" class="form-label">Total</label>
      <input type="text" name="total" id="total" class="form-control mt-2" readonly>
    </div>



    <div class="col-md-2"></div>
    <div class="col-md-4 m-3 ">
      <label for="" class="form-label">Descripcion</label>
      <input type="text" name="descripcion" class="form-control mt-2" readonly>
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-4 ">
    <Select class="form-control">
        <option value="Hola">Hola</option>
    </Select>
    </div>
    

    <div class="col-md-4 offset-md-4">
        <div class="d-grid mx-auto">
            <button id="guardar" class="btn btn-primary">Enviar</button>
        </div>
    </div>
    

    
    

  </div>
  <!-- aqui pondre el div -->
<!-- </form> -->
<!-- </div>
  </div>
</div> --> 
@endsection
@push('scripts')
<script src="js/concentrado.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>


@endpush