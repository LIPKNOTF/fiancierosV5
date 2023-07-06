function init(){

    var ruta = document.querySelector("[name=route]").value;
    var apiCapitulo = ruta + "/apiCapitulo";

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
            agregando:true,
            buscar:''
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

            validarCodigo() {
                this.codigo = this.codigo.replace(/[^0-9]/g, '');
            },//fin de validar codigo

            
            validarTitulo() {
                this.titulo = this.titulo.replace(/[^a-zA-Z\s]/g, '');
            }//fin de validar titulo

        },//fin de metodos

        computed : {
            filtroCapitulo:function(){
                return this.capitulos.filter((capitulo)=>{
                    return capitulo.codigo.toString().match(this.buscar.trim())
                });
            }//fin de filtrocapitulo

        }//fin de computed

    });//fin de vue

}window.onload = init;