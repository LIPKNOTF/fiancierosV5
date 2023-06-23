function init(){

    var apiCapitulo = 'http://127.0.0.1:8000/apiCapitulo';

    new Vue({

        http: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

        el:'#capitulos',

        data : {
            prueba:'Capitulos',
            capitulos:[],
            id:'',
            codigo:'',
            titulo:'',
            agregando:true
        },

        created:function(){
            this.mostrarcapitulos();
        },

        methods: {
            
            mostrarcapitulos:function(){
                this.$http.get(apiCapitulo).then(function(json){
                    this.capitulos = json.data;
                    console.log(json.data);
                }).catch(function(json){
                    console.log(json)
                });
            }, //fin mostrarcapitulos

            mostrarModal(){
                this.agregando = true;
                this.id = '',
                this.codigo = '',
                this.titulo = ''
                $('#modalCapitulo').modal('show');
            }, //fin mostrar modal

            guardarCapitulo(){
                var capitulo = {
                    id:this.id,
                    codigo:this.codigo,
                    titulo:this.titulo};

                this.$http.post(apiCapitulo,capitulo).then(function(json){
                    this.mostrarcapitulos();
                }).catch(function(json){
                });

                $('#modalCapitulo').modal('hide');
                console.log(capitulo);
            }, //fin guardarcapitulo

            editarCapitulo(id){
                this.agregando = false;
                this.id = id;

                this.$http.get(apiCapitulo + '/' + id).then(function(json){
                    this.id = json.data.id;
                    this.codigo = json.data.codigo;
                    this.titulo = json.data.titulo;
                }).catch(function(json){
                });
                $('#modalCapitulo').modal('show');
            }, //fin de editarcapitulo

            actualizarCapitulo(){
                var jsonCapitulo = {
                    id: this.id,
                    codigo: this.codigo,
                    titulo: this.titulo};
                    
                this.$http.patch(apiCapitulo + '/' + this.id, jsonCapitulo).then(function(json){
                    this.mostrarcapitulos();
                }).catch(function(json){
                });
                $('#modalCapitulo').modal('hide');
            }, //fin de actuaoizarcapitulo

            eliminarCapitulo(id){
                var confirmar = confirm('estas seguro de eliminar el capitulo?')
                if(confirmar)
                {
                    this.$http.delete(apiCapitulo + '/' + id).then(function(json){
                        this.mostrarcapitulos();
                    }).catch(function(json){
                        
                    });
                }
            }, //fin de eliminarcapitulo

        }//fin de metodos

    });//fin de vue

}window.onload = init;