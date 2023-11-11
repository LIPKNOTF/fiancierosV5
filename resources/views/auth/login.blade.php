@extends('layouts.master')

@section('content')
<div class="logon">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h3>(Aun en proseso junto con las ventanas modales)</h3>
        <legend class="mb">
            <h1>&nbsp; Iniciar Sesion &nbsp;</h1>
        </legend>
        <di class="mt">
            <i class="fa-solid fa-user"></i>

            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </di>

        <div class="mt">
            <i class="fa-solid fa-lock"></i>
            <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="btn-login">
            {{ __('INICIAR SECCIÓN') }}
        </button>

    </form>
</div>
@endsection