function init() {
    var ruta = document.querySelector("[name=route]").value;
    Vue.component("v-select", VueSelect.VueSelect);
    var apiPagoPreins = ruta + "/apiPagoPreincsripcion";
    var apiPreins = ruta + "/apiAlumno";
    var apiServicio = ruta + "/apiServicio";

    new Vue({
        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el: "#apiPagoPreinscripcion",

        data: {
            guardar: true,
            pagos_preinscripcion: [],
            preinscritos: [],
            servicios: [],
            id: "",
            id_folio: "",
            id_servicio: "",
            fecha_pago: "",
            fecha_inicio: "",
            fecha_final: "",
        },

        // trae los productos al iniciar la pagina
        created: function () {
            this.obtenerPagosPre();
            this.obtenerPreinscritos();
            this.obtenerServicios();
        },

        // inicio de methods
        methods: {
            // funcion para obtener los pagos por preinscripcion
            obtenerPagosPre: function () {
                this.$http.get(apiPagoPreins).then(function (json) {
                    this.pagos_preinscripcion = json.data;
                    this.dataPagPre();
                });
            },
            // din de la funcion para obtener los pagos por preinscripcion

            // funcion para limpiar campos de filtro fechas
            limpiar: function () {
                this.fecha_inicio = "";
                this.fecha_final = "";
            },
            // fin de la funcion limpar campo filtro fechas

            // funcion para el complemento de dataTables
            dataPagPre() {
                $("#dataPagoPre").DataTable().destroy();
                this.$nextTick(() => {
                    $("#dataPagoPre").DataTable({
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
                        },
                        // centrar encabezados de la tabla
                        // columnDefs: [
                        //     { className: "dt-center", targets: "_all" },
                        // ],
                        // fin de centrar
                        pagingType: "full_numbers",
                        // pageLength: 5,
                        processing: true,
                        dom: "Bfrtip",
                        buttons: [
                            {
                               
                                text: '<i class="fa-regular fa-file-excel"></i>',
                                titleAttr: "Exportar a Excel",
                                className: "btn btn-outline-info",
                                exportOptions: {
                                    modifier: {
                                        page: "current",
                                    },
                                },
                            },
                        ],
                        dom:
                            "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
                    });
                });
            },
            // fin de la funcion para el complemento de dataTables

            // funcion para obtener los alumnos preinscritos
            obtenerPreinscritos: function () {
                this.$http.get(apiPreins).then(function (json) {
                    this.preinscritos = json.data;
                });
            },
            // fin de la funcion para obtener los alumnos preinscritos
            // funcion para obtener los servicios
            obtenerServicios: function () {
                this.$http.get(apiServicio).then(function (json) {
                    this.servicios = json.data;
                });
            },
            // fin de la funcion para obtener los servicios
            modalPagos: function () {
                this.guardar = true;
                this.id_folio = "";
                this.id_servicio = "";
                this.fecha_pago = "";
                $("#modalPagoPreinscripcion").modal("show");
            },
            // funcion para guardar los pagos por preinscripcion
            guardarPago: function (event) {
                let usuarioSimilar = [];
                this.pagos_preinscripcion.forEach((pagos_preinscripcion) => {
                    if (pagos_preinscripcion.id_folio == this.id_folio) {
                        usuarioSimilar.push(pagos_preinscripcion);
                    }
                });
                if (usuarioSimilar != "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text:
                            "El alumno con FOLIO  " +
                            usuarioSimilar[0].id_folio +
                            " y CURP " +
                            usuarioSimilar[0].preinscritos.curp +
                            " ya se encuentra preinscrito",
                        showConfirmButton: false,
                        timer: 7400,
                    });
                    console.log(usuarioSimilar);
                } else {
                    let pagos = {
                        id_folio: this.id_folio,
                        id_servicio: this.id_servicio,
                        fecha_pago: this.fecha_pago,
                    };
                    // validaciones de campos

                    if (this.id_folio == "") {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "El campo de folio se encuentra vacio!",
                            showConfirmButton: false,
                            timer: 2400,
                        });
                        event.preventDefault();
                    }
                    if (this.id_servicio == "") {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "El campo de servicio se encuentra vacio!",
                            showConfirmButton: false,
                            timer: 2400,
                        });
                        event.preventDefault();
                    }
                    if (this.fecha_pago == "") {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "El campo de fecha se encuentra vacio!",
                            showConfirmButton: false,
                            timer: 2400,
                        });
                        event.preventDefault();
                    } else {
                        // fin de la validaciones de campos

                        this.$http
                            .post(apiPagoPreins, pagos)
                            .then(function (json) {
                                this.obtenerPagosPre();
                                this.id_folio = "";
                                this.id_servicio = "";
                                Swal.fire({
                                    icon: "success",
                                    title: "GENIAL",
                                    text: "El pago se guardo con éxito!",
                                    showConfirmButton: false,
                                    timer: 1800,
                                });
                            });
                    }
                }
            },
            // fin de la funcion para guardar los pagos por preinscripcion
            // funcion para borrar los pagos por preinscripcion
            borrarPago: function (id) {
                Swal.fire({
                    title: "¿Estas segur@?",
                    text: "No puedes revertir este cambio!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, elimínalo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            "Eliminado!",
                            "El pago ha sido eliminado.",
                            "success"
                        );
                        this.$http
                            .delete(apiPagoPreins + "/" + id)
                            .then(function (json) {
                                this.obtenerPagosPre();
                            });
                    }
                });
            },
            // fin de la funcion para borrar los pagos por preinscripcion
        },
        // fin de methods

        // inicio de computed
        computed: {
            // computed para filtrar por rango de fechas
            filtroFechas: function () {
                return this.pagos_preinscripcion.filter((pagos) => {
                    if (this.fecha_final != "") {
                        return (
                            pagos.fecha_pago >= this.fecha_inicio &&
                            pagos.fecha_pago <= this.fecha_final
                        );
                    } else {
                        return pagos;
                    }
                });
            },
            // fin del computed para filtrar por rango de fechas

            filtroServicios: function () {
                return this.servicios.filter((ser) => {
                    return ser.servicio == "Preinscripcion";
                });
            },
            // fin del computed para filtrar por servicio
        },
        // fin de computed
    });
}
window.onload = init;






eliminarConsulta: function(id, concepto, folio){
    Swal.fire({
        title: 'Se perderan todos lo realacionado con el concepto: ' +concepto+" y el folio " + folio + '?',
        icon:'warning', showCancelButton:true,
        confirmButtonColor: '#d33',
        confirmButtonText: '<i class="fa-solid fa-check"></i>SI, Eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> CANCELAR'
    }).then((result)=>{
      if(result.isConfirmed){
        Swal.fire({
          title: "Eliminado!",
          text: "La consulta ha sido eliminado con éxito.",
          icon: "success",
          timer: 1000,
          showConfirmButton: false,
        });
      this.$http.delete(apiCon + "/" + id).then(function(json){
        this.obtenerConsulta();
      })
      }
    })

  },
  convertirMayusculas() {
    this.importe = this.importe.toUpperCase();
    this.clave = this.clave.toUpperCase();
    this.cantidad = this.cantidad.toUpperCase();
    this.cuota = this.cuota.toUpperCase();
    this.fecha = this.fecha.toUpperCase();
    this.folio = this.folio.toUpperCase();
    this.concepto = this.concepto.toUpperCase();
  },
