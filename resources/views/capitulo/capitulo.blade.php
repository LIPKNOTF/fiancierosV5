@extends('layouts.master')
@section('titulo','Capitulo')
@section('content')

<div id="capitulos">


    <legend>
        <h1>&nbsp; Capitulo &nbsp;</h1>
    </legend>

    <div class="col-auto mt-4 text-center">
        <button class="btn-modal mb-1" @click="mostrarModal()">
            Agregar <i class="fa-solid fa-file-circle-plus"></i>
        </button>

        <div class="mb-1">
            <input type="text" placeholder="Escriba un Código" class="form-control" v-model="buscar">
        </div>

        <!--Inicion de la tabla-->
        <table id="myTableAlumnos" class="tabla display nowrap" style="width:100%">
            <thead class="fondo-negro">
                <tr>
                    <th class="boder-inicio">ID</th>
                    <th class="text-center">CODIGO</th>
                    <th class="text-center">TITULO</th>
                    <th class="boder-fin">ACCIONES</th>
            </thead>

            <tbody>
                <tr v-for="Capitulo in filtroCapitulo">
                    <td class="text-center">@{{Capitulo.id}}</td>
                    <td class="text-center">@{{Capitulo.codigo}}</td>
                    <td class="text-center">@{{Capitulo.titulo}}</td>
                    <td class="text-center">
                        <button class="btn-edit" title="Editar" @click="editarCapitulo(Capitulo.id)">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="btn-delete" title="Eliminar" @click="eliminarCapitulo(Capitulo.id)">
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

</div>

@endsection

@push('scripts')
<script type="text/javascript" src="js/apis/apiCapitulo.js"></script>
<script type="text/javascript" src="js/vue-resource.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">