function init() {
    var ruta = document.querySelector("[name=route]").value;

    var apiInscripciones = ruta + "/apiInscripcion";
    var apiAlum = ruta + "/apiAlumno";
    var apiCarrera = ruta + "/apiCarrera";
    var apiServicio = ruta + "/apiServicio";
    var apiSistemaEducativo = ruta + "/apiSistemaEducativo";

    Vue.component("v-select", VueSelect.VueSelect);

    new Vue({
        http: {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el: "#apiInscripcion",
        data: {
            // nombre de la tabla de la base de datos
            inscripciones: [],
            // preinscripciones:[],
            carreras: [],
            alumnos: [],
            sistemas_educativos: [],
            // campos de la tabla
            id: "",
            folio: "",
            matricula: "",
            id_carrera: "",
            como_se_entero: "",
            otro: "",
            apoyo: "",
            apellido_p: "",
            apellido_m: "",
            nombres: "",
            genero: "",
            fecha_nacimiento: "",
            curp: "",
            nss: "",
            direccion: "",
            localidad: "",
            municipio: "",
            num_telefono: "",
            correo: "",
            habla_maya: "",
            discapacidad: "",
            especifica: "",
            tutor: "",
            parentesco: "",
            telefono_tutor: "",
            id_sistemaedu: "",
            localidad_e: "",
            municipio_e: "",
            especialidad: "",
            periodo: "",
            promedio: "",
            beca: "",
            agregando: true,
            ultimo_numero: 1000,
        },
        // trae los datos del alumno al iniciar
        created: function () {
            this.obtenerSistemas();
            this.obtenerCarreras();
            this.obtenerPreinscripciones();
            this.obtenerInscripciones();
            this.generarMatricula();
            this.buscarFolio();
        },

        // inicio de methods
        methods: {
            // funcion para obtener los sistemas educativos

            obtenerSistemas: function () {
                this.$http.get(apiSistemaEducativo).then(function (json) {
                    this.sistemas_educativos = json.data;
                });
            },
            // fin de la funcion para obtener los sistemas educativos

            // funcion para obtener las carreras
            obtenerCarreras: function () {
                this.$http.get(apiCarrera).then(function (json) {
                    this.carreras = json.data;
                });
            },
            // fin de la funcion para obtener las carreras

            // funcion para obtener los alumnos inscritos
            obtenerInscripciones: function () {
                this.$http.get(apiInscripciones).then(function (json) {
                    this.inscripciones = json.data;
                    this.inscripcionesDataTables();
                });
            },
            // fin de la funcion para obtener los alumnos inscritos


            // funcion para obtener los alumnos inscritos
            obtenerPreinscripciones: function () {
                this.$http.get(apiAlum).then(function (json) {
                    this.alumnos = json.data;
                });
            },
            // fin de la funcion para obtener los alumnos inscritos
            inscripcionesDataTables() {
                $("#inscripcionesTable").DataTable().destroy();
                this.$nextTick(() => {
                    $("#inscripcionesTable").DataTable({
                        language: {
                            sProcessing: "Procesando...",
                            sLengthMenu: "Mostrar _MENU_ registros",
                            sZeroRecords: "No se encontraron resultados",
                            sEmptyTable: "Ningún dato disponible en esta tabla",
                            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            sInfoEmpty:
                                "Mostrando registros del 0 al 0 de un total de 0 registros",
                            sInfoFiltered:
                                "(filtrado de un total de _MAX_ registros)",
                            sInfoPostFix: "",
                            sSearch: "Buscar:",
                            sUrl: "",
                            sInfoThousands: ",",
                            sLoadingRecords: "Cargando...",
                            oPaginate: {
                                sFirst: "Primero",
                                sLast: "Último",
                                sNext: "Siguiente",
                                sPrevious: "Anterior",
                            },
                        },
                        // centrar encabezados de la tabla
                        // columnDefs: [
                        //     { className: "dt-center", targets: "_all" },
                        // ],
                        // fin de centrar
                        pagingType: "full_numbers",
                        // pageLength: 5,
                        processing: true,
                        dom: "Bfrtip",
                        buttons: [
                            {
                                extend: "excelHtml5",
                                text: '<i class="fa-regular fa-file-excel"></i>',
                                titleAttr: "Exportar a Excel",
                                className: "btn btn-outline-info",
                                exportOptions: {
                                    modifier: {
                                        page: "current",
                                    },
                                },
                            },
                        ],
                        dom:
                            "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
                    });
                });
            },

            mostrarModal: function () {
                this.agregando = true;
                this.matricula = "";
                this.id_carrera = "";
                this.id_sistemaedu = "";
                this.como_se_entero = "";
                this.otro = "";
                this.apoyo = "";
                this.apellido_p = "";
                this.apellido_m = "";
                this.nombres = "";
                this.genero = "";
                this.fecha_nacimiento = "";
                this.curp = "";
                this.nss = "";
                this.direccion = "";
                this.localidad = "";
                this.municipio = "";
                this.num_telefono = "";
                this.correo = "";
                this.habla_maya = "";
                this.discapacidad = "";
                this.especifica = "";
                this.tutor = "";
                this.parentesco = "";
                this.telefono_tutor = "";
                this.localidad_e = "";
                this.municipio_e = "";
                this.especialidad = "";
                this.periodo = "";
                this.promedio = "";
                this.beca = "";

                $("#modalInscripcion").modal("show");
            },
            // funcion para inscribir alumnos
            agregarInscripcion: function (event) {
                let inscripcion = {
                    id: this.matricula,
                    id_carrera: this.id_carrera,
                    como_se_entero: this.como_se_entero,
                    otro: this.otro,
                    apoyo: this.apoyo,
                    apellido_p: this.apellido_p,
                    apellido_m: this.apellido_m,
                    nombres: this.nombres,
                    genero: this.genero,
                    fecha_nacimiento: this.fecha_nacimiento,
                    curp: this.curp,
                    nss: this.nss,
                    direccion: this.direccion,
                    localidad: this.localidad,
                    municipio: this.municipio,
                    num_telefono: this.num_telefono,
                    correo: this.correo,
                    habla_maya: this.habla_maya,
                    discapacidad: this.discapacidad,
                    especifica: this.especifica,
                    tutor: this.tutor,
                    parentesco: this.parentesco,
                    telefono_tutor: this.telefono_tutor,
                    id_sistemaedu: this.id_sistemaedu,
                    localidad_e: this.localidad_e,
                    municipio_e: this.municipio,
                    especialidad: this.especialidad,
                    periodo: this.periodo,
                    promedio: this.promedio,
                    beca: this.beca,
                };
                // validaciones de campos

                if (this.id == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Seleccione un alumno!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.id_carrera == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo carrera!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.como_se_entero == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo como se entero!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.como_se_entero == "otro") {
                    if (this.otro == "") {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "Verifique el campo otro!",
                            showConfirmButton: false,
                            timer: 2400,
                        });
                        event.preventDefault();
                    }
                }
                if (this.apoyo == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo apoyo!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.localidad == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo localidad!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.municipio == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo municipio!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.num_telefono == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo num. telefono!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.apellido_p == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de apellido paterno",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.apellido_m == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de apellido materno!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.nombres == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de nombres!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.genero == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de genero!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.fecha_nacimiento == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de fecha de nacimiento!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.curp == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de curp!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.nss == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de nss!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.direccion == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de direccion!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.correo == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de correo!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.habla_maya == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de habla maya!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.discapacidad == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de discapacidad!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.discapacidad == "Si") {
                    if (this.especifica == "") {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "Verifique el campo de especifica!",
                            showConfirmButton: false,
                            timer: 2400,
                        });

                        event.preventDefault();
                    }
                }
                if (this.tutor == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de tutor!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.parentesco == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de parentesco!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.telefono_tutor == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de telefono del tutor!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.id_sistemaedu == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de sistema educativo!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.localidad_e == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de locaidad_e!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.municipio_e == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de municipio_e!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.especialidad == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de especialidad!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.periodo == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de periodo!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.promedio == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de promedio!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.beca == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el campo de beca!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }

                if (this.curp.length != 18) {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el CURP!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.nss.length != 11) {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el NSS!",
                        showConfirmButton: false,
                        timer: 2400,
                    });
                    event.preventDefault();
                }
                if (this.num_telefono.length != 10) {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el TELEFONO!",
                        showConfirmButton: false,
                        timer: 2600,
                    });
                    event.preventDefault();
                }
                if (this.telefono_tutor.length != 10) {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el TELEFONO DEL TUTOR!",
                        showConfirmButton: false,
                        timer: 2600,
                    });
                    event.preventDefault();
                }
                if (this.promedio < 7) {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Verifique el PROMEDIO!",
                        showConfirmButton: false,
                        timer: 2600,
                    });
                    event.preventDefault();
                } else {
                    // fin de la validaciones de campos

                    // se envian los datos al controlador
                    this.$http
                        .post(apiInscripciones, inscripcion)
                        .then(function (json) {
                            this.obtenerInscripciones();
                            this.id = "";
                            this.matricula = "";
                            this.id_carrera = "";
                            this.id_sistemaedu = "";
                            this.como_se_entero = "";
                            this.apoyo = "";
                            this.apellido_p = "";
                            this.apellido_m = "";
                            this.nombres = "";
                            this.genero = "";
                            this.fecha_nacimiento = "";
                            this.curp = "";
                            this.nss = "";
                            this.direccion = "";
                            this.localidad = "";
                            this.municipio = "";
                            this.num_telefono = "";
                            this.correo = "";
                            this.habla_maya = "";
                            this.discapacidad = "";
                            this.especifica = "";
                            this.tutor = "";
                            this.parentesco = "";
                            this.telefono_tutor = "";
                            this.localidad_e = "";
                            this.municipio_e = "";
                            this.especialidad = "";
                            this.periodo = "";
                            this.promedio = "";
                            this.beca = "";
                            Swal.fire({
                                icon: "success",
                                title: "GENIAL",
                                text: "Se Inscribió el alumno con exito!",
                                showConfirmButton: false,
                                timer: 1800,
                            });
                        });
                }
            },
            // fin de la funcion para inscribir alumnos

            // funcion para generar una matricula
            generarMatricula() {
                const now = new Date();
                const year = now.getFullYear().toString().substring(2);
                const carrera = this.alumnos.find(
                    (folio) => folio.id === this.id
                ).id_carrera;
                let numero = localStorage.getItem("ultimo_numero");
                if (!numero) {
                    numero = "1000";
                }
                if (numero === "9999") {
                    numero = "1000";
                }
                const matricula = year + carrera + numero;
                localStorage.setItem(
                    "ultimo_numero",
                    (parseInt(numero) + 1).toString()
                );
                this.matricula = matricula;
            },
            // fin de la funcion para generar una matricula

            // funcio para buscar un foio y traer los datos
            buscarFolio: function (id) {
                // let encontrado = 0;
                // let alumnos = {};-
                this.id = id;
                // let id = this.id;
                this.$http.get(apiAlum + "/" + id).then(function (json) {
                    id = json.data.id;
                    this.id_carrera = json.data.id_carrera;
                    this.como_se_entero = json.data.como_se_entero;
                    this.otro = json.data.otro;
                    this.apoyo = json.data.apoyo;
                    this.apellido_p = json.data.apellido_p;
                    this.apellido_m = json.data.apellido_m;
                    this.nombres = json.data.nombres;
                    this.genero = json.data.genero;
                    this.fecha_nacimiento = json.data.fecha_nacimiento;
                    this.curp = json.data.curp;
                    this.nss = json.data.nss;
                    this.direccion = json.data.direccion;
                    this.localidad = json.data.localidad;
                    this.municipio = json.data.municipio;
                    this.num_telefono = json.data.num_telefono;
                    this.correo = json.data.correo;
                    this.habla_maya = json.data.habla_maya;
                    this.discapacidad = json.data.discapacidad;
                    this.especifica = json.data.especifica;
                    this.tutor = json.data.tutor;
                    this.parentesco = json.data.parentesco;
                    this.telefono_tutor = json.data.telefono_tutor;
                    this.id_sistemaedu = json.data.id_sistemaedu;
                    this.localidad_e = json.data.localidad_e;
                    this.municipio_e = json.data.municipio_e;
                    this.especialidad = json.data.especialidad;
                    this.periodo = json.data.periodo;
                    this.promedio = json.data.promedio;
                    this.beca = json.data.beca;
                });
            },
            // fin de la funcio para buscar un foio y traer los datos

            // funcion para borrar Inscripciones
            borrarInscripcion: function (id) {
                Swal.fire({
                    title: "¿Estas segur@?",
                    text: "No puedes revertir este cambio!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, elimínalo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            "Eliminado!",
                            "La inscripcion ha sido eliminada.",
                            "success"
                        );
                        this.$http
                            .delete(apiInscripciones + "/" + id)
                            .then(function (json) {
                                this.obtenerInscripciones();
                            });
                    }
                });
            },
            // fin de la funcion para borrar Inscripciones
        },
        // fin de methods

        // inicio de computed
        computed: {},
        // fin de computed
    });
}
window.onload = init;
