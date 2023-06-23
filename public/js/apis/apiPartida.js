function init(){
    
    var apiPartida = 'http://127.0.0.1:8000/apiPartida';
    var apiCapitulo = 'http://127.0.0.1:8000/apiCapitulo';


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
            agregando:true
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
            } //eliminarpartida

        }//metodos

    }); //fin de vue
}window.onload = init;