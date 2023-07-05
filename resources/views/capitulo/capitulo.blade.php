@extends('layouts.app')
@section('titulo','Capitulo')
@section('content')

<div id="capitulos">
    <div class="card">
        <div class="col-md-12">
            <pre></pre>
            <div class="card header">
                <div class="content-header">
                    <h3>@{{prueba}}
                        <button class="btn btn-sm" @click="mostrarModal()">
                            <i class="fas fa-user-plus"></i>
                        </button>
                    </h3>

                    <!--Inicion de la tabla-->
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <th>ID</th>
                            <th>CODIGO</th>
                            <th>TITULO</th>
                            <th>OPCIONES</th>
                        </thead>

                        <tbody v-for="Capitulo in capitulos">
                            <tr>
                                <td>@{{Capitulo.id}}</td>
                                <td>@{{Capitulo.codigo}}</td>
                                <td>@{{Capitulo.titulo}}</td>
                                <td>
                                    <button class="btn btn-sm">
                                        <i class="fa-regular fa-pen-to-square" @click="editarCapitulo(Capitulo.id)"></i>
                                    </button>
                                    <button class="btn btn-sm" @click="eliminarCapitulo(Capitulo.id)">
                                        <i class="fa-solid fa-eraser"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

    <!-- INICIA VENTANA MODAL -->
    <div class="modal fade" id="modalCapitulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">Agregando Capitulo</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">Editando Capitulos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="number" class="form-control" placeholder="Id" v-model="id"><br>
                    <input type="text" class="form-control" placeholder="Capitulo" v-model="codigo"><br>
                    <input type="text" class="form-control" placeholder="Titulo" v-model="titulo"><br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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

