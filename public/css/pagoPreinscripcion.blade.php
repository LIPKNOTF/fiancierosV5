@extends('index')
@section('titulo', 'Ejemplo')
@section('contenido')
    <style>
        div.dataTables_info {
            color: rgb(246, 246, 246) !important;
        }

        .dataTables_filter label {
            background-color: rgba(255, 255, 255, 0);
            color: rgb(255, 255, 255);
        }

        .dataTables_length label {
            background-color: rgba(255, 255, 255, 0);
            color: rgb(255, 255, 255);
        }

        .dataTables_length select {
            background-color: rgba(254, 254, 254, 0);
            color: rgb(255, 255, 255);
        }

        .dataTables_length option {
            background-color: rgb(15 23 42);
            color: rgb(255, 255, 255);
        }
    </style>
    <div id="apiPagoPreinscripcion">
        <div>
            <button type="button"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                @click="modalPagos()">
                Agregar pago
            </button>
            {{-- inicio del filtro por fechas --}}
            <span
                class="inline-block px-6 py-2.5 bg-yellow-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md ">fecha
                de inicio</span>
            <input type="date" v-model="fecha_inicio"
                class="py-2 px-3 rounded-md bg-white border text-xs	font-medium text-[#6B7280] border-[#e0e0e0]  mt-1 outline-none  focus:border-[#6A64F1] transition-all duration-300 focus:shadow-md">
            <span
                class="inline-block px-6 py-2.5 bg-yellow-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md">fecha
                final</span>
            <input type="date" v-model="fecha_final"
                class="py-2 px-3 rounded-md bg-white border text-xs	font-medium text-[#6B7280] border-[#e0e0e0]  mt-1 outline-none  focus:border-[#6A64F1] transition-all duration-300 focus:shadow-md">
            <button @click="limpiar()"
                class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-800	 hover:shadow-lg focus:bg-red-800	 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800	 active:shadow-lg transition duration-150 ease-in-out">limpiar</button>
            {{-- fin de filtro por fechas --}}
        </div>

        {{-- inicio de la ventana modal para agregar pagos --}}
        <div class="modal fade" id="modalPagoPreinscripcion" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="guardar==true">Agregando pago preinscripcion
                        </h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="guardar==false">Editando servicio</h5>
                        <span type="button" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark fa-2x"></i>
                        </span>
                    </div>
                    <div class="container-fluid">
                    </div>
                    <div class="modal-body relative p-4 bg-slate-100">
                        <form class="mb-6 grid grid-cols-1 gap-2 mx-7">
                            <div class="margin-bottom: 10px text-sm" data-te-input-helper-ref>
                                Seleccione un folio
                            </div>
                            <v-select v-model="id_folio" :reduce="preinscritos => preinscritos.id" :options="preinscritos"
                                label="id">
                            </v-select>
                            <div class="margin-bottom: 10px text-sm" data-te-input-helper-ref>
                                Seleccione un servicio
                            </div>
                            <select v-model="id_servicio"
                                class="py-2 px-3 rounded-md bg-white border text-base font-medium text-[#6B7280] border-[#e0e0e0] mt-1 outline-none focus:outline-none  focus:border-[#6A64F1] transition-all duration-300 focus:shadow-md">
                                <option value="" selected>Servicio</option>
                                <option v-for="ser in filtroServicios" :value="ser.id">@{{ ser.servicio }}
                                    @{{ ser.programa_educativo }}</option>
                            </select>
                            <div class="margin-bottom: 10px text-sm" data-te-input-helper-ref>
                                Fecha de pago
                            </div>
                            <div class="grid grid-cols-1">
                                <input
                                    class="py-2 px-3 rounded-md bg-white border text-base font-medium text-[#6B7280] border-[#e0e0e0]  mt-1 outline-none  focus:border-[#6A64F1] transition-all duration-300 focus:shadow-md"
                                    type="date" name="" id="" v-model="fecha_pago">
                            </div>
             
                        </form>

                    </div>
                    <div
                        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button"
                            class="inline-block px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                            data-bs-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" @click="guardarPago()" v-if="guardar==true"
                            class="inline-block px-6 py-2.5 bg-slate-700 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-slate-800 hover:shadow-lg focus:bg-slate-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-slate-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
                            Guardar
                        </button>
                        <button type="submit" @click="actualizarServicio()" v-if="guardar==false"
                            class="inline-block px-6 py-2.5 bg-slate-700 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-slate-800 hover:shadow-lg focus:bg-slate-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-slate-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
                            Guardar cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- fin de la ventana modal para agregar pagos --}}


        {{-- inicio de la tabla de pagos --}}
        <div class="overflow-x-auto p-3">
            <table id="dataPagoPre" class="table-auto w-full">
                <thead class="text-xs font-semibold uppercase text-gray-100 bg-slate-900">
                    <th class="p-2">
                        <div class="font-semibold text-left">Folio</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-left">Nombres</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-left">Apellido paterno</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-left">Apellido materno</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-left">Curp</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-left">Servicio</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-left">Costo</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-left">Programa educativo</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-center">fecha de pago</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-center">Pagado</div>
                    </th>
                    <th class="p-2">
                        <div class="font-semibold text-center">Opciones</div>
                    </th>
                </thead>

                <tbody class="text-sm divide-y bg-gray-100 text-black-100 divide-gray-100">
                    <!-- record 1 -->
                    <tr v-for="pag in filtroFechas">
                        <td class="p-2">
                            <div class="font-medium text-gray-800">
                                @{{ pag.id_folio }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="font-medium text-gray-800">
                                @{{ pag.preinscritos.nombres }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="font-medium text-gray-800">
                                @{{ pag.preinscritos.apellido_p }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="font-medium text-gray-800">
                                @{{ pag.preinscritos.apellido_m }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="font-medium text-gray-800">
                                @{{ pag.preinscritos.curp }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="text-left font-medium">
                                @{{ pag.servicios.servicio }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="text-left font-medium">
                                $@{{ pag.servicios.costo }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="text-left font-medium">
                                @{{ pag.servicios.programa_educativo }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="text-left font-medium">
                                @{{ pag.fecha_pago }}
                            </div>
                        </td>
                        <td class="p-2">
                            <div class="text-left font-medium">

                            </div>
                        </td>

                        <td class="p-2">
                            <div class="flex justify-center">
                                <button @click="borrarPago(pag.id)">
                                    <svg class="w-8 h-8 hover:text-blue-600 rounded-full hover:bg-gray-100 p-1"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1
                                            1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- fin de la tabla de pagos --}}

    </div>
@endsection


@push('scripts')
    <script src="js/vue-resource.js"></script>
    <script src="js/apis/apiPagoPreinscripcion.js"></script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">
