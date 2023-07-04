@extends('layouts.app')
@section('titulo','alumnos')
@section('content')
<div id="concentrado">
    <div class="container">
        <h2>@{{mensaje}}</h2>
    </div>
</div>
@endsection
@push('scripts')
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/vue-resource.js"></script>
<script src="js/apis/apiConcentrado.js"></script>
<script src="js/XML/leerXML.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">