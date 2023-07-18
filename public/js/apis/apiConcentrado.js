function init(){
    var ruta = document.querySelector("[name=route]").value;
    Vue.component("v-select", VueSelect.VueSelect);
    var apiConcentrado = ruta + "/apiConcentrado";
    var apiPartida = ruta + "/apiConcentrado"
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
            partidas:[],
            mensaje:'Aqui es el concentrado',
            id:'',
            id_partida:'',
            fecha:'',
            razon_social_emisor:'',
            razon_social_receptor:'',
            rfc_emisor:'',
            rfc_receptor:'',
            regimen_emisor:'',
            regimen_receptor:'',
            total:'',
            sub_total:'',
            descripcion:'',
            impuesto_traslado:'',
            impuesto_retenido:'',
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
                this.agregando=true;
                this.id_partida='',
                this.fecha='',
                this.razon_social='',
                this.rfc='',
                this.monto='',
                this.productos='',
			    $('#modalCon').modal('show');
            },


            saveConcentrado:function(){
                let concentrado={id_partida:this.id_partida,fecha:this.fecha,razon_social:this.razon_social,rfc:this.rfc,monto:this.monto,productos:this.productos};
                if(
                    !this.id_partida||
                    !this.fecha||
                    !this.razon_social||
                    !this.rfc||
                    !this.monto||
                    !this.productos
                ){
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });

                }else{
                this.$http.post(apiConcentrado,concentrado).then(function(json){
                    console.log(json);
                    $('#modalCon').modal('hide');
                    this.getConcentrados();
                    Swal.fire({
                        icon: "success",
                        title: "GENIAL",
                        text: "Se agrego el concentrado con éxito!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                }).catch(function(json){

                });
             }
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
                let jsonConcentrado={id_partida:this.id_partida,fecha:this.fecha,razon_social:this.razon_social,rfc:this.rfc,monto:this.monto,productos:this.productos};
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