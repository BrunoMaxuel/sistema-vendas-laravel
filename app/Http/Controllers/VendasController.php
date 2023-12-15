<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Produto;
use App\Models\Transacao;
use App\Models\Venda;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    public function venderView(){
        $ultimoRegistroCaixa = Caixa::latest()->first();
        if(!isset($ultimoRegistroCaixa) || $ultimoRegistroCaixa->aberto == true){
            return view('venda.venda');
        }else{
            return view('');
        }
    }
    public function apiListar(Request $request){
        $letrasAsterisco = $request->search;
        return Produto::where('nome', 'LIKE', "%$letrasAsterisco%")->get();
    }
    public function vendaEmAndamentoRegistrar(Request $request){

        $linha = $request->linha;
        $produtoTotal = $linha[3] * $linha[6];  
        $venda = new Venda();
        $venda->nome_produto = $linha[1];
        $venda->codigo_barras = $linha[2];
        $venda->quantidade = $linha[6];
        $venda->valor_item = $linha[3];
        $venda->total_venda = $produtoTotal;
        $venda->save();
        $vendas = Venda::where('venda_finalizada', false)->where('item_cancelado', false)->get();
        $vendaRealizada = Venda::latest()->first();
        if($vendaRealizada->venda_finalizada == false){

            return response()->json($vendas);
        }

    }

    public function vendaEmAndamento(){
        $vendas = Venda::where('venda_finalizada', false)->where('item_cancelado', false)->get();
        $vendaRealizada = Venda::latest()->first();
        if(!isset($vendaRealizada) || $vendaRealizada->venda_finalizada == false){

            return response()->json($vendas); 
        }
    }

    public function apiCancelar(Request $request) {
        $venda = Venda::find($request->id);
    
        if ($venda) {
            $venda->item_cancelado = true;
            $venda->save();
    
            return response()->json();
        } else {
            return response()->json(['error' => 'Venda não encontrada'], 404);
        }
    }
    
    public function apiSave(Request $request){
        if($request->id != null){
            try{
                $estoque = Produto::where('id','=',$request->id)->first();
                $estoque->estoque      =  $request->estoque;
                $estoque->nome         =  $request->nome;
                $estoque->codigo       =  $request->bar_code;
                $estoque->lucro        =  str_replace("%","",$request->lucro);
                $estoque->preco_custo  =  str_replace([".",","],["","."],$request->preco_custo);
                $estoque->preco        =  str_replace([".",","],["","."], $request->preco);
                $estoque->save();
                
                return response()->json([
                    'success' => 'true',
                    'message' => 'Estoque alterado com sucesso'
                ]);
            }catch(QueryException $e){
                return response()->json([
                    'success' => 'false',
                    'message' => 'Erro '. $e->errorInfo[2]
                ]);
            }
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'sem indice na busca!'
            ]);
        };
    }
    public function finalizarVenda(Request $request){
        $dados = $request->dados;
        $transacao = new Transacao();
        $transacao->total = $dados[0];
        $transacao->total_item = $dados[1];
        $transacao->pagamento = $dados[2];
        $transacao->cliente = $dados[6];
        $transacao->desconto = $dados[5];
        $transacao->parcela = $dados[3];
        $transacao->valor_parcela = $dados[4];
        $transacao->save();

        Venda::whereNotNull('id')->update(['venda_finalizada' => true]);

        return response()->json();
    }
}
