<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoVendasController extends Controller
{
    public function historicoView(){
        return view('relatorio.historicoVendas');
    }   
    public function historicoAPI(){
        $tr = Transacao::where('id', Auth::id())->get();
        
        foreach ($tr as $value){
            $id = $value->id;
            $venda = Venda::where('transacao','=', $id)->get();
            $value->total = number_format($value->total, 2, ',', '.');
        }
        return $tr;
    }
}
