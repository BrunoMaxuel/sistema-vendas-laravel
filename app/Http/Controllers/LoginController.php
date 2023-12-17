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
        // dd($credentials);
        
        if (Auth::attempt($credentials)) {
            return redirect()->route('home.index');
            
        } else {
            // Credenciais inválidas
            return redirect()->back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Credenciais inválidas']);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect(route('login.view'));
    }

}
