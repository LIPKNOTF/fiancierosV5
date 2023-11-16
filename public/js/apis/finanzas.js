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
            
            
            },

    });
    
}window.onload = init;