function init(){
    var ruta = document.querySelector("[name=route]").value;

    var apiAlum = ruta + "/apiAlumno";

    new Vue({
        http:{
            headers:{
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },
          
        el: "#apiAlumno",
        data:{
            alumnos:[],
            id:"",
            matricula:"",
            nombres:"",
            apellido_p:"",
            apellido_m:"",
            grado:"",
            grupo:"",
            carrera:"",
            turno:"",
            agregando:"true",

        },

        created: function(){
            this.obtenerAlumno();
           
            

        },

      methods: {
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
          obtenerAlumno: function(){
            this.$http.get(apiAlum).then(function(json){
                this.alumnos = json.data;
             
           
            })
          },

          mostrarModal: function() {
            this.agregando=true;
            this.id="";
            this.matricula="";
            this.nombres="";
            this.apellido_p="";
            this.apellido_m="";
            this.grado="";
            this.grupo="";
            this.carrera="";
            this.turno=""

            $("#modalAlumno").modal("show");
          },

          agregarAlumno: function(){
            let alumno ={
               id:this.id,
               matricula:this.matricula,
                nombres:this.nombres,
                apellido_p:this.apellido_p,
                apellido_m:this.apellido_m,
                grupo:this.grupo,
                grado:this.grado,
                carrera:this.carrera,
                turno:this.turno,

            }
            if (!this.nombres || !this.matricula || !this.apellido_p || !this.apellido_m || !this.grupo || !this.grado 
              || !this.carrera || !this.turno) {
              Swal.fire({
                  icon: "warning",
                  title: "OCURRIO UN PROBLEMA",
                  text: "Existen campos vacios!",
                  showConfirmButton: false,
                  timer: 1000,
              });
          } else {
            this.$http.post(apiAlum, alumno).then(function(json){
                this.obtenerAlumno();
                 this.id="";
            this.matricula="";
            this.nombres="";
            this.apellido_p="";
            this.apellido_m="";
            this.grado="";
            this.grupo="";
            this.carrera="";
            this.turno=""

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
        

          editarAlumno: function(id){
            this.agregando=false;
           this.id = id;
            this.$http.get(apiAlum + "/" + id).then(function(json){
            this.id=json.data.id;
            this.matricula=json.data.matricula;
            this.nombres=json.data.nombres;
            this.apellido_p=json.data.apellido_p;
            this.apellido_m=json.data.apellido_m;
            this.grado=json.data.grado;
            this.grupo=json.data.grupo;
            this.carrera=json.data.carrera;
            this.turno=json.data.turno;
            });
            $("#modalAlumno").modal("show");

          },

          actualizarAlumno: function(){
            let alumno ={
              id:this.id,
              matricula:this.matricula,
               nombres:this.nombres,
               apellido_p:this.apellido_p,
               apellido_m:this.apellido_m,
               grupo:this.grupo,
               grado:this.grado,
               carrera:this.carrera,
               turno:this.turno,
              
            }
            if (!this.nombres || !this.matricula || !this.apellido_p || !this.apellido_m || !this.grupo || !this.grado 
              || !this.carrera || !this.turno) {
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

          eliminarAlumno: function(id, matricula, nombres, apellido_p, apellido_m ){
          
            Swal.fire({
              title: 'Se perderan todos lo realacionado con el nombre: ' +nombres+" " +apellido_p+ " " +apellido_m+ " y la matricula " +matricula+' ?',
              icon:'warning', showCancelButton:true,
              confirmButtonColor: '#d33',
              confirmButtonText: '<i class="fa-solid fa-check"></i>SI, Eliminar',
              cancelButtonText:'<i class="fa-solid fa-ban"></i> CANCELAR'
          }).then((result)=>{
            if(result.isConfirmed){
              Swal.fire({
                title: "Eliminado!",
                text: "El alumno ha sido eliminado con éxito.",
                icon: "success",
                timer: 1000,
                showConfirmButton: false,
              });
            this.$http.delete(apiAlum + "/" + id).then(function(json){
              this.obtenerAlumno();
            })
            }
          })
          }

          

      },
    })

}
window.onload = init;