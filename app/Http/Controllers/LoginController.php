<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrarRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tela de login
     *
     * @return \Illuminate\View\View
     */
    public function loginView()
    {
        return view('vendor.adminlte.login');
    }
    /**
     * ação de autenticar
     *
     * @return \Illuminate\View\View
     */
    public function autenticar(LoginRequest $request)
    {
        $request->processoAutenticar();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function registrar(){
        return view('vendor/adminlte/auth/register');
    }
    /**
     * Tela de registrar
     *
     * @return \Illuminate\View\View
     */
    public function processoRegistrar(RegistrarRequest $request)
    {
        $request->criarUsuario();
    }

    /**
     * Ação de deslogar
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deslogar(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
