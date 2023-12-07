<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    public function index(){
        $quantidade = 10;
        $produtos = Produto::orderBy('id', 'desc')->paginate($quantidade);

        return view('produto/index', ['produtos'=>$produtos]);
    }

    public function editarView(Request $request){
        if($request->id != null){
            $produto = Produto::where('id', $request->id)->first();
            return response()->json($produto);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'sem indice na busca!'
            ]);
        }
    }

    public function saveEditar(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'nome' => 'required|max:100',
                'preco' => 'required',
                'preco_custo' => 'required',
                'lucro' => 'required',
                'estoque' => 'required',
                // Adicione aqui as regras de validação para os demais campos
            ], [
                'nome.required' => 'Por favor, preencha o campo nome.',
                'preco.required' => 'O campo preço é obrigatório.',
                'preco_custo.required' => 'O campo preço de custo é obrigatório.',
                'lucro.required' => 'O campo lucro é obrigatório.',
                'estoque.required' => 'O campo estoque é obrigatório.',
                // Adicione mensagens para os demais campos
            ]);
            
        
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro na validação',
                    'errors' => $validator->errors()
                ]);// Código de status HTTP para erros de validação 
            }
        
            $produto = null;
            if(!blank($request->id)){
                $produto = Produto::find($request->id);
            }
    
            if($produto == null){
                $produto = new Produto();
            }
    
            $produto->nome      = $request->nome;
            $produto->codigo_barras      = $request->codigo_barras;
            $produto->preco  = $request->preco;
            $produto->preco_custo  = $request->preco_custo;
            $produto->lucro    = $request->lucro;
            $produto->estoque    = $request->estoque;
            $produto->fornecedor    = $request->fornecedor;
            $produto->categoria    = $request->categoria;
    
            if($produto->save()){
                if(!blank($request->id)){
                    return response()->json([
                        'success' => true,
                        'message' => 'Produto alterado com sucesso!'
                    ]);
                } else {
                    return response()->json([
                        'success' => true,
                        'message' => 'Produto adicionado com sucesso!'
                    ]);
                }
            }
        } catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function search(Request $request){
        $query = $request->input('query');

        $produtos = Produto::where('nome', 'LIKE', "%$query%")
                            ->orWhere('codigo_barras', 'LIKE', "%$query%")
                            ->paginate(10);

        return view('produto/index', ['produtos' => $produtos]);
    }
}
