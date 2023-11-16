@extends('layouts.master')
@section('titulo','Finanzas')
@section('content')
<div id="finanzas">
    <div class="container justify-content-center">




        <h2>Egresos</h2>
        <table id="" class="tabla display nowrap" style="width:100%">
            <thead class="fondo-negro">
                <tr>
                    <th class="boder-inicio">Mes</th>
                    <th>Año</th>
                    <th>Partida: Nombre</th>
                    <th>Partida: Código</th>
                    <th class="boder-fin">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in egresos">
                    <td>@{{row.mes}}</td>
                    <td>@{{row.anio}}</td>
                    <td>@{{row.partida.nombrel}}</td>
                    <td>@{{row.partida.codigo}}</td>
                    <td>@{{row.total}}</td>

                </tr>
            </tbody>
        </table>

        <h2>Total por Mes</h2>
        <table id="" class="tabla display nowrap" style="width:100%">
            <thead class="fondo-negro">
                <tr>
                    <th class="boder-inicio">Mes</th>
                    <th>Año</th>
                    <th>Egresos Totales</th>
                    <th class="boder-fin">Ingresos Totales</th>

            </thead>
            <tbody>
                <tr v-for="row in totalMes">
                    <td>@{{row.mes}}</td>
                    <td>@{{row.anio}}</td>
                    <td>@{{row.egreso_total}}</td>
                    <td>@{{row.ingreso_total}}</td>

                </tr>
            </tbody>
        </table>


        <h2>Ingresos</h2>
        <table id="" class="tabla display nowrap" style="width:100%">
            <thead class="fondo-negro">
                <tr>
                    <th class="boder-inicio">Mes</th>
                    <th>Año</th>
                    <th>Clave: Concepto</th>
                    <th>Clave: Código</th>
                    <th class="boder-fin">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in ingresos">
                    <td>@{{row.mes}}</td>
                    <td>@{{row.anio}}</td>
                    <td>@{{row.claves_p.concepto}}</td>
                    <td>@{{row.claves_p.clave}}</td>
                    <td>@{{row.total}}></td>

                </tr>
            </tbody>
        </table>




    </div>
</div>



</div>

</div>

@endsection
@push('scripts')
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/apis/finanzas.js"></script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">