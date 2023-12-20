<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Produto;
use App\Models\Transacao;
use App\Models\Venda;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    public function venderView(){
        $ultimoRegistroCaixa = Caixa::where('user_id', Auth::id())->latest()->first();
        if(!isset($ultimoRegistroCaixa) || $ultimoRegistroCaixa->aberto == true){
            return view('venda.venda');
        }else{
            return view('venda.caixaNaoAberto');
        }
    }
    public function apiListar(Request $request){
        $dataSearch = $request->search;
        if(strlen($dataSearch) < 13){
            $resultados = Produto::where('user_id', Auth::id())
                ->where('nome', 'LIKE', "%$dataSearch%")
                ->get();
            $resultadosFormatados = $resultados->map(function ($produto) {
                $produto->preco = number_format($produto->preco, 2, ',', '.');
                $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '.');
                return $produto;
            });
            return $resultadosFormatados;
        }else if(strlen($dataSearch) === 13){
            return Produto::where('user_id', Auth::id())->where('codigo_barras', $dataSearch)->get();
        }
    }
    public function vendaEmAndamentoRegistrar(Request $request){

        $linha = $request->linha;
        $produtoTotal = $linha[3] * $linha[6];  
        $venda = new Venda();
        $venda->user_id  = Auth::id();
        $venda->id_venda = $linha[0];
        $venda->nome_produto = $linha[1];
        $venda->codigo_barras = $linha[2];
        $venda->quantidade = $linha[6];
        $venda->valor_item = $linha[3];
        $venda->total_venda = $produtoTotal;
        $venda->save();
        Produto::where('user_id', Auth::id())->where('id', $linha[0])->decrement('estoque', $linha[6]);
        $resultados = Venda::where('user_id', Auth::id())->where('venda_finalizada', false)->where('item_cancelado', false)->get();

        $vendas = $resultados->map(function ($produto) {
            $produto->preco = number_format($produto->preco, 2, ',', '.');
            $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '.');
            $produto->valor_item = number_format($produto->valor_item, 2, ',', '.');
            $produto->total_venda = number_format($produto->total_venda, 2, ',', '.');
            return $produto;
        });

        $vendaRealizada = Venda::where('user_id', Auth::id())->latest()->first();
        if($vendaRealizada->venda_finalizada == false){

            return response()->json($vendas);
        }
    }

    public function vendaEmAndamento(){
        $resultados = Venda::where('user_id', Auth::id())->where('venda_finalizada', false)->where('item_cancelado', false)->get();

            $vendas = $resultados->map(function ($produto) {
                $produto->preco = number_format($produto->preco, 2, ',', '.');
                $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '.');
                $produto->valor_item = number_format($produto->valor_item, 2, ',', '.');
                $produto->total_venda = number_format($produto->total_venda, 2, ',', '.');
                return $produto;
            });

        $vendaRealizada = Venda::where('user_id', Auth::id())->latest()->first();
        if(!isset($vendaRealizada) || $vendaRealizada->venda_finalizada == false){

            return response()->json($vendas); 
        }
    }

    public function apiCancelar(Request $request) {
        Venda::where('user_id', Auth::id())->where('id_venda', $request->id_venda)
            ->update(['item_cancelado' => true]);
        return response()->json();
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
        $totalVenda = str_replace('.', '', $dados[0]);
        $totalVenda = str_replace(',', '.', $totalVenda);
        $valor_parcela = str_replace('.', '', $dados[4]);
        $valor_parcela = str_replace(',', '.', $valor_parcela);
        

        $transacao = new Transacao();
        $transacao->user_id = Auth::id(); 
        $transacao->total = $totalVenda;
        $transacao->total_item = $dados[1];
        $transacao->pagamento = $dados[2];
        $transacao->cliente = $dados[6];
        $transacao->desconto = $dados[5];
        $transacao->parcela = $dados[3];
        $transacao->valor_parcela = $valor_parcela;
        $transacao->save();

        Venda::where('user_id', Auth::id())->whereNotNull('id_venda')->update(['venda_finalizada' => true]);

        return response()->json();
    }
    public function cancelarVenda(){
        $vendasNaoFinalizadas = Venda::where('venda_finalizada', false)->where('item_cancelado', false)->get();

        foreach ($vendasNaoFinalizadas as $venda) {
            $quantidadeVendida = intval($venda->quantidade);
            $idProduto = intval($venda->id_venda);

            // Encontrar o produto pelo ID
            $produto = Produto::find($idProduto);

            if ($produto) {
                $produto->estoque += $quantidadeVendida;
                $produto->save();
                
                $venda->item_cancelado = true;
                $venda->save();
            }
        }
    }
}
