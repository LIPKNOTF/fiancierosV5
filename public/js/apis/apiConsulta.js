function init(){
    var ruta = document.querySelector("[name=route]").value;
    var apiCon = ruta + "/apiConsulta";
       
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
     agregando:true,
    },
    created: function(){
        this.obtenerConsulta();
    },
    methods : {

        obtenerConsulta :function(){
    this.$http.get(apiCon).then(function(json){
        this.consultas = json.data;
    })
        },
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

          }



    },










    })

}
window.onload = init;

