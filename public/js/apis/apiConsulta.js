function init() {
    var ruta = document.querySelector("[name=route]").value;
    Vue.component("v-select", VueSelect.VueSelect);
    var apiCon = ruta + "/apiConsulta";
    var apiAlum = ruta + "/apiAlumno";
    var apiClav = ruta + "/apiClave";

    new Vue({
        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el: "#apiConsulta",
        data: {
            alumnos: [],
            consultas: [],
            claves_p: [],
            claveConsulta: [],
            cantidades: [],
            cuotasObtenidas: [],
            id: "",
            id_alumno: "",
            importe: "",
            cantidad: "",
            cuota: "",
            fecha: "",
            folio: "",
            total: "",
            id_clave: "",
            fecha_i: "",
            fecha_f: "",
            agregando: "true",
            clave: "",
            auxSubTotal: "",
        },
        created: function () {
            // this.makeFolio();
            this.obtenerConsulta();
            this.obtenerAlumno();
            this.obtenerClave_p();
        },
        methods: {
            limpiar: function () {
                this.fecha_i = "";
                this.fecha_f = "";
            },
            //METODO PARA CONVERTIR EN MAYUSCULAS.

            obtenerConsulta: function () {
                this.$http.get(apiCon).then(function (json) {
                    this.consultas = json.data;
                    this.dataPagPre();
                });
            },

            obtenerClave_p: function () {
                this.$http.get(apiClav).then(function (json) {
                    this.claves_p = json.data;
                });
            },

            obtenerAlumno: function () {
                this.$http.get(apiAlum).then(function (json) {
                    this.alumnos = json.data;
                });
            },

            // traer tanto nombre y matricula del alumno
            formatLabel: function (alumno) {
                return "${alumno.matricula} - ${alumno.nombres}";
            },
            // fin de traer el nombre y la matricula

            // funcion para el complemento de dataTables
            dataPagPre() {
                $(document).ready(function () {
                    // Configuración en español
                    $.extend(true, $.fn.dataTable.defaults, {
                        language: {
                            sProcessing: "Procesando...",
                            sLengthMenu: "Mostrar _MENU_ registros",
                            sZeroRecords: "No se encontraron resultados",
                            sEmptyTable: "Ningún dato disponible en esta tabla",
                            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            sInfoEmpty:
                                "Mostrando registros del 0 al 0 de un total de 0 registros",
                            sInfoFiltered:
                                "(filtrado de un total de _MAX_ registros)",
                            sInfoPostFix: "",
                            sSearch: "Buscar:",
                            sUrl: "",
                            sInfoThousands: ",",
                            sLoadingRecords: "Cargando...",
                            oPaginate: {
                                sFirst: "Primero",
                                sLast: "Último",
                                sNext: "Siguiente",
                                sPrevious: "Anterior",
                            },
                            oAria: {
                                sSortAscending:
                                    ": Activar para ordenar la columna de manera ascendente",
                                sSortDescending:
                                    ": Activar para ordenar la columna de manera descendente",
                            },
                        },
                        lengthMenu: [4, 8, 15, 25, 50],
                        pageLength: calculatePageLength(),
                    });

                    // Inicializar el DataTable
                    var dataTable = $("#myTable").DataTable({
                        responsive: true,
                        columnDefs: [
                            {
                                responsivePriority: 1,
                                targets: -1,
                            },
                        ],
                    });

                    // Volver a calcular y actualizar el número de filas al cambiar el tamaño de la ventana
                    $(window).resize(function () {
                        var newPageLength = calculatePageLength();
                        dataTable.page.len(newPageLength).draw();
                    });

                    // Función para calcular el número de filas a mostrar
                    function calculatePageLength() {
                        var screenHeight = window.innerHeight;
                        // Ajusta este valor según tus necesidades
                        var rowsToShow = screenHeight >= 768 ? 8 : 4;
                        return rowsToShow;
                    }
                });
            },
            // fin de la funcion para el complemento de dataTables

            mostrarModal: function () {
                this.agregando = true;
                this.id = "";
                this.id_alumno = "";
                this.importe = "";
                this.cantidad = "";
                this.cuota = "";
                this.fecha = "";
                this.folio = "";
                this.id_clave = "";
                this.total = "";
                $("#modalConsulta").modal("show");
            },


            editarConsulta: function (id) {
                this.agregando = false;
                this.id = id;
                this.$http.get(apiCon + "/" + id).then(function (json) {
                    this.id = json.data.id;
                    this.id_alumno = json.data.id_alumno;
                    this.importe = json.data.importe;
                    this.cantidad = json.data.cantidad;
                    this.cuota = json.data.cuota;
                    this.fecha = json.data.fecha;
                    this.folio = json.data.folio;
                    this.id_clave = json.data.id_clave;
                    this.total = json.data.total;
                });
                $("#modalConsulta").modal("show");
            },

            actualizarConsulta: function () {
                let consultas = {
                    id: this.id,
                    id_alumno: this.id_alumno,
                    importe: this.importe,
                    cantidad: this.cantidad,
                    cuota: this.cuota,
                    fecha: this.fecha,
                    folio: this.folio,
                    id_clave: this.id_clave,
                    total: this.total,
                };

                // Validar que cantidad, importe y cuota sean números
                if (
                    isNaN(this.cantidad) ||
                    isNaN(this.importe) ||
                    isNaN(this.cuota)
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Los campos Cantidad, Importe y Cuota deben ser números",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } else if (
                    !this.id_alumno ||
                    !this.importe ||
                    !this.cantidad ||
                    !this.cuota ||
                    !this.fecha ||
                    !this.folio ||
                    !this.id_clave ||
                    !this.total
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } else {
                    this.$http
                        .patch(apiCon + "/" + this.id, consultas)
                        .then(function (json) {
                            this.obtenerConsulta();
                            Swal.fire({
                                icon: "success",
                                title: "GENIAL",
                                text: "El sistema educativo se actualizo con éxito!",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#modalConsulta").modal("hide");
                        });
                }
            },

            eliminarConsulta: function (id) {
                Swal.fire({
                    title: "Se eliminara el registro ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText:
                        '<i class="fa-solid fa-check"></i>SI, Eliminar',
                    cancelButtonText:
                        '<i class="fa-solid fa-ban"></i> CANCELAR',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Eliminado!",
                            text: "La consulta ha sido eliminado con éxito.",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                        this.$http
                            .delete(apiCon + "/" + id)
                            .then(function (json) {
                                this.obtenerConsulta();
                            });
                    }
                });
            },
            convertirMayusculas() {
                this.importe = this.importe.toUpperCase();
                this.cantidad = this.cantidad.toUpperCase();
                this.cuota = this.cuota.toUpperCase();
                this.fecha = this.fecha.toUpperCase();
                this.folio = this.folio.toUpperCase();
            },

            getClave: function (id) {
                let encontrado = 0;
                if (this.id_clave) {
                    for (let i = 0; i < this.claveConsulta.length; i++) {
                        if (this.id_clave === this.claveConsulta[i].id_clave) {
                            encontrado = 1;
                            this.claveConsulta[i].cantidad++;
                            this.cantidades[i]++;
                            break;
                        }
                    }

                    if (encontrado === 0) {
                        this.$http
                            .get(apiClav + "/" + id)
                            .then(function (json) {
                                this.cuotasObtenidas.push(json.data.precio);

                                let consultaHecha = {
                                    id_clave: json.data.id,
                                    clave: json.data.clave,
                                    cuota: json.data.precio,
                                    cantidad: 1,
                                    total: json.data.precio,
                                };
                                this.claveConsulta.push(consultaHecha);
                                this.cantidades.push(1);
                            });
                    }
                    // __________________________________
                }
            },

            removeItem: function (id) {
                this.claveConsulta.splice(id, 1);
            },

            getLastFolio: function () {

                this.$http('/ultimo-folio').then(
                    response => {
                        let ultimoFolio = response.data;
                        let nuevoFolio = this.createNewFolio(ultimoFolio);
                        this.folio = nuevoFolio;
                        console.log('Nuevo folio: ', this.folio);
                    }).cath(error => {
                        console.error('Error al obtener el ultimo folio: ', error);
                    });
            },

            createNewFolio: function () {
                this.$http("/ultimo-folio")
                    .then((response) => {
                        let ultimoFolio = response.data;
                        let nuevoFolio = this.createNewFolio(ultimoFolio);
                        this.folio = nuevoFolio;
                        console.log("Nuevo folio: ", this.folio);
                    })
                    .cath((error) => {
                        console.error(
                            "Error al obtener el ultimo folio: ",
                            error
                        );
                    });
            },

                

            createNewFolio: function () {},


            agregarConsulta: function () {
                let pago = {};
                let detalles = [];
                let ingresos = [];
                let primerAlumno=null;

                ingresos.push({
                    total: this.subTotal,
                    id_clave: this.id_clave,
                    fecha: this.fecha


                });
                // Se obtiene el primer alumno de los detalles
                for (i = 0; i<this.claveConsulta.length; i++) {
                     primerAlumno = this.claveConsulta[i].id_alumno;
                }

                for (i = 0; i < this.claveConsulta.length; i++) {
                    detalles.push({
                        folio: this.folio,
                        fecha: this.fecha,
                        id_clave: this.claveConsulta[i].id_clave,
                        cantidad: this.claveConsulta[i].cantidad,
                        total: this.claveConsulta[i].total,
                    });

                    pago = {
                        id_alumno: primerAlumno,
                        folio: this.folio,
                        fecha: this.fecha,
                        total: this.subTotal,
                        cantidad: this.numeroArticulos,
                        id_clave: this.id_clave,
                        detalles: detalles,
                        ingresos: ingresos,
                    };
                }

                if ((!this.fecha, !this.folio)) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                } else {
                    // AQUÍ USAS TU RUTA Y TU LET
                    this.$http.post(apiCon, pago).then(function (json) {
                        this.obtenerConsulta();
                        this.id_alumno = "";
                        this.importe = "";
                        this.id_clave = "";
                        this.cantidad = "";
                        this.cuota = "";
                        this.fecha = "";
                        this.folio = "";
                        this.total = "";

                        Swal.fire({
                            icon: "success",
                            title: "GENIAL",
                            text: "Se agrego la consulta con éxito!",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    });
                    $("#modalConsulta").modal("hide");
                }

                console.log(pago);
            },
        },

        computed: {
            filtrarfechas: function () {
                return this.consultas.filter((consu) => {
                    if (this.fecha_f != "") {
                        return (
                            consu.fecha >= this.fecha_i &&
                            consu.fecha <= this.fecha_f
                        );
                    } else {
                        return consu;
                    }
                });
            },

            calcularImporte() {
                return (id) => {
                    let total = 0;
                    total = this.cuotasObtenidas[id] * this.cantidades[id];

                    this.claveConsulta[id].total = total;

                    this.claveConsulta[id].cantidad = this.cantidades[id];

                    this.auxSubTotal = total.toFixed(1);
                    return total.toFixed(1);
                };
            },

            subTotal() {
                let total = 0;
                for (var i = this.claveConsulta.length - 1; i >= 0; i--) {
                    total = total + this.claveConsulta[i].total;
                } //fin ciclo for
                this.auxSubTotal = total.toFixed(1); //manda una copia del subTotal al data para usar con otros datos
                return total.toFixed(1);
            },

            numeroArticulos() {
                var art = 0;
                for (var i = this.claveConsulta.length - 1; i >= 0; i--) {
                    art = art + parseInt(this.claveConsulta[i].cantidad, 10);
                }

                return art;
            },
        },
    });
}
window.onload = init;
