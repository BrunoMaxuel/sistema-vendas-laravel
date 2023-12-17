<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Transacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $produtos = Produto::where('user_id', Auth::id())->get();
        $clientes = Cliente::where('user_id', Auth::id())->get();
        $transacoes = Transacao::where('user_id', Auth::id())->get();
       
        return view('home',['clientes'=>$clientes,'produtos'=>$produtos,'transacoes'=>$transacoes]);
    }
}
