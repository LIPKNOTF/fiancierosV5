function init(){
    var ruta = document.querySelector("[name=route]").value;
    Vue.component("v-select", VueSelect.VueSelect);
    var apiCon = ruta + "/apiConsulta";
    var apiAlum = ruta + "/apiAlumno";
       
    new Vue({
        http:{
            headers:{
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
        },
    },

    el: "#apiConsulta",
    data:{
     alumnos:[],
     consultas:[],
     id:"",
     id_alumno:"", 
     importe:"", 
     clave:"", 
     cantidad:"",
     cuota:"", 
     fecha:"", 
     folio:"",
     concepto:"",
     agregando:"true", 
    },
    created: function(){
        this.obtenerConsulta();
        this.obtenerAlumno();
    },
    methods : {
      //METODO PARA CONVERTIR EN MAYUSCULAS.
   

        obtenerConsulta :function(){
    this.$http.get(apiCon).then(function(json){
        this.consultas = json.data;
        this.dataPagPre();
    })
        },

        obtenerAlumno :function(){
          this.$http.get(apiAlum).then(function(json){
            this.alumnos = json.data;

          })
        },
          // funcion para el complemento de dataTables
          dataPagPre() {
            $(document).ready(function() {
              var table = $('#myTable');
              if (!table.hasClass('dataTable')) {
                table.DataTable({
                  initComplete: function() {
                    this.api().columns().every(function(index) {
                        var column = this;
                        var header = $(column.header());
                        if (header.hasClass('actions')) {
                            // No hacer nada si es la columna de acciones
                            return;
                        }
                        var input = $('<input type="text" class="text-center form-control form-control-sm mb-2" placeholder="Buscar ">')
                            .appendTo(header)
                            .on('keyup change clear', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                    });
                },
                  language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                      "sFirst": "Primero",
                      "sLast": "Último",
                      "sNext": "Siguiente",
                      "sPrevious": "Anterior"
                    },
                    "oAria": {
                      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                  },
                  columnDefs: [{
                    targets: -1,
                    className: 'actions',
                    searchable: false
                }],
            
                  pageLength: 5, // Número de registros por página
                  lengthMenu: [5, 10, 25, 50], // Opciones de número de registros por página
                });
              }
            });
        },
        // fin de la funcion para el complemento de dataTables

        mostrarModal: function(){
            this.agregando=true;
            this.id="";
            this.id_alumno="";
            this.importe="";
            this.clave="";
            this.cantidad="";
            this.cuota="";
            this.fecha="";
            this.folio="";
            this.concepto="";
            $("#modalConsulta").modal("show");
        },

        agregarConsulta: function() {
            let consultas = {
              id: this.id,
              id_alumno: this.id_alumno,
              importe: this.importe,
              clave: this.clave,
              cantidad: this.cantidad,
              cuota: this.cuota,
              fecha: this.fecha,
              folio: this.folio,
              concepto: this.concepto,
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
                timer: 1000,
              });
            } else if (
              !this.id_alumno ||
              !this.importe ||
              !this.clave ||
              !this.cantidad ||
              !this.cuota ||
              !this.fecha ||
              !this.folio ||
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
              // AQUÍ USAS TU RUTA Y TU LET
              this.$http.post(apiCon, consultas).then(function(json) {
                this.obtenerConsulta();
                this.id = "";
                this.id_alumno = "";
                this.importe = "";
                this.clave = "";
                this.cantidad = "";
                this.cuota = "";
                this.fecha = "";
                this.folio = "";
                this.concepto = "";
          
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
          },

        editarConsulta: function(id) {
            this.agregando = false; 
            this.id = id;
            this.$http.get(apiCon + "/" + id).then(function(json) {
                this.id=json.data.id;
                this.id_alumno=json.data.id_alumno;
                this.importe=json.data.importe;
                this.clave=json.data.clave;
                this.cantidad=json.data.cantidad;
                this.cuota=json.data.cuota;
                this.fecha=json.data.fecha;
                this.folio=json.data.folio;
                this.concepto=json.data.concepto;

            });
            $("#modalConsulta").modal("show");


        },

        actualizarConsulta: function() {
            let consultas = {
              id: this.id,
              id_alumno: this.id_alumno,
              importe: this.importe,
              clave: this.clave,
              cantidad: this.cantidad,
              cuota: this.cuota,
              fecha: this.fecha,
              folio: this.folio,
              concepto: this.concepto,
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
              !this.clave ||
              !this.cantidad ||
              !this.cuota ||
              !this.fecha ||
              !this.folio ||
              !this.concepto
            ) {
              Swal.fire({
                icon: "warning",
                title: "OCURRIO UN PROBLEMA",
                text: "Existen campos vacios!",
                showConfirmButton: false,
                timer: 2000,
              });
            } else {
              this.$http.patch(apiCon + "/" + this.id, consultas).then(function(json) {
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

    },
    })

}
window.onload = init;

