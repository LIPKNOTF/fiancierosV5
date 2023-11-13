<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {

        $credentials = $this->credentials($request);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {

            throw ValidationException::withMessages([
                $this->username() => [trans('Correo electrónico no encontrado')],
            ]);
        }

        if (!$this->guard()->attempt($credentials, $request->filled('remember'))) {

            throw ValidationException::withMessages([
                'password' => [trans('La contrasenia no es correcta')],
            ]);
        }

        // El usuario está autenticado correctamente
        return true;
    }
}
