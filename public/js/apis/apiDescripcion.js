function init() {
    var ruta = document.querySelector("[name=route]").value;
    Vue.component("v-select", VueSelect.VueSelect);
    var apides = ruta + "/apiDescripcion";
    var apipar = ruta + "/apiPartida";

    new Vue({
        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el: "#apiDescripcion",
        data: {
            descripcion_partida:[],
            partida:[],
            id: "",
            id_partida: "",
            descripcion: "",
            agregando: "true",
          
        },

        created: function () {
            this.obtenerDescripcion();
            this.obtenerPartida();
        },

        methods: {
            convertirMayusculas() {
                this.id_partida = this.id_partida.toUpperCase();
                this.descripcion = this.descripcion.toUpperCase();
             
            },
            obtenerDescripcion: function () {
                this.$http.get(apides).then(function (json) {
                    this.descripcion_partida = json.data;
                    this.dataDescripcion();
                });
            },

            obtenerPartida: function () {
                this.$http.get(apipar).then(function (json) {
                    this.partida = json.data;
                });
            },

            dataDescripcion() {
                $(document).ready(function () {
                    var table = $("#myTableDescripcion");
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
                                        var input = $(
                                            '<input type="text" class="text-center form-control form-control-sm mb-2" placeholder="Filtrar">'
                                        )
                                            .appendTo(header)
                                            .on(
                                                "keyup change clear",
                                                function () {
                                                    if (
                                                        column.search() !==
                                                        this.value
                                                    ) {
                                                        column
                                                            .search(this.value)
                                                            .draw();
                                                    }
                                                }
                                            );
                                    });
                            },
                            language: {
                                sProcessing: "Procesando...",
                                sLengthMenu: "Mostrar _MENU_ registros",
                                sZeroRecords: "No se encontraron resultados",
                                sEmptyTable:
                                    "Ningún dato disponible en esta tabla",
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
                            columnDefs: [
                                {
                                    targets: -1,
                                    className: "actions",
                                    searchable: false,
                                },
                            ],
  
                            pageLength: 5, // Número de registros por página
                            lengthMenu: [5, 10, 25, 50], // Opciones de número de registros por página
                        });
                    }
                });
            },
            // fin de la funcion para el complemento de dataTables
              mostrarModal: function () {
                  this.agregando = true;
                  this.id = "";
                  this.id_partida = "";
                  this.descripcion = "";
                  
  
                  $("#modalDescripcion").modal("show");
              },

              agregarDescripcion: function () {
                let descripcion = {
                    id: this.id,
                    id_partida: this.id_partida,
                    descripcion: this.descripcion,
               
                };
                if (
                    !this.id_partida ||
                    !this.descripcion
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                } else {
                    this.$http.post(apides, descripcion).then(function (json) {
                        this.obtenerDescripcion();
                        this.id = "";
                        this.id_partida = "";
                        this.descripcion = "";
        

                        Swal.fire({
                            icon: "success",
                            title: "¡HECHO!",
                            text: "Se agrego el alumno con exito!",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    });

                    $("#modalDescripcion").modal("hide");
                }
            },
       
              mostrarDescripcion: function (id) {
                this.agregando = false;
                this.id = id;
                this.$http.get(apides + "/" + id).then(function (json) {
                    this.id = json.data.id;
                    this.id_partida = json.data.id_partida;
                    this.descripcion = json.data.descripcion;
                    $("#modalDescripcion").modal("show"); // Mostramos el modal dentro de la función anidada
                });
            },

              actualizarDescripcion: function () {
                let descripcion = {
                    id: this.id,
                    id_partida: this.id_partida,
                    descripcion: this.descripcion,
                   
                };
                if (
                    !this.id_partida ||
                    !this.descripcion
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
                        .patch(apides + "/" + this.id, descripcion)
                        .then(function (json) {
                            this.obtenerDescripcion();
                            Swal.fire({
                                icon: "success",
                                title: "GENIAL",
                                text: "El sistema educativo se actualizo con éxito!",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#modalDescripcion").modal("hide");
                        });
                }
            },
            eliminarDescripcion: function (
                id,
                codigo,
                nombre
            ) {
                Swal.fire({
                    title:
                        "Se perderan todos lo realacionado con la clave: " +
                        codigo +
                        " Y el nombre: " +
                        nombre +
                        
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
                            .delete(apides + "/" + id)
                            .then(function (json) {
                                this.obtenerDescripcion();
                            });
                    }
                });
            },
              
           
            
        },
    });
}

window.onload = init;
