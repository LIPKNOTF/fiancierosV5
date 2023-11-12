@extends('layouts.master')

@section('content')
<div class="login">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <H1 class="psc">PsC</H1>
        <div class="login-datos">
            <legend class="mb">
                <h1>&nbsp; INICIAR SESION &nbsp;</h1>
            </legend>
            <di class="mt">
                <i class="fa-solid fa-user"></i>

                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo"  autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </di>

            <div class="mt">
                <i class="fa-solid fa-lock"></i>
                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                ENTRAR
            </button>
        </div>
    </form>
</div>
@endsection