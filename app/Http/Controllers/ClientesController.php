<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(){
        $cliente = Clientes::all();
        return view('cliente/index',['clientes'=>$cliente]);
    }
    public function editarView(Request $request){
        dd("Entrou");
        if($request->id != null){
            $cliente = Clientes::where('id', $request->id)->first();
            return $cliente;
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'sem indice na busca!'
            ]);
        }
    }
    public function editarSave(Request $request){
        
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
