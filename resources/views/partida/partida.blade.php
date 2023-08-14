@extends('layouts.app')
@section('titulo','Partidas')
@section('content')

<div id="partidas">
    <div class="card ">
        <div class="card-body">
            <pre></pre>
            <div class="card header">
                <div class="content-header">
                    
                    <div class="card-header text-center fw-bold text-white" style="background-color: #2471A3; margin-bottom: 10px; border-radius: 5px;">
                        <h4 class="mb-0">
                            Modulo de partidas
                        </h4>
                    </div>

                    <div class="col-auto mt-4 text-center">
                    <button class="btn btn-sm btn-primary" @click="abrirModal()">
                        Agregar <i class="fa-solid fa-file-circle-plus"></i>
                    </button>
                    </div>

                    <div class="col-md-3 offset-md-9">
                        <input type="text" placeholder="Escriba un Código" class="form-control" v-model="buscar">
                    </div>

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

                        <tbody v-for="Partida in filtroPatidas">
                            <tr>
                                <td class="text-center">@{{Partida.id}}</td>
                                <td class="text-center">@{{Partida.codigo}}</td>
                                <td class="text-center">@{{Partida.nombre}}</td>
                                <td class="text-center">@{{Partida.id_capitulo}}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-Warning"  title="Editar" @click="editarPartida(Partida.id)">
                                        <i class="fa-sharp fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar" @click="eliminarPartida(Partida.id)">
                                        <i class="fa-solid fa-trash"></i>
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
                <div class="modal-header" style="background-color: #96C7EB;">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">Agregando Partida</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">Editando Partida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
  
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Codigo" v-model="codigo" @input="validarCodigo"><br>
                    <input type="text" class="form-control" placeholder="Nombre" v-model="nombre" @input="validarNombre"><br>
                    <select name="" v-model="id_capitulo" class="form-control" :disabled="!agregando==true">
                        <option value="" selected>Seleciona un capitulo</option>
                        <option v-for="cap in capitulos" :value="cap.id">@{{cap.id}}</option>
                    </select>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

<input type="hidden" name="route" value="{{ url('/') }}">