<?php
namespace App\Services;

use App\Repositories\ProdutoRepository;
use App\Repositories\TransacaoRepository;
use Illuminate\Support\Facades\Auth;

class TransacaoService{
    protected $repositorioTransacao;

    public function __construct(TransacaoRepository $repositorioTransacao)
    {
        $this->repositorioTransacao = $repositorioTransacao; 
    }

    public function editarTransacao($request){
        if($request->desconto == "" || $request->desconto == "%"){
            $request->desconto = "0";
        }
        $valor_parcela    = str_replace(['.', ','], ['', '.'], $request->valor_parcela);
        $vendaComDesconto = str_replace(['.', ','], ['', '.'], $request->venda_desconto);
        $transacao = $this->repositorioTransacao->buscarTransacaoId($request->id_transacao);
        if ($transacao) {
            $transacao->pagamento          = $request->pagamento;
            $transacao->parcela            = str_replace('x', '', $request->parcela);
            $transacao->valor_parcela      = $valor_parcela;
            $transacao->desconto           = str_replace('%', '', $request->desconto);
            $transacao->cliente            = $request->cliente;
            $transacao->venda_com_desconto = $vendaComDesconto;
            $transacao->save();
            return response()->json("feito");
        } else {
            return response()->json(['error' => 'Transação não encontrada']);
        }
    }
}