@extends('layouts.app')
@section('titulo','Partidas')
@section('content')

<div id="partidas">
    <div class="card bg-primary">
        <div class="card-body">
            <pre></pre>
            <div class="card header">
                <div class="content-header">
                    
                    <div class="card-header text-center fw-bold text-white" style="background-color: #2471A3; margin-bottom: 10px; border-radius: 5px;">
                        <h4 class="mb-0">
                            Modulo de partidas
                        </h4>
                    </div>

                    <button class="btn btn-sm" @click="abrirModal()">
                        <i class="fas fa-user-plus"></i>
                    </button>

                    <div class="card-body">
                    <!--Inicion de la tabla-->
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">CODIGO</th>
                            <th scope="col" class="text-center">Nombre</th>
                            <th scope="col" class="text-center">Capitulo</th>
                            <th scope="col" class="text-center">OPCIONES</th>
                        </thead>

                        <tbody v-for="Partida in partidas">
                            <tr>
                                <td class="text-center">@{{Partida.id}}</td>
                                <td class="text-center">@{{Partida.codigo}}</td>
                                <td class="text-center">@{{Partida.nombre}}</td>
                                <td class="text-center">@{{Partida.id_capitulo}}</td>
                                <td class="text-center">
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
                    <a type="button" class="btn btn-danger" href="partida" data-dismiss="modal">Cerrar</a>
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

