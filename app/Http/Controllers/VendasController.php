<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Produto;
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
    
    public function apiDelete(Request $request){
        try{
            $produto = Produto::where("id",'=',$request->id)->first();
            $produto->delete();
            return array("success"=>true);
        }catch (QueryException $e){
            return array(
                "success"=>false, "message"=> $e->getMessage(),"error"=>$e->errorInfo[1]
            );
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
    public function registrarVenda(Request $request){
        $dadosTabela = $request->input('tableData');

        foreach ($dadosTabela as $dados) {
            $venda = new Venda(); 
            $venda->nome_produto = $dados[1]; // Ajuste os índices conforme a estrutura dos dados
            $venda->codigo_barras = $dados[2];
            $venda->preco = $dados[3];
            $venda->preco_custo = $dados[4];
            $venda->estoque = $dados[5];
            $venda->save();
            // $table->string('nome_produto');
            // $table->string('codigo_barras')->nullable();
            // $table->integer('quantidade');
            // $table->string('valor_item');
            // $table->string('desconto');
            // $table->string('pagamento');
            // $table->string('parcelas');
            // $table->string('valor_parcelas');
            // $table->string('total_venda');
        }

        return response()->json(['message' => 'Dados salvos com sucesso']);
    }
}
