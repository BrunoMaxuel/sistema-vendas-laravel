<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    public function index(){
        $quantidade = 10; // Define a quantidade de itens por página
    
        $clientes = Cliente::orderBy('id', 'desc')->paginate($quantidade);
        
        return view('cliente/index', ['clientes' => $clientes]);
    }
    
    public function editarView(Request $request){
        


        if($request->id != null){
            $cliente = Cliente::where('id', $request->id)->first();
            return response()->json($cliente);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'sem indice na busca!'
            ]);
        }
    }
    public function saveEditar(Request $request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
        ], [
            'nome.required' => 'Por favor, preencha o campo nome.',
            // Adicione mensagens para os demais campos
        ]);
        
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro na validação',
                'errors' => $validator->errors()
            ]);// Código de status HTTP para erros de validação 
        }
        try{
            $cliente = null;
            if(!blank($request->id)){
                $cliente = Cliente::find($request->id);
            }
    
            if($cliente == null){
                $cliente = new Cliente;
            }
    
            $cliente->nome      = $request->nome;
            $cliente->telefone  = $request->telefone;
            $cliente->endereco  = $request->endereco;
            $cliente->bairro    = $request->bairro;
            $cliente->cidade    = $request->cidade;
    
            if($cliente->save()){
                if(!blank($request->id)){
                    return response()->json([
                        'success' => true,
                        'message' => 'Cliente alterado com sucesso!'
                    ]);
                } else {
                    return response()->json([
                        'success' => true,
                        'message' => 'Cliente adicionado com sucesso!'
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
    
    public function excluirCliente(Request $request){
        if($request->id != null){
            $cliente = Cliente::where('id', $request->id)->first();
            return response()->json($cliente);
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'sem indice na busca!'
            ]);
        }
    }
    public function excluirClienteAction(Request $request) {
        if ($request->id) {
            $cliente = Cliente::find($request->id);
            
            if ($cliente) {
                $cliente->delete();
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
    public function search(Request $request)
    {
        $query = $request->input('query');

        $clientes = Cliente::where('nome', 'LIKE', "%$query%")
                            ->orWhere('endereco', 'LIKE', "%$query%")
                            ->paginate(10);

        return view('cliente/index', ['clientes' => $clientes]);
    }


    public function adicionarCliente(Request $request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
        ], [
            'nome.required' => 'Por favor, preencha o campo nome.',
            // Adicione mensagens para os demais campos
        ]);
        
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro na validação',
                'errors' => $validator->errors()
            ]);// Código de status HTTP para erros de validação 
        }
        $cliente = new Cliente;
        $cliente->nome          = $request->nome;
        $cliente->telefone      = $request->telefone;
        $cliente->endereco      = $request->endereco;
        $cliente->bairro        = $request->bairro;
        $cliente->cidade        = $request->cidade;
        if($cliente->save()){
            return response()->json([
                'success' => true,
            ]);
        }
   }
    public function adicionarClienteView(){
        return view('cliente.adicionar');
   }
}
