<?php

namespace App\Services;

use App\Repositories\VendaRepository;
use Illuminate\Support\Facades\Auth;

class VendaService
{
    protected $vendaRepository;
    public function __construct(VendaRepository $vendaRepository)
    {
        $this->vendaRepository = $vendaRepository;
    }

    public function exibirPainelVendas()
    {
        $ultimoRegistroCaixa = $this->vendaRepository->verificarCaixaAberto();
        if (isset($ultimoRegistroCaixa) && $ultimoRegistroCaixa->aberto == true) {
            return 'venda.venda';
        } else {
            return 'venda.caixaNaoAberto';
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

    public function registrarVenda($produto){
        $this->vendaRepository->salvarVenda($produto);
        $vendas = $this->buscarVendaEmAndamento();
        return response()->json($vendas);
    }

    public function buscarVendaEmAndamento(){
        $resultados = $this->vendaRepository->consultarVendaEmAndamento();
        $vendas = $resultados->map(function ($produto) {
            $produto->preco = number_format($produto->preco, 2, ',', '.');
            $produto->preco_custo = number_format($produto->preco_custo, 2, ',', '.');
            $produto->valor_item = number_format($produto->valor_item, 2, ',', '.');
            $produto->total_venda = number_format($produto->total_venda, 2, ',', '.');
            return $produto;
        });
        return $vendas;
    }

    public function cancelarItem($id_item){
        $this->vendaRepository->cancelarItem($id_item);
    }

    public function finalizarVenda($dados){
        $totalVenda = number_format((float)$dados[0], 2, '.', '');
        $valorParcela = number_format((float)$dados[4], 2, '.', '');
        $vendaComDesconto = number_format((float)$dados[7], 2, '.', '');

        $this->vendaRepository->criarTransacao($totalVenda, $valorParcela, $vendaComDesconto, $dados);
        $vendas = $this->vendaRepository->buscarVendasParaFinalizar();

        foreach ($vendas as $venda) {
            $this->vendaRepository->criarVendaDetalhada($venda);
        }
    }

    public function cancelarVenda(){
        $vendaAndamento = $this->vendaRepository->consultarVendaEmAndamento();
        foreach ($vendaAndamento as $venda) {
            $quantidadeVendida = intval($venda->quantidade);
            $idProduto = intval($venda->id_venda);

            $produto = $this->vendaRepository->consultarProduto($idProduto);
        
            if ($produto) {
                $produto->estoque += $quantidadeVendida;
                $produto->save();
            }
            $venda->delete();
        }
    
    }

}
