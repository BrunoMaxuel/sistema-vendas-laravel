<?php
namespace App\Repositories;

use App\Models\Transacao;
use Illuminate\Support\Facades\Auth;

class TransacaoRepository{

    protected $modelTransacao;
    public function __construct(Transacao $modelTransacao){
        $this->$modelTransacao = $modelTransacao;
    }
    public function buscarTransacaoId($id){
        return Transacao::where('user_id', Auth::id())->where('id', $id)->first();
    }

    public function criarTransacao($request)
    {
        $transacao                      = new Transacao();
        $transacao->user_id             = Auth::id();
        $transacao->total               = $request->total_venda;
        $transacao->total_item          = $request->total_item;
        $transacao->pagamento           = $request->pagamento;
        $transacao->cliente             = $request->cliente;
        $transacao->venda_com_desconto  = $request->venda_desconto;
        $transacao->desconto            = $request->desconto;
        $transacao->parcela             = $request->parcela;
        $transacao->valor_parcela       = $request->valor_parcela;
        $transacao->save();
        return true;
    }

}