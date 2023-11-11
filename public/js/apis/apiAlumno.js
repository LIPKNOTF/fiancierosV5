function init() {
    var ruta = document.querySelector("[name=route]").value;
    Vue.component("v-select", VueSelect.VueSelect);
    var apiAlum = ruta + "/apiAlumno";
    var apiCon = ruta + "/apiConsulta";
    var apiClav = ruta + "/apiClave";

    new Vue({
        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el: "#apiAlumno",
        data: {
            alumnos: [],
            consultas: [],
            claves_p: [],
            claveConsulta: [],
            cantidades: [],
            cuotasObtenidas: [],
            id: "",
            matricula: "",
            nombres: "",
            apellido_p: "",
            apellido_m: "",
            grado: "",
            grupo: "",
            carrera: "",
            turno: "",
            id: "",
            id_alumno: "",
            importe: "",
            clave: "",
            cantidad: 1,
            cuota: "",
            fecha: "",
            folio: "",
            concepto: "",
            total: "",
            agregando: "true",
            id_clave: "",
            auxSubTotal: "",
            cantidad: "",
        },

        created: function () {
            this.obtenerAlumno();
            this.obtenerConsulta();
            this.obtenerClave_p();
            this.makeFolio();
        },

        methods: {
            obtenerConsulta: function () {
                this.$http.get(apiCon).then(function (json) {
                    this.consultas = json.data;
                });
            },
            obtenerClave_p: function () {
                this.$http.get(apiClav).then(function (json) {
                    this.claves_p = json.data;
                });
            },
            // fin de la funcion para el complemento de dataTables
            //METODO PARA CONVERTIR EN MAYUSCULAS.
            convertirMayusculas() {
                this.matricula = this.matricula.toUpperCase();
                this.nombres = this.nombres.toUpperCase();
                this.apellido_p = this.apellido_p.toUpperCase();
                this.apellido_m = this.apellido_m.toUpperCase();
                this.grado = this.grado.toUpperCase();
                this.grupo = this.grupo.toUpperCase();
                this.carrera = this.carrera.toUpperCase();
                this.turno = this.turno.toUpperCase();
            },
            //FIN METODO PARA CONVERTIR EN MAYUSCULAS.
            //OBTIENER TODOS LOS ALUMNOS
            obtenerAlumno: function () {
                this.$http.get(apiAlum).then(function (json) {
                    this.alumnos = json.data;
                    this.dataAlumno();
                });
            },

            // EMPIEZA DATA TABLES
            // dataAlumno() {
            //     $("#myTableAlumnos").DataTable().destroy();
            //     this.$nextTick(() => {
            //         $("#myTableAlumnos").DataTable({
            //           initComplete: function () {
            //             this.api()
            //                 .columns()
            //                 .every(function (index) {
            //                     var column = this;
            //                     var header = $(column.header());
            //                     if (header.hasClass("actions")) {
            //                         // No hacer nada si es la columna de acciones
            //                         return;
            //                     }
            //                     var input = $(
            //                         '<input type="text" class="text-center form-control form-control-sm mb-2" placeholder="Filtrar">'
            //                     )
            //                         .appendTo(header)
            //                         .on(
            //                             "keyup change clear",
            //                             function () {
            //                                 if (
            //                                     column.search() !==
            //                                     this.value
            //                                 ) {
            //                                     column
            //                                         .search(this.value)
            //                                         .draw();
            //                                 }
            //                             }
            //                         );
            //                 });
            //         },
            //             language: {
            //                 sProcessing: "Procesando...",
            //                 sLengthMenu: "Mostrar _MENU_ registros",
            //                 sZeroRecords: "No se encontraron resultados",
            //                 sEmptyTable: "Ningún dato disponible en esta tabla",
            //                 sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            //                 sInfoEmpty:
            //                     "Mostrando registros del 0 al 0 de un total de 0 registros",
            //                 sInfoFiltered:
            //                     "(filtrado de un total de _MAX_ registros)",
            //                 sInfoPostFix: "",
            //                 sSearch: "Buscar:",
            //                 sUrl: "",
            //                 sInfoThousands: ",",
            //                 sLoadingRecords: "Cargando...",
            //                 oPaginate: {
            //                     sFirst: "Primero",
            //                     sLast: "Último",
            //                     sNext: "Siguiente",
            //                     sPrevious: "Anterior",
            //                 },
            //                 oAria: {
            //                     sSortAscending:
            //                         ": Activar para ordenar la columna de manera ascendente",
            //                     sSortDescending:
            //                         ": Activar para ordenar la columna de manera descendente",
            //                 },
            //             },
            //             columnDefs: [
            //                 {
            //                     targets: -1,
            //                     className: "actions",
            //                     searchable: false,
            //                 },
            //             ],

            //             pageLength: 5, // Número de registros por página
            //             lengthMenu: [5, 10, 25, 50], // Opciones de número de registros por página
            //         });
            //     });
            // },

            //TERMINA DATABLES

            dataAlumno() {
                $(document).ready(function () {
                    var table = $("#myTableAlumnos");
                    if (!table.hasClass("dataTable")) {
                        table.DataTable({
                            initComplete: function () {
                                this.api()
                                    .columns()
                                    .every(function (index) {
                                        var column = this;
                                        var header = $(column.header());
                                        if (header.hasClass("actions")) {
                                            // No hacer nada si es la columna de acciones
                                            return;
                                        }
                                    });
                            },
                            responsive: {
                                details: {
                                    type: 'inline', // Cambiado de 'column' a 'inline'
                                    target: ':not(:last-child)' // Excluir la última columna
                                }
                            },
                            language: {
                                searchPlaceholder: "Buscar",
                                search: "Buscar:",
                                zeroRecords: "No se encontraron resultados",
                                emptyTable:
                                    "No hay datos disponibles en la tabla",
                                infoEmpty:
                                    "Mostrando 0 registros de un total de 0",
                                infoFiltered:
                                    "(filtrado de un total de MAX registros)",
                                example_info:
                                    "Se muestran 0 de 0 un total de 0",
                                sInfo: "<span style='margin-left: 2rem;'>Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros</span>",
                                lengthMenu: "Mostrar _MENU_",
                                paginate: {
                                    previous: "Anterior",
                                    next: "Siguiente",
                                },
                            },

                            "lengthMenu": [8, 15, 25, 50],
                            "pageLength": 8,
                        });
                    }
                });
            },
            // fin de la funcion para el complemento de dataTables
            mostrarModal: function () {
                this.agregando = true;
                this.id = "";
                this.matricula = "";
                this.nombres = "";
                this.apellido_p = "";
                this.apellido_m = "";
                this.grado = "";
                this.grupo = "";
                this.carrera = "";
                this.turno = "";

                $("#modalAlumno").modal("show");
            },

            agregarAlumno: function () {
                let alumno = {
                    id: this.id,
                    matricula: this.matricula,
                    nombres: this.nombres,
                    apellido_p: this.apellido_p,
                    apellido_m: this.apellido_m,
                    grupo: this.grupo,
                    grado: this.grado,
                    carrera: this.carrera,
                    turno: this.turno,
                };
                if (
                    !this.nombres ||
                    !this.matricula ||
                    !this.apellido_p ||
                    !this.apellido_m ||
                    !this.grupo ||
                    !this.grado ||
                    !this.carrera ||
                    !this.turno
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                } else {
                    this.$http.post(apiAlum, alumno).then(function (json) {
                        this.obtenerAlumno();
                        this.dataAlumno();
                        this.id = "";
                        this.matricula = "";
                        this.nombres = "";
                        this.apellido_p = "";
                        this.apellido_m = "";
                        this.grado = "";
                        this.grupo = "";
                        this.carrera = "";
                        this.turno = "";

                        Swal.fire({
                            icon: "success",
                            title: "¡HECHO!",
                            text: "Se agrego el alumno con exito!",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    });

                    $("#modalAlumno").modal("hide");
                }
            },

            editarAlumno: function (id) {
                this.agregando = false;
                this.id = id;
                this.$http.get(apiAlum + "/" + id).then(function (json) {
                    this.id = json.data.id;
                    this.matricula = json.data.matricula;
                    this.nombres = json.data.nombres;
                    this.apellido_p = json.data.apellido_p;
                    this.apellido_m = json.data.apellido_m;
                    this.grado = json.data.grado;
                    this.grupo = json.data.grupo;
                    this.carrera = json.data.carrera;
                    this.turno = json.data.turno;
                });
                $("#modalAlumno").modal("show");
            },

            mostrarAlumno: function (id) {
                this.id = id;
                this.$http.get(apiAlum + "/" + id).then(function (json) {
                    this.id = json.data.id;
                    this.matricula = json.data.matricula;
                    this.nombres = json.data.nombres;
                    this.apellido_p = json.data.apellido_p;
                    this.apellido_m = json.data.apellido_m;

                    $("#modalConsulta").modal("show"); // Mostramos el modal dentro de la función anidada
                });
            },

            agregarConsulta: function () {
                let pago = {};
                let detalles = [];

                for (i = 0; i < this.claveConsulta.length; i++) {
                    detalles.push({
                        folio: this.folio,
                        fecha: this.fecha,
                        id_clave: this.claveConsulta[i].id_clave,
                        cantidad: this.claveConsulta[i].cantidad,
                        total: this.claveConsulta[i].total,
                    });

                    pago = {
                        id_alumno: this.id,
                        folio: this.folio,
                        fecha: this.fecha,
                        total: this.subTotal,
                        cantidad: this.numeroArticulos,
                        id_clave: this.id_clave,
                        detalles: detalles,
                    };
                }

                if (!this.fecha) {
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

            // updatePrice(){
            //     // const cant = this.cantidades.map((item) => item.cantidad)
            //     // console.log(cant)
            //     const cuota = this.claveConsulta.map((item) => item.cuota)

            //         console.log(cuota)

            //        const contidad = cuota * this.cantidad;
            //        this.importe = contidad;
            // },

            removeItem: function (id) {
                this.claveConsulta.splice(id, 1);
            },

            makeFolio: function () {
                this.folio = "DGETAYCM " + moment().format("7949993") + 1;
            },

            findClave: function () {
                let encontrado = 0;
                if (this.id_clave) {
                    for (let i = 0; i < this.claveConsulta.length; i++) {
                        encontrado = 1;
                        this.claveConsulta[i].cantidad++;
                        this.cantidades[i]++;
                        break;
                    }
                    if (encontrado === 0) {
                        var pruebas = {};
                        this.claves_p.forEach((claves) => {
                            if (this.id_clave === claves.id) {
                                pruebas.push(claves);
                                console.log(pruebas);
                            }
                        });
                    }
                    // this.$http.get(apiClav+'/'+this.id_clave).then(function(json){
                    //     consultaClave={
                    //         id_clave:json.data.id_clave,
                    //         cuota:json.data.precio,
                    //         cantidad:1,
                    //         importe:json.data.precio,
                    //     };
                    //     this.claveConsulta.push(consultaClave);
                    //     this.cantidades.push(1);
                    //     this.id_clave='';
                    // });
                }
            },

            actualizarAlumno: function () {
                let alumno = {
                    id: this.id,
                    matricula: this.matricula,
                    nombres: this.nombres,
                    apellido_p: this.apellido_p,
                    apellido_m: this.apellido_m,
                    grupo: this.grupo,
                    grado: this.grado,
                    carrera: this.carrera,
                    turno: this.turno,
                };
                if (
                    !this.nombres ||
                    !this.matricula ||
                    !this.apellido_p ||
                    !this.apellido_m ||
                    !this.grupo ||
                    !this.grado ||
                    !this.carrera ||
                    !this.turno
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                } else {
                    this.$http
                        .patch(apiAlum + "/" + this.id, alumno)
                        .then(function (json) {
                            this.obtenerAlumno();
                            Swal.fire({
                                icon: "success",
                                title: "GENIAL",
                                text: "El sistema educativo se actualizo con éxito!",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#modalAlumno").modal("hide");
                        });
                }
            },

            eliminarAlumno: function (
                id,
                matricula,
                nombres,
                apellido_p,
                apellido_m
            ) {
                Swal.fire({
                    title:
                        "Se perderan todos lo realacionado con el nombre: " +
                        nombres +
                        " " +
                        apellido_p +
                        " " +
                        apellido_m +
                        " y la matricula " +
                        matricula +
                        " ?",
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
                            text: "El alumno ha sido eliminado con éxito.",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                        this.$http
                            .delete(apiAlum + "/" + id)
                            .then(function (json) {
                                this.obtenerAlumno();
                            });
                    }
                });
            },
        },
        // fin de los methods
        computed: {
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
