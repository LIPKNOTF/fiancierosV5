function init(){

    var ruta = document.querySelector("[name=route]").value;
    var apiUsuario = ruta + "/apiUsuario";

    new Vue({

        http: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

        el:'#usuarios',

        data:{
            usuarios:[],
            id_usuario:'',
            nombre_usuario:'',
            apellidoPaterno_usuario:'',
            apellidoMaterno_usuario:'',
            cargo_usuario:'',
            agregando:true,
            buscar:''
        },

        created:function(){
            this.getUser();
        },

        methods:{
            getUser:function(){
                this.$http.get(apiUsuario).then(function(json){
                    this.usuarios=json.data;
                    console.log(json.data);
                }).catch(function(json){
                    console.log(json)
                });
            },//fin de mostrarUsuario


            openModalUser(){
                this.id_usuario='',
                this.nombre_usuario='',
                this.apellidoPaterno_usuario='',
                this.apellidoMaterno_usuario='',
                this.cargo_usuario='',
                this.agregando=true
                $('#modalUsuario').modal('show');
            },//fin de mostrarModaldeUsuario

            saveUser(){
                let usuario = {
                    id_usuario:this.id_usuario,
                    nombre_usuario:this.nombre_usuario,
                    apellidoPaterno_usuario:this.apellidoPaterno_usuario,
                    apellidoMaterno_usuario:this.apellidoMaterno_usuario,
                    cargo_usuario:this.cargo_usuario
                };

                if(
                    !this.nombre_usuario||
                    !this.apellidoPaterno_usuario||
                    !this.apellidoMaterno_usuario||
                    !this.cargo_usuario
                ){
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    })
                }else{
                    this.$http.post(apiUsuario,usuario).then(function(j){
                        this.getUser();
                        $('#modalUsuario').modal('hide');
                        Swal.fire({
                            icon: "success",
                            title: "GENIAL",
                            text: "Se agrego el usuario con éxito!",
                            showConfirmButton: false,
                            timer: 1000,
                        })
                    }).catch(function(j){
                    });
                }
            },//fin de guardarUsuario

            editUser(id){
                this.id_usuario=id,
                this.agregando=false,

                this.$http.get(apiUsuario+'/'+id).then(function(json){
                    this.id_usuario=json.data.id_usuario,
                    this.nombre_usuario=json.data.nombre_usuario,
                    this.apellidoPaterno_usuario=json.data.apellidoPaterno_usuario,
                    this.apellidoMaterno_usuario=json.data.apellidoMaterno_usuario,
                    this.cargo_usuario=json.data.cargo_usuario
                });
                $('#modalUsuario').modal('show');  
            },//fin de editarUsuario

            updateUser(){
                var jsonUsuario={
                    id_usuario:this.id_usuario,
                    nombre_usuario:this.nombre_usuario,
                    apellidoPaterno_usuario:this.apellidoPaterno_usuario,
                    apellidoMaterno_usuario:this.apellidoMaterno_usuario,
                    cargo_usuario:this.cargo_usuario
                };

                if(
                    !this.nombre_usuario||
                    !this.apellidoPaterno_usuario||
                    !this.apellidoMaterno_usuario||
                    !this.cargo_usuario  
                ){
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                }else{
                    this.$http.patch(apiUsuario+'/'+ this.id_usuario, jsonUsuario).then(function(json){
                        this.getUser();
                    });
                    $('#modalUsuario').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: "GENIAL",
                        text: "Usuario editado con éxito!",
                        showConfirmButton: false,
                        timer: 1000,
                    })
                }
            },//fin de actualizar Usuario

            deleteUser(id, nombre_usuario, apellidoPaterno_usuario, apellidoMaterno_usuario){
                Swal.fire({
                    title:"Se eliminara el registro de " + nombre_usuario + " " + apellidoPaterno_usuario + " " + apellidoMaterno_usuario + ", está seguro?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText:'<i class="fa-solid fa-check"></i> Eliminar',
                    cancelButtonText:'<i class="fa-solid fa-ban"></i> CANCELAR',
                }).then(result => {
                    if (result.isConfirmed){
                        Swal.fire({
                            title: "Eliminado!",
                            text: "El capitulo ha sido eliminado con éxito.",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                        this.$http.delete(apiUsuario + '/' + id).then(function(json){
                            this.getUser();
                        }).catch(function(json){});
                    } 
                });

            },//fin de eliminarUsuario

            validateLetters() {
                this.nombre_usuario = this.nombre_usuario.replace(/[^a-zA-Z\s]/g, '');
                this.apellidoPaterno_usuario = this.apellidoPaterno_usuario.replace(/[^a-zA-Z\s]/g, '');
                this.apellidoMaterno_usuario = this.apellidoMaterno_usuario.replace(/[^a-zA-Z\s]/g, '');
                this.cargo_usuario = this.cargo_usuario.replace(/[^a-zA-Z\s]/g, '');
            }//fin de validarLetras

        }, // end of methods

        computed : {
            filterUser: function () {
                const buscarEnMinusculas = this.buscar.trim().toLowerCase();
            
                return this.usuarios.filter(usuario => 
                    usuario.nombre_usuario.toLowerCase().includes(buscarEnMinusculas)
                );
            }      
        }
    });
}window.onload = init;