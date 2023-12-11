<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Produto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    public function venderView(){
        $ultimoRegistroCaixa = Caixa::latest()->first();
        if(!isset($ultimoRegistroCaixa) || $ultimoRegistroCaixa->aberto == true){
            // $produtos = DB::table('produtos')
            // ->select('id', 'nome', 'codigo_barras', 'preco', 'preco_custo', 'lucro', 'estoque', 'fornecedor', 'categoria')
            // ->get();
            // return view('venda.venda', [
            //     'produtos'=>$produtos
            // ]);
            return view('venda.venda');
        }else{
            return view('');
        }
    }
    public function apiListar(Request $request){
        return Produto::where('nome', 'LIKE', "%$request->search%")
            ->orWhere('codigo_barras', 'LIKE', "%$request->search%")
            ->get();
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
}
