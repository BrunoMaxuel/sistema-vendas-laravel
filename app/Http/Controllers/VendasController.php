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

    public function venderView(){
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
        $this->vendaService->finalizarVenda($request->dados);
        // $dados = $request->dados;
        // $totalVenda = str_replace('.', '', $dados[0]);
        // $totalVenda = str_replace(',', '.', $totalVenda);
        // $valor_parcela = str_replace('.', '', $dados[4]);
        // $valor_parcela = str_replace(',', '.', $valor_parcela);
        // $vendaComDesconto = str_replace('.', '', $dados[7]);
        // $vendaComDesconto = str_replace(',', '.', $vendaComDesconto);

        // $transacao = new Transacao();
        // $transacao->user_id = Auth::id(); 
        // $transacao->total = $totalVenda;
        // $transacao->total_item = $dados[1];
        // $transacao->pagamento = $dados[2];
        // $transacao->cliente = $dados[6];
        // $transacao->venda_com_desconto = $vendaComDesconto;
        // $transacao->desconto = $dados[5];
        // $transacao->parcela = $dados[3];
        // $transacao->valor_parcela = $valor_parcela;
        // $transacao->save();

        // $vendas = Venda::where('venda_finalizada', false)->get();        
        // foreach ($vendas as $venda) {
        //     $vendaDetalhada = new vendasDetalhadas();
        //     $vendaDetalhada->user_id = Auth::id();
        //     $vendaDetalhada->nome_produto = $venda->nome_produto;
        //     $vendaDetalhada->codigo_barras = $venda->codigo_barras;
        //     $vendaDetalhada->quantidade = $venda->quantidade;
        //     $vendaDetalhada->valor_item = $venda->valor_item;
        //     $vendaDetalhada->total_venda = $venda->total_venda;
        //     $vendaDetalhada->item_cancelado = $venda->item_cancelado;
        //     $vendaDetalhada->id_transacao = $transacao->id;
        //     $vendaDetalhada->save();
        // }
        
        // Venda::where('user_id', Auth::id())->update(['venda_finalizada' => true]);

        // return response()->json();
    }
    public function cancelarVenda(){
        $vendasNaoFinalizadas = Venda::where('venda_finalizada', false)->where('item_cancelado', false)->get();

        foreach ($vendasNaoFinalizadas as $venda) {
            $quantidadeVendida = intval($venda->quantidade);
            $idProduto = intval($venda->id_venda);

            // Encontrar o produto pelo ID
            $produto = Produto::find($idProduto);

            if ($produto) {
                $produto->estoque += $quantidadeVendida;
                $produto->save();
                
                $venda->item_cancelado = true;
                $venda->save();
            }
        }
    }
}
