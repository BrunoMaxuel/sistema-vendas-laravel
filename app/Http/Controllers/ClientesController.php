<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Services\ClienteService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    protected $clienteService;
    public function __construct(ClienteService $cliente)
    {
        $this->clienteService = $cliente;
    }
    public function index(){ 
        $clientes = $this->clienteService->buscarTodosClientes();
        return view('cliente/index', ['clientes' => $clientes]);
    }
    
    public function editarCliente(Request $request){
        $this->clienteService->editarCliente($request);
        return redirect(route('cliente.index'));
    }
    
    public function excluirCliente(Request $request){
        if($this->clienteService->excluirCliente($request)){
            return redirect(route('cliente.index'));
        }
    }
    public function search(Request $request)
    {
        $clientes = $this->clienteService->pesquisarCliente($request);
        if($clientes){
            return $clientes;
        }
    }

    public function adicionarCliente(Request $request){
        if($this->clienteService->adicionarCliente($request)){
            return redirect(route('cliente.index'));
        }
    }
    public function painelAdicionar(){
        return view('cliente.adicionar');
   }
}
