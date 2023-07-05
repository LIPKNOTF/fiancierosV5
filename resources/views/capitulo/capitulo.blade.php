@extends('layouts.app')
@section('titulo','Capitulo')
@section('content')

<div id="capitulos">
    <div class="card bg-primary">
        <div class="card-body">
            <pre></pre>
            <div class="card header">
                <div class="content-header">
                    
                    <div class="card-header text-center fw-bold text-white" style="background-color: #2471A3; margin-bottom: 10px; border-radius: 5px;">
                        <h4 class="mb-0">
                            Modulo de capitulos
                        </h4>
                    </div>

                    <button class="btn btn-sm" @click="mostrarModal()">
                        <i class="fas fa-user-plus"></i>
                    </button>

                    <div class="card-body">
                    <!--Inicion de la tabla-->
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">CODIGO</th>
                            <th scope="col" class="text-center">TITULO</th>
                            <th scope="col" class="text-center">OPCIONES</th>
                        </thead>

                        <tbody v-for="Capitulo in capitulos">
                            <tr>
                                <td class="text-center">@{{Capitulo.id}}</td>
                                <td class="text-center">@{{Capitulo.codigo}}</td>
                                <td class="text-center">@{{Capitulo.titulo}}</td>
                                <td class="text-center">
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

