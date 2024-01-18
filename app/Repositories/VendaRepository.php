<?php
namespace App\Repositories;

use App\Models\Caixa;
use App\Models\Produto;
use App\Models\Transacao;
use App\Models\Venda;
use App\Models\vendasDetalhadas;
use Illuminate\Support\Facades\Auth;

class VendaRepository
{
    protected $venda;
    protected $caixa;
    public function __construct(Venda $venda, Caixa $caixa)
    {
        $this->venda = $venda;
        $this->caixa = $caixa;
    }

    public function verificarCaixaAberto()
    {
        return $this->caixa->where('user_id', Auth::id())->latest()->first();
    }

    public function buscarVendasParaFinalizar()
    {
        $vendas = Venda::where('venda_finalizada', false)->get();
        Venda::where('user_id', Auth::id())->update(['venda_finalizada' => true]);
        return $vendas;
    }

    public function buscarProdutoPorNome($search){
        return Produto::where('user_id', Auth::id())
            ->where('nome', 'LIKE', "%$search%")
            ->get();
    }
    public function buscarPorCodigoBarras($search){
        return Produto::where('user_id', Auth::id())->where('codigo_barras', $search)->first();
    }
    public function salvarVenda($produto){
        $coluna               = $produto;
        $produtoTotal         = $coluna[3] * $coluna[6];  
        $venda                = new Venda();
        $venda->user_id       = Auth::id();
        $venda->nome_produto  = $coluna[1];
        $venda->codigo_barras = $coluna[2];
        $venda->quantidade    = $coluna[6];
        $venda->valor_item    = $coluna[3];
        $venda->total_venda   = $produtoTotal;
        $venda->id_venda      = $coluna[0];
        $venda->save();
        Produto::where('user_id', Auth::id())->where('id', $coluna[0])->decrement('estoque', $coluna[6]);
    }
    public function consultarVendaEmAndamento(){
        $resultados = Venda::where('user_id', Auth::id())->where('venda_finalizada', false)->where('item_cancelado', false)->get();
        return $resultados;
    }
    public function cancelarItem($id_item){
        Venda::where('user_id', Auth::id())->where('id_venda', $id_item)->update(['item_cancelado' => true]);
    }

    public function criarVendaDetalhada($venda){
        $transacao                      = Transacao::orderBy('id', 'desc')->latest()->first();
        $vendaDetalhada                 = new vendasDetalhadas();
        $vendaDetalhada->user_id        = Auth::id();
        $vendaDetalhada->nome_produto   = $venda->nome_produto;
        $vendaDetalhada->codigo_barras  = $venda->codigo_barras;
        $vendaDetalhada->quantidade     = $venda->quantidade;
        $vendaDetalhada->valor_item     = $venda->valor_item;
        $vendaDetalhada->total_venda    = $venda->total_venda;
        $vendaDetalhada->item_cancelado = $venda->item_cancelado;
        $vendaDetalhada->id_transacao   = $transacao->id;
        $vendaDetalhada->save();
    }
    public function consultarProduto($consulta){
        return Produto::find($consulta);
    }
}

