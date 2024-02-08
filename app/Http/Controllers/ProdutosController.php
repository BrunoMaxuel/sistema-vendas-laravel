<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use App\Services\ProdutoService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    protected $produtoService;
    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }

    public function index(){
        $produtos = $this->produtoService->buscarTodosProdutos();
        return view('produtos', ['produtos'=>$produtos]);
    }

    public function editarView(Request $request){
        return $this->produtoService->edit($request);
    }

    public function produtosViewAdicionar(){
        return view('produto.adicionar');
    }

    public function buscarProdutoPorId(Request $request){
        return $this->produtoService->buscaParaExclusao($request);
    }
    public function excluirProduto(Request $request) {
        $this->produtoService->excluirProduto($request);
        return redirect()->route('produto.index');
    }

    public function novoProduto(ProdutoRequest $request){
        return $this->produtoService->adicionarProduto($request);
    }

    public function editarProduto(ProdutoRequest $request){
        return $this->produtoService->editarProduto($request);
    }

    public function search(Request $request){
        $query = $request->input('query');

       if($query != null){
            $produtos = Produto::where('user_id', Auth::id())->where('nome', 'LIKE', "%$query%")
            ->orWhere('codigo_barras', 'LIKE', "%$query%")->orderby('id', 'desc')->get();
            $produtos = $produtos->map(function($produto){
                $produto->preco = number_format($produto->preco, 2, ',', '');
                $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '');
                return $produto;
            });
            return $produtos;
       }else{
            $produtos = Produto::where('user_id', Auth::id())->get();
            $produtos = $produtos->map(function($produto){
                $produto->preco = number_format($produto->preco, 2, ',', '');
                $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '');
                return $produto;
            });
            return $produtos;
       }
    }
}
