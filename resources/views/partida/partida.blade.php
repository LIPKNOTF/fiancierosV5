@extends('index')
@section('titulo','Partidas')
@section('contenido')

<div id="partidas">
    <div class="card">
        <div class="col-md-12">
            <pre></pre>
            <div class="card header">
                <div class="content-header">
                    <h3>@{{titulo}}
                        <button class="btn btn-sm" @click="abrirModal()">
                            <i class="fas fa-user-plus"></i>
                        </button>
                    </h3>

                    <div class="card-body">
                    <!--Inicion de la tabla-->
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <th>ID</th>
                            <th>CODIGO</th>
                            <th>Nombre</th>
                            <th>Capitulo</th>
                            <th>OPCIONES</th>
                        </thead>

                        <tbody v-for="Partida in partidas">
                            <tr>
                                <td>@{{Partida.id}}</td>
                                <td>@{{Partida.codigo}}</td>
                                <td>@{{Partida.nombre}}</td>
                                <td>@{{Partida.id_capitulo}}</td>
                                <td>
                                    <button class="btn btn-sm">
                                        <i class="fa-regular fa-pen-to-square" @click="editarPartida(Partida.id)"></i>
                                    </button>
                                    <button class="btn btn-sm">
                                        <i class="fa-solid fa-eraser" @click="eliminarPartida(Partida.id)"></i>
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
    <div class="modal fade" id="modalPartida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">Agregando Partida</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">Editando Partida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="number" class="form-control" placeholder="Id" v-model="id"><br>
                    <input type="text" class="form-control" placeholder="Capitulo" v-model="codigo"><br>
                    <input type="text" class="form-control" placeholder="Nombre" v-model="nombre"><br>
                    <select name="" v-model="id_capitulo" class="form-control" :disabled="!agregando==true">
                        <option value="" selected>Seleciona un capitulo</option>
                        <option v-for="cap in capitulos" :value="cap.id">@{{cap.id}}</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="guardarPartida()" v-if="agregando==true">Guardar</button>
                    <button type="button" class="btn btn-primary" @click="actualizarPartida()" v-if="agregando==false">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->

</div>

@endsection

@push('scripts')
<script type="text/javascript" src="js/apis/apiPartida.js"></script>
<script type="text/javascript" src="js/vue-resource.js"></script>
@endpush

