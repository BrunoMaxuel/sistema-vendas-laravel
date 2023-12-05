<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Exception;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(){
        $cliente = Clientes::all();
        return view('cliente/index',['clientes'=>$cliente]);
    }
    public function editarView(Request $request){
        if($request->id != null){
            $cliente = Clientes::where('id', $request->id)->first();
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
            $cliente = Clientes::find($request->id);
            $cliente->nome          = $request->nome;
            $cliente->sexo          = $request->sexo;
            $cliente->telefone      = $request->telefone;
            $cliente->endereco      = $request->endereco;
            $cliente->bairro        = $request->bairro;
            $cliente->cidade        = $request->cidade;
            $cliente->estado        = $request->estado;
            if($cliente->save()){
                return response()->json([
                'success' => true,
                    'message' => 'Alterado com sucesso!'
                ]);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Algum erro ocorreu no sistema!'
                ]);
            }
        
        }catch(Exception $e){
            return response()->json([
                'success' => 'false',
                'message' => $e
            ]);
        }
         
     }
    public function excluirCliente(Request $request){
        if($request->id != null){
            $cliente = Clientes::where('id', $request->id)->first();
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
            $cliente = Clientes::find($request->id);
            
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
    

    public function cadastrarCliente(Request $request){

        // $cliente = new Cliente;
        // $cliente->nome          = $request->nome;
        // $cliente->CPF           = $request->CPF;
        // $cliente->sexo          = $request->sexo;
        // $cliente->nascimento    = $request->nascimento;
        // $cliente->telefone      = $request->telefone;
        // $cliente->cep           = $request->cep;
        // $cliente->endereco      = $request->endereco;
        // $cliente->bairro        = $request->bairro;
        // $cliente->cidade        = $request->cidade;
        // $cliente->estado        = $request->estado;
        
        // try{
        //     $cliente->save();
        //     return response()->json([
        //         'success' => "true",               
        //         'message' => 'Cliente cadastrado com sucesso'
        //     ]);
        // }catch (QueryException  $e){
        //     $error_code = $e->errorInfo[1];
        //     if($error_code == 1062){
        //        return response()->json([
        //             'success' => 'false',
        //             'message' => 'CPF já cadastrado no sistema!'
        //         ]);
        //     }
        // }
   }
}
