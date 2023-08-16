function init() {
    var ruta = document.querySelector("[name=route]").value;
    Vue.component("v-select", VueSelect.VueSelect);
    var apiConcentrado = ruta + "/apiConcentrado";
    var apiPartida = ruta + "/apiPartida"
    new Vue({
        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el: "#concentrado",
        data: {
            concentrados: [],
            partidas: [],
            mensaje: 'Aqui es el concentrado',
            id: '',
            id_partida: '',
            fecha: '',
            razon_social_emisor: '',
            razon_social_receptor: '',
            rfc_emisor: '',
            rfc_receptor: '',
            regimen_emisor: '',
            regimen_receptor: '',
            total: '',
            sub_total: '',
            descripcion: '',
            impuesto_traslado: '',
            impuesto_retenido: '',
            monto: null,
            productos: '',
            agregando: true,
            fecha_i: "",
            fecha_f: "",

        },
        created: function () {
            this.getConcentrados();
            this.getPartida();
        },

        methods: {
            getConcentrados: function () {
                this.$http.get(apiConcentrado).then(function (json) {
                    this.concentrados = json.data;
                }).catch(function (json) {
                    console.log(json);
                });
            },

            getPartida: function () {
                this.$http.get(apiPartida).then(function (json) {
                    this.partidas = json.data;
                }).catch(function (json) {
                    console.log(json);
                });
            },


            openModal: function () {
                this.agregando = true;
                this.id_partida = '';
                this.fecha = '';
                this.razon_social_emisor = '';
                this.razon_social_receptor = '';
                this.rfc_emisor = '';
                this.rfc_receptor = '';
                this.regimen_emisor = '';
                this.regimen_receptor = '';
                this.total = '';
                this.sub_total = '';
                this.impuesto_traslado = '';
                this.impuesto_retenido = '';
                this.productos = '';
                this.descripcion = '';
                $('#modalCon').modal('show');
            },


            saveConcentrado: function () {
                let concentrado = { id_partida: this.id_partida, 
                    fecha: this.fecha, 
                    razon_social_emisor: this.razon_social_emisor, 
                    razon_social_receptor: this.razon_social_receptor, 
                    rfc_emisor: this.rfc_emisor, 
                    rfc_receptor: this.rfc_receptor, 
                    regimen_emisor: this.regimen_emisor,
                    regimen_receptor: this.regimen_receptor,
                    impuesto_retenido: this.impuesto_retenido,
                    impuesto_traslado: this.impuesto_traslado,
                    total: this.total,
                    sub_total: this.sub_total,
                    productos: this.productos,
                    descripcion: this.descripcion };
                if (
                    !this.id_partida ||
                    !this.fecha ||
                    !this.razon_social_emisor ||
                    !this.razon_social_receptor ||
                    !this.rfc_emisor ||
                    !this.rfc_receptor ||
                    !this.regimen_emisor ||
                    !this.regimen_receptor ||
                    !this.impuesto_retenido ||
                    !this.impuesto_traslado ||
                    !this.total ||
                    !this.sub_total ||
                    !this.descripcion ||
                    !this.productos
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "OCURRIO UN PROBLEMA",
                        text: "Existen campos vacios!",
                        showConfirmButton: false,
                        timer: 1000,
                    });

                } else {
                    this.$http.post(apiConcentrado, concentrado).then(function (json) {
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
                    }).catch(function (json) {

                    });
                }
            },

            showConcentrado: function (id) {
                this.agregando = false;
                this.id = id;
                this.$http.get(apiConcentrado + "/" + this.id).then(function (json) {
                    this.id_partida = json.data.id_partida;
                    this.fecha = json.data.fecha;
                    this.razon_social_emisor = json.data.razon_social_emisor;
                    this.razon_social_receptor = json.data.razon_social_receptor;
                    this.rfc_emisor = json.data.rfc_emisor;
                    this.rfc_receptor = json.data.rfc_receptor;
                    this.regimen_emisor = json.data.regimen_emisor;
                    this.regimen_receptor = json.data.regimen_receptor;
                    this.total = json.data.total;
                    this.sub_total = json.data.sub_total;
                    this.impuesto_traslado = json.data.impuesto_traslado;
                    this.impuesto_retenido = json.data.impuesto_retenido;
                    this.productos = json.data.productos;
                    this.descripcion = json.data.descripcion;
                    $('#modalCon').modal('show');

                });

            },

            updateConcentrado: function () {
                let jsonConcentrado = { id_partida: this.id_partida, 
                    fecha: this.fecha, 
                    razon_social_emisor: this.razon_social_emisor, 
                    razon_social_receptor: this.razon_social_receptor,
                    rfc_emisor:this.rfc_emisor, 
                    rfc_receptor:this.rfc_receptor, 
                    regimen_emisor:this.regimen_emisor,
                    regimen_receptor:this.regimen_receptor,
                    total:this.total,
                    sub_total:this.sub_total,
                    impuesto_retenido:this.impuesto_retenido,
                    impuesto_traslado:this.impuesto_traslado, 
                    productos: this.productos,
                    descripcion: this.descripcion };
                    
                this.$http.patch(apiConcentrado + '/' + this.id, jsonConcentrado).then(function (json) {
                    this.getConcentrados();
                    Swal.fire({
                        icon: "success",
                        title: "GENIAL",
                        text: "Se actualizo el concentrado con éxito!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                });
                $('#modalCon').modal('hide');
                
            },


            deleteConcentrado: function (id) {
                Swal.fire({
                    title:
                        "Se eliminara el registro esta seguro?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText:
                        '<i class="fa-solid fa-check"></i>SI, Eliminar',
                    cancelButtonText:
                        '<i class="fa-solid fa-ban"></i> CANCELAR',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Eliminado!",
                            text: "El concentrado ha sido eliminado con éxito.",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                        this.$http.delete(apiConcentrado + "/" + id).then(function (json) {
                            this.getConcentrados();
                        });
                    }
                });
            },

            limpiar: function () {
                this.fecha_i = "";
                this.fecha_f = "";
            },

        },



        computed: {
            filtrarfechas: function () {
                return this.concentrados.filter((consu) => {
                    if (this.fecha_f != "") {
                        return (
                            consu.fecha >= this.fecha_i &&
                            consu.fecha <= this.fecha_f
                        );
                    } else {
                        return consu;
                    }
                });
            },
        },
    });
    // fin de vue
}
window.onload = init;    