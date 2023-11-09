@extends('layouts.app')
@section('titulo','Partidas')
@section('content')
<div id="usuarios">
    <div class="card">
        <div class="card-body">
            <pre></pre>
            <div class="card header">
                <div class="content-header">
                      
                    <div class="card-header text-center fw-bold text-white" style="background-color: #2471A3; margin-bottom: 10px; border-radius: 5px;">
                        <h4 class="mb-0">
                            Modulo de Usuarios
                        </h4>
                    </div>
                    
                    <div class="col-md-4 offset-md-4">
                    <div class="d-grid mx-auto">
                    <button class="btn btn-sm btn-dark" @click="openModalUser()">
                        Agregar <i class="fa-solid fa-file-circle-plus"></i>
                    </button>
                    </div>
                    </div>

                    <div class="col-md-3 offset-md-9">
                        <input type="text" placeholder="Escriba el nombre" class="form-control" v-model="buscar">
                    </div>

                    <div class="card-body">
                    <!--Inicion de la tabla-->
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">NOMBRE</th>
                            <th scope="col" class="text-center">APELLIDO MATERNO</th>
                            <th scope="col" class="text-center">APELLIDO PATERNO</th>
                            <th scope="col" class="text-center">CARGO</th>
                            <th scope="col" class="text-center">ACCION</th>
                        </thead>

                        <tbody v-for="Usuarios in filterUser">
                            <tr>
                                <td class="text-center">@{{Usuarios.id_usuario}}</td>
                                <td class="text-center">@{{Usuarios.nombre_usuario}}</td>
                                <td class="text-center">@{{Usuarios.apellidoPaterno_usuario}}</td>
                                <td class="text-center">@{{Usuarios.apellidoMaterno_usuario}}</td>
                                <td class="text-center">@{{Usuarios.cargo_usuario}}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning"  title="Editar" @click="editUser(Usuarios.id_usuario)">
                                        <i class="fa-regular fa-pen-to-square" ></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger"  title="Eliminar" @click="deleteUser(Usuarios.id_usuario, 
                                            Usuarios.nombre_usuario, Usuarios.apellidoPaterno_usuario, Usuarios.apellidoMaterno_usuario)">
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
     <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #96C7EB;">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">Agregando Usuario</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">Editando Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Nombre" v-model="nombre_usuario" @input="validateLetters"><br>
                    <input type="text" class="form-control" placeholder="Apellido Paterno" v-model="apellidoPaterno_usuario" @input="validateLetters"><br>
                    <input type="text" class="form-control" placeholder="Apellido Materno" v-model="apellidoMaterno_usuario" @input="validateLetters"><br>
                    <input type="text" class="form-control" placeholder="Cargo" v-model="cargo_usuario" @input="validateLetters"><br>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="saveUser()" v-if="agregando==true">Guardar</button>
                    <button type="button" class="btn btn-primary" @click="updateUser()" v-if="agregando==false">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->


</div>
@endsection
@push('scripts')
<script type="text/javascript" src="js/apis/apiUsuario.js"></script>
<script type="text/javascript" src="js/vue-resource.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
