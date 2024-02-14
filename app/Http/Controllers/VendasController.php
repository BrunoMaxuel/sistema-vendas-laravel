<?php

namespace App\Http\Controllers;

use App\Services\VendaService;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    protected $vendaService;

    public function __construct(VendaService $vendaService)
    {
        $this->vendaService =$vendaService;
    }

    public function index(){
        return view($this->vendaService->exibirPainelVendas());
    }

    public function buscarProdutos(Request $request){
        return $this->vendaService->buscarDadosParaVenda($request->search);
    }
    
    public function finalizarVenda(Request $request){
        $this->vendaService->finalizarVenda($request);
        return redirect()->route('venda.index')->with('msg', 'msg');
        
    }
    
}
