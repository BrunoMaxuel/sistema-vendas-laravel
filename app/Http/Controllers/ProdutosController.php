<?php
namespace App\Http\Controllers;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    public function index(){

        $produtos = Produto::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('produto/index', ['produtos'=>$produtos]);
    }

    public function editarView(Request $request){
        if($request->id != null){
            $produto = Produto::where('user_id', Auth::id())->where('id', $request->id)->first();
            $produto->preco = number_format($produto->preco, 2, ',', '.');
            $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '.');

            return response()->json($produto);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'sem indice na busca!'
            ]);
        }
    }

    public function produtosViewAdicionar(){
        return view('produto.adicionar');
    }

    public function excluirProduto(Request $request){
        if($request->id != null){
            $produto = Produto::where('id', $request->id)->first();
            return response()->json($produto);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'sem indice na busca!'
            ]);
        }
    }
    public function excluirProdutoAction(Request $request) {
        if ($request->id) {
            $produto = Produto::find($request->id);
            
            if ($produto) {
                $produto->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Cliente excluído com sucesso!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Cliente não encontrado!'
                ], 404); 
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum ID fornecido para exclusão!'
            ], 400); // Indica uma requisição inválida (400 Bad Request)
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
                ]);
            }
            
            $produto = null;
            if(!blank($request->id)){
                $produto = Produto::find($request->id);
            }
    
            if($produto == null){
                $produto = new Produto();
            }
            $preco = str_replace('.', '', $request->preco);
            $preco = str_replace(',', '.', $preco);
            $preco_custo = str_replace('.', '', $request->preco_custo);
            $preco_custo = str_replace(',', '.', $preco_custo);
            $produto->user_id = Auth::id();
            $produto->nome      = $request->nome;
            $produto->codigo_barras      = $request->codigo_barras;
            $produto->preco  = $preco;
            $produto->preco_custo  = $preco_custo;
            $produto->lucro    = str_replace('%', '', $request->lucro);
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

       if($query != null){
            $produtos = Produto::where('user_id', Auth::id())->where('nome', 'LIKE', "%$query%")
            ->orWhere('codigo_barras', 'LIKE', "%$query%")->orderby('id', 'desc')->get();
            return view('produto/index', ['produtos' => $produtos]);
       }else{
            $produtos = Produto::where('user_id', Auth::id())->get();
            return view('produto/index', ['produtos' => $produtos]);
       }
    }
}
