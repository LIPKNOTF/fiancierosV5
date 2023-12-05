@extends('layouts.master')
@section('titulo','Finanzas')
@section('content')
<div id="finanzas">

    <legend class="mb-2">
        <h1>&nbsp; Ingresos &nbsp;</h1>
    </legend>

    <input type="month" class="input" v-model="mesIngreso" @input="filtrarMes" />

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
                <td class="verde">@{{row.total}}</td>
            </tr>
        </tbody>
    </table>
    <legend class="mb-2">
        <h1>&nbsp; Egresos &nbsp;</h1>
    </legend>

    <input type="month" class="input" v-model="mesEgreso" @input="egresoMes" />

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
                <td class="verde">@{{row.total}}</td>
            </tr>
        </tbody>

        <a v-if="mesEgreso" :href=`http://127.0.0.1:8000/Facturapdf?mes=${mesEgreso}` style="color: white;">Descargar</a>


    </table>

    <legend class="mb-2">
        <h1>&nbsp; Total por Mes &nbsp;</h1>
    </legend>

    <input type="month" class="input" v-model="mesTotal" @input="totalPorMes" />

    <table id="" class="tabla display nowrap" style="width:100%">
        <thead class="fondo-negro">
            <tr>
                <th class="boder-inicio">Mes</th>
                <th>Año</th>
                <th>Egresos Totales</th>
                <th class="boder-fin">Ingresos Totales</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="row in totalMes">
                <td>@{{row.mes}}</td>
                <td>@{{row.anio}}</td>
                <td>@{{row.egreso_total}}</td>
                <td class="verde">@{{row.ingreso_total}}</td>
            </tr>
        </tbody>
    </table>


</div>

@endsection
@push('scripts')
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/apis/finanzas.js"></script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">