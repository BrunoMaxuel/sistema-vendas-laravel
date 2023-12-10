<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function venderView(){
        $ultimoRegistroCaixa = Caixa::latest()->first();
        if(!isset($ultimoRegistroCaixa) || $ultimoRegistroCaixa->aberto == true){
            return view('venda.venda',['aberto' => true]);
        }else{
            return view('cliente.index');
        }
    }
}
