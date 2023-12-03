<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // $cliente = Cliente::all();
        // $transacoes = count(Transacoes::month());
        // $Estoque = Estoque_aux::Total();
        $cliente = [
            'cliente1' => 'Bruno',
            'cliente2' => 'Maxuel',
            'cliente3' => 'João',
            'cliente4' => 'Bruno',
            'cliente5' => 'Maxuel',
            'cliente6' => 'João',
            'cliente7' => 'Bruno',
            'cliente8' => 'Maxuel',
            'cliente9' => 'João',
            'cliente10' => 'João',
            // ...
        ];
        $transacoes = 12;
        $Estoque = 200;
       
        return view('home',['clientes'=>$cliente,'Estoque'=>$Estoque,'transacoes'=>$transacoes]);
    }
}
