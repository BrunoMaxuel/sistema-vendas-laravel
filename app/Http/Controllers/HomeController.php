<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $produtos = Produto::all();
        $clientes = Cliente::all();
        $transacoes = 12;
       
        return view('home',['clientes'=>$clientes,'produtos'=>$produtos,'transacoes'=>$transacoes]);
    }
}
