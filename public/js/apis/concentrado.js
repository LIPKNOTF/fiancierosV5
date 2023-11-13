function init() {
    var ruta = document.querySelector("[name=route]").value;
    Vue.component("v-select", VueSelect.VueSelect);
    var apiConcentrado = ruta + "/apiConcentrado";
    var apiPartida = ruta + "/apiPartida"
    new Vue({
        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el: "#concentrado2",
        data: {
            concentrados: [],
            partidas: [],
            xmlData: null,
            datosNecesarios: '',
            

        },
        created: function () {
            this.getConcentrados();
            this.getPartida();
        },

        methods: {
            getConcentrados: function () {
                this.$http.get(apiConcentrado).then(function (json) {
                    this.concentrados = json.data;
                }).catch(function (json) {
                    console.log(json);
                });
            },

            getPartida: function () {
                this.$http.get(apiPartida).then(function (json) {
                    this.partidas = json.data;
                }).catch(function (json) {
                    console.log(json);
                });
            },

            leerArchivoXML(event) {
                const datos={};
                const archivo = event.target.files[0];
              
                if (archivo) {
                  const reader = new FileReader();
              
                  reader.onload = () => {
                    const parser = new DOMParser();
                    const xmlDoc = parser.parseFromString(reader.result, 'text/xml');
              
                    var comporbanteElement = xmlDoc.querySelector('cfdi:Comprobante')[0];
        var fecha = comporbanteElement.getAttribute('Fecha');
        var subTotal = comporbanteElement.getAttribute('SubTotal');
        var total = comporbanteElement.getAttribute('Total');
        // obtengo los datos requeridos del emisor
        var emisorElement = xmlDoc.querySelector('cfdi:Emisor')[0];
        var rfcEmisor = emisorElement.getAttribute('Rfc');
        var razon_socialEmisor = emisorElement.getAttribute('Nombre');
        var regimenFiscalEmisor = emisorElement.getAttribute('RegimenFiscal');
        // obtengo los datos requeridos del receptor 
        var receptorElement = xmlDoc.querySelector('cfdi:Receptor')[0];
        var rfcReceptor = receptorElement.getAttribute('Rfc');
        var razon_socialReceptor = receptorElement.getAttribute('Nombre');
        var regimenFiscalReceptor = receptorElement.getAttribute('RegimenFiscalReceptor');
        // obtenemos los datos del concepto 
        var conceptoElement = xmlDoc.querySelector('cfdi:Concepto')[0];
        var producto = conceptoElement.getAttribute('Descripcion');
        var importe = conceptoElement.getAttribute('Importe');
        // 
        var impuestoElements = xmlDoc.querySelector('cfdi:Impuestos');
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
              
                    
              
                    // Puedes hacer más cosas con estos valores si es necesario
                  };
              
                  reader.readAsText(archivo);
                }
              },
              
              enviarDatos() {
                // Aquí puedes enviar this.datosNecesarios a tu base de datos
                // y realizar otras operaciones necesarias
                console.log('Datos enviados:', this.datosNecesarios);
              },
            }


            




        
    });
    // fin de vue
}
window.onload = init;    