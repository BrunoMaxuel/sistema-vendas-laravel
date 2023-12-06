<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(){
        $quantidade = 10; // Define a quantidade de itens por página
    
        $clientes = Cliente::paginate($quantidade);
        
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
        try{
            $cliente = null;
            if(!blank($request->id)){
                $cliente = Cliente::find($request->id);
            }
    
            if($cliente == null){
                $cliente = new Cliente;
            }
    
            $cliente->nome      = $request->nome;
            $cliente->sexo      = $request->sexo;
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
        $cliente = new Cliente;
        $cliente->nome          = $request->nome;
        $cliente->sexo          = $request->sexo;
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
