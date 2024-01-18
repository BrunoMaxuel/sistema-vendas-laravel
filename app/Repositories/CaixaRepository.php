<?php
namespace App\Repositories;

use App\Models\Caixa;
use App\Models\Sangria;
use App\Models\Suprimento;
use App\Models\Transacao;
use Illuminate\Support\Facades\Auth;

class CaixaRepository{
    protected $caixa;
    protected $transacao;
    protected $suprimento;
    protected $sangria;
    public function __construct(Caixa $caixa, Transacao $transacao, Sangria $sangria, Suprimento $suprimento)
    {
        $this->caixa = $caixa;
        $this->transacao = $transacao;
        $this->suprimento = $suprimento;
        $this->sangria = $sangria;
    }

    public function consultarUltimoRegistro(){
        return $this->caixa
        ->where('user_id', Auth::id())->latest()->first();
    }

    public function buscarTransacoes($dataCaixaAberto){
        return $this->transacao
            ->where('user_id', Auth::id())
            ->where('created_at', '>=', $dataCaixaAberto)->orderby('id', 'desc')->get();
    }

    public function buscarSangrias($dataCaixaAberto){
        return $this->sangria
            ->where('user_id', Auth::id())
            ->where('created_at', '>=', $dataCaixaAberto)->get();
    }

    public function buscarSuprimentos($dataCaixaAberto){
        return $this->suprimento
        ->where('user_id', Auth::id())
        ->where('created_at', '>=', $dataCaixaAberto)->get();
    }

    public function buscarTotalSangria($dataCaixaAberto){
        return $this->sangria
        ->where('user_id', Auth::id())
        ->where('created_at', '>=', $dataCaixaAberto)->sum('valor');
    }

    public function buscarTotalSuprimento($dataCaixaAberto){
        return $this->suprimento
        ->where('user_id', Auth::id())
        ->where('created_at', '>=', $dataCaixaAberto)->sum('valor');
    }

    public function buscarTransacaoCredito($dataCaixaAberto){
        return $this->transacao
            ->where('user_id', Auth::id())
            ->where('created_at', '>=', $dataCaixaAberto)
            ->where('pagamento', 'Crédito')->sum('total');
    }

    public function buscarTransacaoDebito($dataCaixaAberto){
        return $this->transacao
            ->where('user_id', Auth::id())
            ->where('created_at', '>=', $dataCaixaAberto)
            ->where('pagamento', 'Débito')->sum('total');
    }
    public function buscarTransacaoDinheiro($dataCaixaAberto){
        return $this->transacao
            ->where('user_id', Auth::id())
            ->where('created_at', '>=', $dataCaixaAberto)
            ->where('pagamento', 'Dinheiro')->sum('total');
    }
    public function iniciarCaixaInserir($dados){
        $caixa = new Caixa();
        $caixa->user_id = Auth::id();
        $caixa->valor_inicial = $dados->valor_inicial;
        $caixa->descricao = $dados->descricao;
        $caixa->aberto = true;
        $caixa->save();
        return true;
    }
    public function fecharCaixa(){
        $caixa = Caixa::where('user_id', Auth::id())->latest()->first();
        $caixa->aberto = false;
        $caixa->save();
        return true;
    }

    public function adicionarSuprimento($request){
        $suprimento = new Suprimento();
        $suprimento->valor = $request->valor_inicial;
        $suprimento->descricao = $request->descricao;
        $suprimento->user_id = Auth::id(); 
        $suprimento->save();
        return true;
    }

    public function adicionarSangria($request){
        $sangria = new Sangria();
        $sangria->valor = $request->valor_inicial;
        $sangria->descricao = $request->descricao;
        $sangria->user_id = Auth::id();
        $sangria->save();
        return true;
    }
}