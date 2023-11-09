@extends('layouts.app')
@section('titulo','alumnos')
@section('content')

<div class="container-fluid">
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
</div>
  </div>
</div>
@endsection
@push('scripts')
<script src="js/XML/leerXML.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<!-- Script para leer xml -->
<script>
  document.getElementById('xmlForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var fileInput = document.getElementById('xmlFile');
    var file = fileInput.files[0];

    if (file) {
      var reader = new FileReader();

      reader.onload = function(event) {
        var contenidoXML = event.target.result;

        var parser = new DOMParser();
        var xmlDoc = parser.parseFromString(contenidoXML, 'text/xml');

        // obtenemos loa valores del xml 
        // obntengo el valor fecha
        var comporbanteElement = xmlDoc.getElementsByTagName('cfdi:Comprobante')[0];
        var fecha = comporbanteElement.getAttribute('Fecha');
        var subTotal = comporbanteElement.getAttribute('SubTotal');
        var total = comporbanteElement.getAttribute('Total');
        // obtengo los datos requeridos del emisor
        var emisorElement = xmlDoc.getElementsByTagName('cfdi:Emisor')[0];
        var rfcEmisor = emisorElement.getAttribute('Rfc');
        var razon_socialEmisor = emisorElement.getAttribute('Nombre');
        var regimenFiscalEmisor = emisorElement.getAttribute('RegimenFiscal');
        // obtengo los datos requeridos del receptor 
        var receptorElement = xmlDoc.getElementsByTagName('cfdi:Receptor')[0];
        var rfcReceptor = receptorElement.getAttribute('Rfc');
        var razon_socialReceptor = receptorElement.getAttribute('Nombre');
        var regimenFiscalReceptor = receptorElement.getAttribute('RegimenFiscalReceptor');
        // obtenemos los datos del concepto 
        var conceptoElement = xmlDoc.getElementsByTagName('cfdi:Concepto')[0];
        var producto = conceptoElement.getAttribute('Descripcion');
        var importe = conceptoElement.getAttribute('Importe');
        // 
        var impuestoElements = xmlDoc.getElementsByTagName('cfdi:Impuestos');
        var impuestoElement;
        var impuestoElement2;
        var impuestoTraslado;
        var impuestoRetenido;

        for (var i = 0; i < impuestoElements.length; i++) {
          var impuestoElement = impuestoElements[i];
          var impuestoTraslado = impuestoElement.getAttribute('TotalImpuestosTrasladados');
          var impuestoRetenido = impuestoElement.getAttribute('TotalImpuestosRetenidos');

          if (impuestoTraslado !== null) {
            // Se encontró un elemento con TotalImpuestosTrasladados, realizar la lógica correspondiente
            var impuestoTraslado = impuestoElement.getAttribute('TotalImpuestosTrasladados');
            var impuestoRetenido = impuestoElement.getAttribute('TotalImpuestosRetenidos');
            break;
          } else {
            // Si no encuentra algun elemento nada mas traera datos vacios
            impuestoElement = null;
            impuestoElement2 = null;
            impuestoTraslado = null;
            impuestoRetenido = null;
          }
        }

        

        if (impuestoElement !== null) {
          
          // Si encuentra almeneos unos de los datos los trae 
          var impuestoTraslado = impuestoElement.getAttribute('TotalImpuestosTrasladados');
          var impuestoRetenido = impuestoElement.getAttribute('TotalImpuestosRetenidos');
        } else {
          
        }
        

        var datos = {
          fecha: fecha,
          subTotal: subTotal,
          total: total,
          rfcReceptor: rfcReceptor,
          razon_socialReceptor: razon_socialReceptor,
          regimenFiscalReceptor: regimenFiscalReceptor,
          rfcEmisor: rfcEmisor,
          razon_socialEmisor: razon_socialEmisor,
          regimenFiscalEmisor: regimenFiscalEmisor,
          producto: producto,
          impuestoTraslado: impuestoTraslado,
          impuestoRetenido: impuestoRetenido,


        };

        console.log(datos);

        // Asignamos los valores a los campos de entrada
        document.getElementById('fecha').value = fecha;
        document.getElementById('subTotal').value = subTotal;
        document.getElementById('total').value = total;
        document.getElementById('rfcReceptor').value = rfcReceptor;
        document.getElementById('razon_socialReceptor').value = razon_socialReceptor;
        document.getElementById('regimenFiscalReceptor').value = regimenFiscalReceptor;
        document.getElementById('rfcEmisor').value = rfcEmisor;
        document.getElementById('razon_socialEmisor').value = razon_socialEmisor;
        document.getElementById('regimenFiscalEmisor').value = regimenFiscalEmisor;
        document.getElementById('producto').value = producto;
        document.getElementById('impuestoTraslado').value = impuestoTraslado;
        document.getElementById('impuestoRetenido').value = impuestoRetenido;





      };

      reader.readAsText(file);
    }
  });
  
</script>
<!-- Fin -->
@endpush