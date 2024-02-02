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
    public function home()
    {
        if(Auth::check()){
            return redirect(route('dashboard.index'));
        }
        return view('home');
    }

    public function autenticar(LoginRequest $request)
    {
        $request->processoAutenticar();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function registrar(){
        return view('vendor/adminlte/auth/register');
    }

    public function processoRegistrar(RegistrarRequest $request)
    {
        $request->criarUsuario();
    }

    public function deslogar(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    public function mudarSenha(){

        return view('vendor/adminlte/auth/passwords/reset');
    }

    public function mudarSenhaAction(){
        return view('vendor/adminlte/auth/passwords/confirm');
    }

}
