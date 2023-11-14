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
                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" title="Correo"  placeholder="Correo" required>
                @error('email')
                <br>
                <br>
                <span class="color-rojo" role="alert">
                    <i class="fa-solid fa-rectangle-xmark fa-lg"></i>
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('password')
                <br>
                <br>
                <span class="color-verde" role="alert">
                    <i class="fa-solid fa-square-check fa-lg"></i>
                    <strong>El correo es correcto.</strong>
                </span>
                @enderror
            </di>

            <div class="mt">
                <i class="fa-solid fa-lock"></i>
                <input title="Contraseña" id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                @error('password')
                <br>
                <br>
                <span class="color-rojo" role="alert">
                    <i class="fa-solid fa-rectangle-xmark fa-lg"></i>
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