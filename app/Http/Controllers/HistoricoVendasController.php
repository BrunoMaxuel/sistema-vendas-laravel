<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use App\Models\Venda;
use App\Models\vendasDetalhadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoVendasController extends Controller
{
    public function historicoView(){
        $transacao = Transacao::all();
        return view('relatorio.historicoVendas', ['transactions' => $transacao]);
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
    public function historicoBuscarDetalhes(Request $request){
        $id_transacao = $request->dataId;
        $vendaDetalhe = vendasDetalhadas::where('user_id', Auth::id())->where('item_cancelado', false)->where('id_transacao', $id_transacao)->get();
        return response()->json($vendaDetalhe);
    }
    public function imprimirVendas(){
        $transacoes = Transacao::where('user_id', Auth::id())->get();
        $vendasDetalhada = vendasDetalhadas::where('user_id', Auth::id())->where('item_cancelado', false)->get();
        
        return view('relatorio.imprimirTodasVendas', ['transacoes' => $transacoes, 'vendasDetalhada' => $vendasDetalhada]);
    }
    public function imprimirVenda(Request $request){
        $id_transacao = $request->id;
        $vendasDetalhada = vendasDetalhadas::where('user_id', Auth::id())->where('item_cancelado', false)->where('id_transacao', $id_transacao)->get();
        return view('relatorio.imprimirDetalhesVendas', ['vendasDetalhada' => $vendasDetalhada]);
    }
    
}
