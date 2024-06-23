function init() {
    var ruta = document.querySelector("[name=route]").value;
    var apiConcentrado = ruta + "/apiConcentrado";
    var apiPartida = ruta + "/apiPartida";
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
            conceptosPartidas: [],
            conceptos: [],
            xmlData: null,
            datosNecesarios: "",
            datos: {
                fecha: "",
                subTotal: "",
                total: "",
                rfcEmisor: "",
                razon_socialEmisor: "",
                regimenFiscalEmisor: "",
                rfcReceptor: "",
                razon_socialReceptor: "",
                regimenFiscalReceptor: "",
                producto: "",
                importe: "",
                impuestoTraslado: "",
                impuestoRetenido: "",
            },
            id_partida: "",
            descripcion: "",
        },
        created: function () {
            this.getConcentrados();
            this.getPartida();
        },

        methods: {
            getConcentrados: function () {
                this.$http.get(apiConcentrado).then(function (json) {
                    this.concentrados = json.data;
                });
            },

            getPartida: function () {
                this.$http
                    .get(apiPartida)
                    .then(function (json) {
                        this.partidas = json.data;
                        let partialPartida = {
                            id: json.data.id,
                            nombre: json.data.nombre,
                            codigo: json.data.codigo,
                        };
                        this.conceptosPartidas.push(partialPartida);
                    })
                    .catch(function (json) {
                        console.log(json);
                    });
            },

            leerArchivoXML2: function () {
                const fileInput = document.getElementById("xmlFile");
                const file = fileInput.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = (event) => {
                        const contenidoXML = event.target.result;

                        const parser = new DOMParser();
                        const xmlDoc = parser.parseFromString(
                            contenidoXML,
                            "text/xml"
                        );

                        // Acceder a los datos específicos del XML
                        const datos = this.obtenerDatosXML(xmlDoc);

                        // Asignar datos al estado del componente
                        this.datos = datos;
                    };

                    reader.readAsText(file);
                }
            },

            obtenerDatosXML(xmlDoc) {
                // Elementos del comprobante
                const comporbanteElement =
                    xmlDoc.getElementsByTagName("cfdi:Comprobante")[0];
                const fecha = comporbanteElement.getAttribute("Fecha");
                const subTotal = comporbanteElement.getAttribute("SubTotal");
                const total = comporbanteElement.getAttribute("Total");
                // Elementos del Emisor
                const emisorElement =
                    xmlDoc.getElementsByTagName("cfdi:Emisor")[0];
                const rfcEmisor = emisorElement.getAttribute("Rfc");
                const razon_socialEmisor = emisorElement.getAttribute("Nombre");
                const regimenFiscalEmisor =
                    emisorElement.getAttribute("RegimenFiscal");
                // Elementos del Receptor
                const receptorElement =
                    xmlDoc.getElementsByTagName("cfdi:Receptor")[0];
                const rfcReceptor = receptorElement.getAttribute("Rfc");
                const razon_socialReceptor =
                    receptorElement.getAttribute("Nombre");
                const regimenFiscalReceptor = receptorElement.getAttribute(
                    "RegimenFiscalReceptor"
                );
                // Elementos del Concepto
                const conceptoElement =
                    xmlDoc.getElementsByTagName("cfdi:Concepto")[0];
                const producto = conceptoElement.getAttribute("Descripcion");
                const importe = conceptoElement.getAttribute("Importe");
                const impuestoElements =
                    xmlDoc.getElementsByTagName("cfdi:Impuestos");
                let impuestoTraslado = null;
                let impuestoRetenido = null;
                for (let i = 0; i < impuestoElements.length; i++) {
                    const impuestoElement = impuestoElements[i];
                    const impuestoTrasladoValue = impuestoElement.getAttribute(
                        "TotalImpuestosTrasladados"
                    );
                    const impuestoRetenidoValue = impuestoElement.getAttribute(
                        "TotalImpuestosRetenidos"
                    );

                    if (impuestoTrasladoValue !== null) {
                        // Se encontró un elemento con TotalImpuestosTrasladados, realizar la lógica correspondiente
                        impuestoTraslado = impuestoTrasladoValue;
                        impuestoRetenido = impuestoRetenidoValue;
                        break;
                    }
                }

                const conceptos = xmlDoc.getElementsByTagName("cfdi:Concepto");
                //Itero sobre cada Concepto
                for (let i = 0; i < conceptos.length; i++) {
                    const concepto = conceptos[i];
                    const descripcion = concepto.getAttribute("Descripcion");
                    const cantidad = parseInt(
                        concepto.getAttribute("Cantidad")
                    );
                    const precioUnitario = parseFloat(
                        concepto.getAttribute("ValorUnitario")
                    );
                    console.log(
                        `Concepto ${
                            i + 1
                        }: Descripcion: ${descripcion}, Cantidad: ${cantidad}, Precio Unitario: ${precioUnitario}`
                    );
                    let base;
                    let importe;
                    // Obtener los elementos dentro de <cfdi:Impuestos> y <cfdi:Traslados>
                    const impuestos =
                        concepto.getElementsByTagName("cfdi:Impuestos")[0];
                    if (impuestos) {
                        const traslados =
                            impuestos.getElementsByTagName("cfdi:Traslados")[0];
                        if (traslados) {
                            // Obtener la Base e Importe de los Traslados
                            base = parseFloat(
                                traslados
                                    .getElementsByTagName("cfdi:Traslado")[0]
                                    .getAttribute("Base")
                            );
                            importe = parseFloat(
                                traslados
                                    .getElementsByTagName("cfdi:Traslado")[0]
                                    .getAttribute("Importe")
                            );
                        }
                    }
                    let dataConcepto = {
                        descripcion: descripcion,
                        cantidad: cantidad,
                        precioUnitario: precioUnitario,
                        iva: importe,
                        importe: base,
                    };
                    this.conceptos.push(dataConcepto);
                }

                // Asignamos a cada input el valor traido por el xmnl
                // Asignamos los valores a los campos de entrada

                return {
                    fecha: fecha,
                    subTotal: subTotal,
                    total: total,
                    rfcEmisor: rfcEmisor,
                    razon_socialEmisor: razon_socialEmisor,
                    regimenFiscalEmisor: regimenFiscalEmisor,
                    rfcReceptor: rfcReceptor,
                    razon_socialReceptor: razon_socialReceptor,
                    regimenFiscalReceptor: regimenFiscalReceptor,
                    producto: producto,
                    importe: importe,
                    impuestoTraslado: impuestoTraslado,
                    impuestoRetenido: impuestoRetenido,
                };
            },

            updatePartida(index, value) {
                this.conceptos[index].partida = value;
            },

            saveConcentrado: function () {
                const egresos = [];
                const detalleConcentrado = [];

                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, "0");
                const day = String(today.getDate()).padStart(2, "0");

                const formattedDate = `${year}-${month}-${day}`;

                egresos.push({
                    id_partida: this.id_partida,
                    total: this.datos.total,
                    fecha: formattedDate,
                });

                this.conceptos.forEach((concepto) => {
                    detalleConcentrado.push({
                        descripcion: concepto.descripcion,
                        cantidad: concepto.cantidad,
                        precioUnitario: concepto.precioUnitario,
                        iva: concepto.iva,
                        importe: concepto.importe,
                        fecha: formattedDate,
                        partida: parseInt(concepto.partida),
                    });
                });
                const data = {
                    id_partida: this.id_partida,
                    fecha: this.datos.fecha,
                    razon_social_emisor: this.datos.razon_socialEmisor,
                    razon_social_receptor: this.datos.razon_socialReceptor,
                    rfc_emisor: this.datos.rfcEmisor,
                    rfc_receptor: this.datos.rfcReceptor,
                    regimen_emisor: this.datos.regimenFiscalEmisor,
                    regimen_receptor: this.datos.regimenFiscalReceptor,
                    total: this.datos.total,
                    sub_total: this.datos.subTotal,
                    impuesto_traslado: this.datos.impuestoTraslado,
                    impuesto_retenido: this.datos.impuestoRetenido,
                    productos: this.datos.producto,
                    descripcion: this.descripcion,
                    egresos: egresos,
                    detalleConcentrado: detalleConcentrado,
                };

                console.log(data);

                if (
                    !this.descripcion ||
                    !this.conceptosPartidas.some((partida) => !partida)
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                } else {
                    this.$http.post(apiConcentrado, data).then(function (json) {
                        this.getConcentrados();
                        (this.id_partida = ""),
                            (this.descripcion = ""),
                            (this.conceptos = []),
                            (this.datos = "");

                        Swal.fire({
                            icon: "success",
                            title: "GENIAL",
                            text: "Se agrego el concentrado con éxito!",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    });
                }
            },
        },
    });
}
window.onload = init;
