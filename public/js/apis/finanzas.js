function init() {
    var ruta = document.querySelector("[name=route]").value;
        var apiTotalMes = ruta + "/apiTotalMes";
        var apiIngresos = ruta + "/apiIngresos";
        var apiEgresos = ruta + "/apiEgresos";
        var apiPartida = ruta + "/apiPartida";
        var apiClave = ruta + "/apiClave";
        
    new Vue({

        

        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value")
            }
        },

        el: "#finanzas",
        data: {
            egresos:[],
            ingresos:[],
            totalMes:[],
            partida:[],
            claves:[],
            mesIngreso:'',
            mesEgreso:'',
            mesTotal:'',



        },
        created: function () {
            this.getEgresos();
            this.getTotalMes();
            this.getIngresos();
            this.getPartida();
            this.getClaves();
            
        },

        methods: {
            getEgresos: function () {
                this.$http.get(apiEgresos).then(function(json){
                    this.egresos = json.data;
                });
            },

            filtrarMes:function(){
                 let mesIngresos = String(this.mesIngreso);
            this.$http.get(`/ingresos-por-mes?mes=${mesIngresos}`)
            .then(response => {
                console.log('Datos de ingresos filtrados por mes:', response.data);
                this.ingresos = response.data; // Reemplaza los datos originales con los filtrados
            })
            .catch(error => {
                console.log('Error al obtener los datos: ', error);
            });
            },

            egresoMes:function(){
                let mesEgresos = String(this.mesEgreso);
           this.$http.get(`/egresos-por-mes?mes=${mesEgresos}`)
           .then(response => {
               console.log('Datos de ingresos filtrados por mes:', response.data);
               this.egresos = response.data; // Reemplaza los datos originales con los filtrados
           })
           .catch(error => {
               console.log('Error al obtener los datos: ', error);
           });
           },

           totalPorMes:function(){
            let mesTotales = String(this.mesTotal);
            this.$http.get(`/total-por-mes?mes=${mesTotales}`)
            .then(response => {
                console.log('Datos de ingresos filtrados por mes:', response.data);
                this.totalMes = response.data; // Reemplaza los datos originales con los filtrados
            })
            .catch(error => {
                console.log('Error al obtener los datos: ', error);
            });
            },

            getTotalMes: function () {
                this.$http.get(apiTotalMes).then(function(json){
                    this.totalMes=json.data;
                });
            },
              

           getIngresos: function () {
                this.$http.get(apiIngresos).then(function(json){
                        this.ingresos=json.data;
                });
            },

            

            getPartida: function () {
                this.$http.get(apiPartida).then(function(json){
                        this.partida=json.data;
                });
            },

            getClaves: function () {
                this.$http.get(apiClave).then(function(json){
                    this.claves=json.data;
                });
            },

            descargarPDF() {
                axios.post('/generar-pdf', { mes: this.mesEgreso })
                    .then(response => {
                    console.log(response.data);
                })
                .catch(error => { console.error(error);});
            }
            
            
            },
            computed:{
                
            },

    });
    
}window.onload = init;