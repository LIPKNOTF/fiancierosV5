function init() {
    var ruta = document.querySelector("[name=route]").value;
    var apicla = ruta + "/apiClave";

    new Vue({
        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el: "#apiclaves",
        data: {
            claves:[],
            id: "",
            clave: "",
            concepto: "",
            agregando: "true",
          
        },

        created: function () {
            this.obtenerClave();
        },

        methods: {
            obtenerClave: function () {
                this.$http.get(apicla).then(function (json) {
                    this.claves = json.data;
                    this.dataClave();
                });
            },
            // fin de la funcion para el complemento de dataTables
            //METODO PARA CONVERTIR EN MAYUSCULAS.
            convertirMayusculas() {
                this.clave = this.clave.toUpperCase();
                this.concepto = this.concepto.toUpperCase();
            },
            //FIN METODO PARA CONVERTIR EN MAYUSCULAS.
            dataClave() {
              $(document).ready(function () {
                  var table = $("#myTableClave");
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
                this.clave = "";
                this.concepto = "";
              

                $("#modalClave").modal("show");
            },

            agregarClave: function () {
                let clave = {
                    id: this.id,
                    clave: this.clave,
                    concepto: this.concepto,
                    
                };
                if (
                    !this.clave ||
                    !this.concepto 
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                } else {
                    this.$http.post(apicla, clave).then(function (json) {
                        this.obtenerClave();
                        this.id = "";
                        this.clave = "";
                        this.concepto = "";
                       

                        Swal.fire({
                            icon: "success",
                            title: "¡HECHO!",
                            text: "Se agrego el alumno con exito!",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    });

                    $("#modalClave").modal("hide");
                }
            },

            editarClave: function (id) {
                this.agregando = false;
                this.id = id;
                this.$http.get(apicla + "/" + id).then(function (json) {
                    this.id = json.data.id;
                    this.clave = json.data.clave;
                    this.concepto = json.data.concepto;

                });
                $("#modalClave").modal("show");
            },

            actualizarClave: function () {
                let clave = {
                    id: this.id,
                    id: this.id,
                    clave: this.clave,
                    concepto: this.concepto,
                };
                if (
                    !this.clave ||
                    !this.concepto 
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
                        .patch(apicla + "/" + this.id, clave)
                        .then(function (json) {
                            this.obtenerClave();
                            Swal.fire({
                                icon: "success",
                                title: "GENIAL",
                                text: "El sistema educativo se actualizo con éxito!",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#modalClave").modal("hide");
                        });
                }
            },

            eliminarClave: function (
                id,
                clave,
                concepto,
            ) {
                Swal.fire({
                    title:
                        "Se perderan todos los registros con la clave:  " +
                        clave +
                        " " +
                        "Y que con el concepto:  " +

                        concepto +
                        " ",
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
                            .delete(apicla + "/" + id)
                            .then(function (json) {
                                this.obtenerClave();
                            });
                    }
                });
            },
        },
    });
}

window.onload = init;
