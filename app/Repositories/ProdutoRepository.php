<?php
namespace App\Repositories;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class ProdutoRepository{
    protected $produto;
    public function __construct(Produto $produto){
        $this->produto = $produto;
    }   

    public function buscarTodosProdutos(){
        return $this->produto->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
    }

    public function buscarProdutoPorId($request){
        return $this->produto->where('user_id', Auth::id())->where('id', $request->id)->first();
    }

    public function adicionarProduto($request){
        $produto = new $this->produto;
        $produto->user_id       = Auth::id();
        $produto->nome          = $request->nome;
        $produto->codigo_barras = $request->codigo_barras;
        $produto->preco         = $request->preco;
        $produto->preco_custo   = $request->preco_custo;
        $produto->lucro         = $request->lucro;
        $produto->estoque       = $request->estoque;
        $produto->fornecedor    = $request->fornecedor;
        $produto->categoria     = $request->categoria;
        if($produto->save()){
                return response()->json([
                    'success' => true,
                    'message' => 'Produto Adicionado Com Sucesso!'
            ]);
        }
    }
    public function editarProduto($request){
        $produto  = $this->buscarProdutoPorId($request);
        $produto->user_id       = Auth::id();
        $produto->nome          = $request->nome;
        $produto->codigo_barras = $request->codigo_barras;
        $produto->preco         = $request->preco;
        $produto->preco_custo   = $request->preco_custo;
        $produto->lucro         = $request->lucro;
        $produto->estoque       = $request->estoque;
        $produto->fornecedor    = $request->fornecedor;
        $produto->categoria     = $request->categoria;
        if($produto->save()){
                return response()->json([
                    'success' => true,
                    'message' => 'Produto Alterado Com Sucesso!'
            ]);
        }
    }
}