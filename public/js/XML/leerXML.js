
let ruta = document.querySelector("[name=route]").value;
const baseURL=ruta+"/apiConcentrado";

 function saveXml(){
  let concentrado={};
  let egresos=[];
          
          concentrado.fecha.getElementById('fecha').value;
          concentrado.subTotal.getElementById('subTotal').value;
          concentrado.total.getElementById('total').value;
          concentrado.rfcReceptor.getElementById('rfcReceptor');
          concentrado.razon_socialReceptor.getElementById('razon_socialReceptor');
          concentrado.regimenFiscalReceptor.getElementById('regimenFiscalReceptor').value;
          concentrado.rfcEmisor.getElementById('rfcEmisor');
          concentrado.razon_socialEmisor.getElementById('razon_socialEmisor');
          concentrado.regimenFiscalEmisor.getElementById('regimenFiscalEmisor').value;
          concentrado.producto.getElementById('producto');
          concentrado.impuestoTraslado.getElementById('impuestoTraslado').value;
          concentrado.impuestoRetenido.getElementById('impuestoRetenido').value;
          concentrado.impuestoRetenido.getElementById('impuestoRetenido').value;
          
          // nuevoConcentrado = {}
          console.log();
          console.log(concentrado);


  // const request = await fetch('/apiConcentrado',{
  //   method: 'POST',
  //   headers: {
  //   'Accept': 'application/json',
  //   'Content-Type': 'application/json'
  //   },
  //   body: JSON.stringify(concentrado)
  //   });
    // alert("La cuenta se creo con exito!");
    //  window.location.href="login.html";
}

const save = document.getElementById("guardar");

save.addEventListener("click", ()=>{
  let concentrado={};
  let egresos=[];
          
          concentrado.fecha.getElementById('fecha').value;
          concentrado.subTotal.getElementById('subTotal').value;
          concentrado.total.getElementById('total').value;
          concentrado.rfcReceptor.getElementById('rfcReceptor');
          concentrado.razon_socialReceptor.getElementById('razon_socialReceptor');
          concentrado.regimenFiscalReceptor.getElementById('regimenFiscalReceptor').value;
          concentrado.rfcEmisor.getElementById('rfcEmisor');
          concentrado.razon_socialEmisor.getElementById('razon_socialEmisor');
          concentrado.regimenFiscalEmisor.getElementById('regimenFiscalEmisor').value;
          concentrado.producto.getElementById('producto');
          concentrado.impuestoTraslado.getElementById('impuestoTraslado').value;
          concentrado.impuestoRetenido.getElementById('impuestoRetenido').value;
          concentrado.impuestoRetenido.getElementById('impuestoRetenido').value;
          
          // nuevoConcentrado = {}
          console.log();
          console.log(concentrado);
});



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
  
