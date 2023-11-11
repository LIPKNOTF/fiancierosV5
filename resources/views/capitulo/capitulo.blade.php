@extends('layouts.master')
@section('titulo','Capitulo')
@section('content')

<div id="capitulos">

    <button class="btn-modal" @click="mostrarModal()">
        Agregar
    </button>

    <input type="text" placeholder="  Bucar (Codigo)" class="form-control" v-model="buscar">

    <table id="TablaCapitulo" class="tabla display nowrap" style="width:100%">
        <thead class="fondo-negro">
            <tr>
                <th class="boder-inicio">ID</th>
                <th>CODIGO</th>
                <th>TITULO</th>
                <th class="boder-fin">OPCIONES</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="Capitulo in filtroCapitulo">
                <td>@{{Capitulo.id}}</td>
                <td>@{{Capitulo.codigo}}</td>
                <td>@{{Capitulo.titulo}}</td>
                <td>
                    <button class="btn-edit" title="Editar" @click="editarCapitulo(Capitulo.id)">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button class="btn-delete" title="Eliminar" @click="eliminarCapitulo(Capitulo.id, Capitulo.titulo)">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- INICIA VENTANA MODAL -->
<div class="modal fade" id="modalCapitulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #96C7EB;">
                <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">Agregando Capitulo</h5>
                <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">Editando Capitulos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Codigo" v-model="codigo" @input="validarCodigo"><br>
                <input type="text" class="form-control" placeholder="Titulo" v-model="titulo" @input="validarTitulo"><br>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" @click="guardarCapitulo()" v-if="agregando==true">Guardar</button>
                <button type="button" class="btn btn-primary" @click="actualizarCapitulo()" v-if="agregando==false">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $("#TablaCapitulo");
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
                        type: 'inline', // Cambiado de 'column' a 'inline'
                        target: ':not(:last-child)' // Excluir la última columna
                    }
                },
                language: {
                    searchPlaceholder: "Buscar",
                    search: "Buscar:",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "No hay datos disponibles en la tabla",
                    infoEmpty: "Mostrando 0 registros de un total de 0",
                    infoFiltered: "(filtrado de un total de MAX registros)",
                    example_info: "Se muestran 0 de 0 un total de 0",
                    sInfo: "<span style='margin-left: 2rem;'>Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros</span>",
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
<script type="text/javascript" src="js/apis/apiCapitulo.js"></script>
<script type="text/javascript" src="js/vue-resource.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">