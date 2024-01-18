<?php
namespace App\Services;

use App\Repositories\ProdutoRepository;
use Illuminate\Support\Facades\Auth;

class ProdutoService{

    protected $produtoRepository;
    public function __construct(ProdutoRepository $produtoRepository){
        $this->produtoRepository = $produtoRepository;
    }

    public function buscarTodosProdutos(){
        return $this->produtoRepository->buscarTodosProdutos();
    }

    public function edit($request){
        if($request->id != null){
            $produto = $this->produtoRepository->buscarProdutoPorId($request);
            $produto->preco = number_format($produto->preco, 2, ',', '.');
            $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '.');
            return response()->json($produto);
        }
    }
    public function buscaParaExclusao($request){
        if($request->id != null){
            $produto = $this->produtoRepository->buscarProdutoPorId($request);
            return response()->json($produto);
        }
    }

    public function excluirProduto($request){
        if ($request->id) {
            $produto =  $this->produtoRepository->buscarProdutoPorId($request);
            if ($produto) {
                $produto->delete();
            }
        } 
    }
    public function adicionarProduto($request){
        $request->preco       = number_format((float)$request->preco, 2, '.', '');
        $request->preco_custo = number_format((float)$request->preco_custo, 2, '.', '');
        $request->lucro       = str_replace('%', '', $request->lucro);
        return $this->produtoRepository->adicionarProduto($request);
    }
    public function editarProduto($request){
        $request->preco       = number_format((float)$request->preco, 2, '.', '');
        $request->preco_custo = number_format((float)$request->preco_custo, 2, '.', '');
        $request->lucro       = str_replace('%', '', $request->lucro);
        return $this->produtoRepository->editarProduto($request);
    }

}