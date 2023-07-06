function init(){
    
    var ruta = document.querySelector("[name=route]").value;
    var apiPartida = ruta + "/apiPartida"
    var apiCapitulo = ruta + "/apiCapitulo"

    new Vue({

        http: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

        el:'#partidas',

        data: {
            titulo:'Partidas',
            partidas:[],
            capitulos:[],
            id:'',
            codigo:'',
            nombre:'',  
            id_capitulo: '',
            agregando:true,
            buscar:''
        },

        created:function(){
            this.mostrarpartidas();
            this.mostrarcapitulos();
        },

        methods: {

            mostrarpartidas:function(){
                this.$http.get(apiPartida).then(function(json){
                    this.partidas = json.data;
                    console.log(json.data);
                }).catch(function(json){
                    console.log(json)
                });
            }, //fin mostrarpartida
            mostrarcapitulos:function(){
                this.$http.get(apiCapitulo).then(function(json){
                    this.capitulos = json.data;
                    console.log(json.data);
                }).catch(function(json){
                    console.log(json)
                });
            }, //fin mostrarpartida

            abrirModal(){
                this.agregando = true;
                this.id = '',
                this.codigo = '',
                this.nombre = '',
                this.id_capitulo = ''
                $('#modalPartida').modal('show');
            }, //abrir modal

            guardarPartida(){
                var partida = {
                    id:this.id,
                    codigo:this.codigo,
                    nombre:this.nombre,
                    id_capitulo:this.id_capitulo
                };

                this.$http.post(apiPartida,partida).then(function(json){
                    this.mostrarpartidas();
                }).catch(function(json){

                });

                $('#modalPartida').modal('hide');
                console.log(partida);
            },//guardarpartida

            editarPartida(id){
                this.agregando = false;
                this.id = id;

                this.$http.get(apiPartida + '/' + id).then(function(json){
                    this.id = json.data.id;
                    this.codigo = json.data.codigo;
                    this.nombre = json.data.nombre;
                }).catch(function(json){

                });
                $('#modalPartida').modal('show');
            }, //editarpartida

            actualizarPartida(){
                var Jpartida = {
                    id: this.id,
                    codigo: this.codigo,
                    nombre: this.nombre,
                    id_capitulo: this.id_capitulo
                };

                this.$http.patch(apiPartida + '/'+ this.id,Jpartida).then(function(json){
                    this.mostrarpartidas();
                }).catch(function(json){

                });
                $('#modalPartida').modal('hide');
            }, //actualizarpartida

            eliminarPartida(id){
                var aceptar = confirm('estas seguro de eliminar la partida?')
                if(aceptar)
                {
                    this.$http.delete(apiPartida + '/' + id).then(function(json){
                        this.mostrarpartidas();
                    }).catch(function(json){

                    });
                }
            }, //eliminarpartida

            validarCodigo() {
                this.codigo = this.codigo.replace(/[^0-9]/g, '');
            },//fin de validar codigo

            
            validarNombre() {
                this.nombre = this.nombre.replace(/[^a-zA-Z\s]/g, '');
            }//fin de validar titulo

        },//metodos

        computed : {
            filtroPatidas:function(){
                return this.partidas.filter((partida)=>{
                    return partida.codigo.toString().match(this.buscar.trim())
                });
            }
        }

    }); //fin de vue
}window.onload = init;