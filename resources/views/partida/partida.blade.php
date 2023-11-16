@extends('layouts.master')
@section('titulo','Partidas')
@section('content')

<div id="partidas">
    <legend>
        <h1>&nbsp; Partidas &nbsp;</h1>
    </legend>

    <button class="btn-modal" @click="abrirModal()">
        Agregar
    </button>

    <input type="text" placeholder="Escriba un Código" class="input" v-model="buscar">

    <!--Inicion de la tabla-->
    <table id="partidaTabla" class="tabla display nowrap" style="width:100%">
        <thead class="fondo-negro">
            <tr>
                <th class="boder-inicio">Id</th>
                <th>CODIGO</th>
                <th>NOMBRE</th>
                <th>CAPITULO</th>
                <th class="boder-fin">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="Partida in filtroPatidas">
                <td>@{{Partida.id}}</td>
                <td>@{{Partida.codigo}}</td>
                <td>@{{Partida.nombre}}</td>
                <td>@{{Partida.capitulo.titulo}}</td>
                <td>
                    <button class="btn-edit" @click="editarPartida(Partida.id)"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn-delete" @click="eliminarPartida(Partida.id)"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- INICIA VENTANA MODAL -->
    <div class="modal fade" id="modalPartida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-body">
                <div class="modal-header text-white" :style="agregando ? 'background-color: #28a717;' : 'background-color: #f8be10;'">
                    <h1 class="modal-title" id="exampleModalLabel" v-if="agregando==true">Agregando Partida</h1>
                    <h1 class="modal-title" id="exampleModalLabel" v-if="agregando==false">Editando Partida</h1>
                </div>
                <br>
                <br>
                <input type="text" class="form-control" placeholder="Codigo" v-model="codigo" @input="validarCodigo"><br>
                <input type="text" class="form-control" placeholder="Nombre" v-model="nombre" @input="validarNombre"><br>
                <select name="" v-model="id_capitulo" class="form-control" v-if="agregando==true">
                    <option value="" selected>Seleciona un capitulo</option>
                    <option v-for="cap in capitulos" :value="cap.id">@{{cap.titulo}}</option>
                </select>
                <!-- <select name="" v-model="id_capitulo" class="form-control" v-if="agregando==false">
                        <option value="" >Seleciona un capitulo</option>
                        <option v-for="cap in capitulos" :value="cap.id" selected>@{{cap.titulo}}</option>
                    </select> -->



                <div class="modal-footer">
                    <button type="button" class="btn-rojo" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn-modal" @click="guardarPartida()" v-if="agregando==true">Guardar</button>
                    <button type="button" class="btn-azul" @click="actualizarPartida()" v-if="agregando==false">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="js/apis/apiPartida.js"></script>

<script>
    $(document).ready(function() {
        var table = $("#partidaTabla");
        if (!table.hasClass("dataTable")) {
            table.DataTable({
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            var column = this;
                            var header = $(column.header());
                            if (header.hasClass("actions")) {
                                // No hacer nada si es la columna de acciones
                                return;
                            }
                        });
                },
                responsive: {
                    details: {
                        type: "inline", // Cambiado de 'column' a 'inline'
                        target: ":not(:last-child)", // Excluir la última columna
                    },
                },
                language: {
                    searchPlaceholder: "Buscar",
                    search: "Buscar:",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "No hay datos disponibles en la tabla",
                    infoEmpty: "Mostrando 0 registros de un total de 0",
                    infoFiltered: "(filtrado de un total de MAX registros)",
                    example_info: "Se muestran 0 de 0 un total de 0",
                    sInfo: "<span style='margin-left: 2rem;'>Mostrando registros del START al END de un total de TOTAL registros</span>",
                    lengthMenu: "Mostrar _MENU_",
                    paginate: {
                        previous: "Anterior",
                        next: "Siguiente",
                    },
                },

                "lengthMenu": [7, 10, 25, 50],
                "pageLength": 7,
            });
        }
    });
</script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">