<?php

namespace App\Services;
use App\Repositories\TransacaoRepository;
use App\Repositories\VendaRepository;
use Illuminate\Support\Facades\Auth;

class VendaService
{
    protected $vendaRepository;
    protected $repositoryTransacao;
    public function __construct(VendaRepository $vendaRepository, TransacaoRepository $repositoryTransacao)
    {
        $this->vendaRepository = $vendaRepository;
        $this->repositoryTransacao = $repositoryTransacao;
    }

    public function exibirPainelVendas()
    {
        $ultimoRegistroCaixa = $this->vendaRepository->verificarCaixaAberto();
        if (isset($ultimoRegistroCaixa) && $ultimoRegistroCaixa->aberto == true) {
            return 'venda';
        } else {
            return 'caixaAbrir';
        }
    }

    public function buscarDadosParaVenda($search){
        if(strlen($search) < 13){
            $produtos = $this->vendaRepository->buscarProdutoPorNome($search);

            $produtosFormatados = $produtos->map(function ($produto) {
                $produto->preco = number_format($produto->preco, 2, ',', '.');
                $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '.');
                return $produto;
            });
            return $produtosFormatados;
        }else if(strlen($search) === 13 && ctype_digit($search)){
            return $this->vendaRepository->buscarPorCodigoBarras($search);
        }
    }

    public function finalizarVenda($request){
        if($request->desconto == "" || $request->desconto == "%"){
            $request->desconto = "0";
        }
        $request->desconto         = str_replace('%', '', $request->desconto);
        $request->parcela         = str_replace('x', '', $request->parcela);
        $request->valor_parcela    = str_replace(['.', ','], ['', '.'], $request->valor_parcela);
        $request->venda_desconto = str_replace(['.', ','], ['', '.'], $request->venda_desconto);
        $request->total_venda = str_replace(['.', ','], ['', '.'], $request->total_venda);
        $transacao = $this->repositoryTransacao->criarTransacao($request);
        if ($transacao) {
            $vendas = json_decode($request->venda_detalhada);

            foreach ($vendas as $venda) {
                
                $this->vendaRepository->criarVendaDetalhada($venda);
            }
        } 
        return true;
    }

}
