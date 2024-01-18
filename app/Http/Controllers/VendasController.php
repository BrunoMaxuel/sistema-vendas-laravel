<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Produto;
use App\Models\Transacao;
use App\Models\Venda;
use App\Models\vendasDetalhadas;
use App\Services\SuporteService;
use App\Services\VendaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function vendaEmAndamentoRegistrar(Request $request){
        return $this->vendaService->registrarVenda($request->linha);
    }

    public function vendaEmAndamento(){
        return $this->vendaService->buscarVendaEmAndamento();
    }

    public function cancelarItemVenda(Request $request) {
        $this->vendaService->cancelarItem($request->id_venda);
    }
    
    public function finalizarVenda(Request $request){
        $this->vendaService->finalizarVenda($request);
        return redirect(route('venda.index'));
    }
    
    public function cancelarVenda(){
        $this->vendaService->cancelarVenda();
        
    }
}
