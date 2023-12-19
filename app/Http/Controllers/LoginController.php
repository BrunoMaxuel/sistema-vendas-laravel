<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginView(){
        if(Auth::check()){
            return redirect(route('home.index'));
        }else{
            return view('vendor.adminlte.login');
        }
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {

            return redirect()->route('home.index');
            
        } else {
            return redirect()->back()->withInput($request->only('email'))
            ->with('error', 'Email ou senha incorreto.');
        }
    }
    public function registrar(){
        return view('vendor/adminlte/auth/register');
    }

    public function registrarAction(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Criação de um novo usuário
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), 
        ]);
        Auth::login($user);
        return redirect(route('login.view'));
    }
    public function logout(){
        Auth::logout();
        return redirect(route('login.view'));
    }

}
