function init(){

    var apiCapitulo = 'http://127.0.0.1:8000/apiCapitulo';

    new Vue({

        http: {
            Headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

        el:'#capitulos',

        data : {
            prueba:'holaaaa',
            capitulos:[],
            id:'',
            codigo:'',
            titulo:''
        },

        created:function(){
            this.mostrarcapitulos();
        },

        methods : {
            
            mostrarcapitulos:function(){
                this.$http.get(apiCapitulo).then(function(json){
                    this.capitulos = json.data;
                    console.log(json.data);
                }).catch(function(json){
                    console.log(json)
                });
            },

            mostrarModal(){
                this.id = '',
                this.codigo = '',
                this.titulo = ''
                $('#modalCapitulo').modal('show');
            },

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
            }
        }

    });

}window.onload=init;