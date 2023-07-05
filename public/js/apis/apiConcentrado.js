function init(){
    var ruta = document.querySelector("[name=route]").value;

    var apiConcentrado = ruta + "/apiConcentrado";
    new Vue({
        http:{
            headers:{
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el:"#concentrado",
        data:{
            concentrados:[],
            mensaje:'Aqui es el concentrado',
            id:'',
            id_partida:'',
            fecha:'',
            razon_social:'',
            rfc:'',
            monto:null,
            productos:'',
            agregando:false,

        },
        created:function() {
          this.getConcentrados();
        },

        methods: {
            getConcentrados:function(){
                this.$http.get(apiConcentrado).then(function(json){
                    this.concentrados=json.data;
                }).catch(function(json){
                    console.log(json);
                });
            },


            openModal:function(){
                agregando=true;
                id_partida='',
                fecha='',
                razon_social='',
                rfc='',
                monto='',
                productos='',
			    $('#modalCon').modal('show');
            },


            saveConcentrado:function(){
                var concentrado={id_partida:this.id_partida,fecha:this.fecha,razon_social:this.razon_social,rfc:this.rfc,monto:this.monto,productos:this.productos};
                this.$http.post(apiConcentrado,concentrado).then(function(json){
                    console.log(json)
                    $('#modalCon').modal('hide');
                    this.getConcentrados();
                }).catch(function(json){

                });
            },

            showConcentrado:function(id){
                this.agregando=false;
                this.id=id;
                this.$http.get(apiConcentrado + '/'+id).then(function(json){
                    this.id_partida=json.data.id_partida;
                    this.fecha=json.data.fecha;
                    this.razon_social=json.data.razon_social;
                    this.rfc=json.data.rfc;
                    this.monto=json.data.monto;
                    this.productos=json.data.productos;
                });
                    $('#modalCon').modal('show');
            },

            updateConcentrado:function(){
                var jsonConcentrado={id_partida:this.id_partida,fecha:this.fecha,razon_social:this.razon_social,rfc:this.rfc,monto:this.monto,productos:this.productos};
                this.$http.patch(apiConcentrado+'/'+this.id,jsonConcentrado).then(function(json){
                        this.getConcentrados();
                });
                    $('#modalCon').modal('hide');
            },


            deleteConcentrado:function(id){
                var confirmacion = confirm('¿Esta seguro de elminar el concentrado?');
                if(confirmacion){
                    this.$http.delete(apiConcentrado+'/'+id).then(function(json){
                        this.getConcentrados();
                        console.log('Eliminacion exitosa!')
                    }).catch(function(json){
                        
                    });
                }
            },

        },
    });
    // fin de vue
}
window.onload = init;    