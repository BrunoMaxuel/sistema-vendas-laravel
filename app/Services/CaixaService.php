<?php
namespace App\Services;

use App\Repositories\CaixaRepository;

class CaixaService{
    protected $repositorioCaixa;

    public function __construct(CaixaRepository $repositorio){
        $this->repositorioCaixa = $repositorio;
    }


    public function painelCaixa(){
        $ultimoRegistroCaixa = $this->repositorioCaixa->consultarUltimoRegistro();
        if(!isset($ultimoRegistroCaixa) || $ultimoRegistroCaixa->aberto == false){
            return false;
        }
        else{ 
            $caixa  = (object) null;  
            $caixa->aberto = $ultimoRegistroCaixa->aberto;
            $caixa->created_at = $ultimoRegistroCaixa->created_at;
            $caixa->descricao = $ultimoRegistroCaixa->descricao;

            $caixa->transacoes = $this->repositorioCaixa
                ->buscarTransacoes($ultimoRegistroCaixa->created_at);

            $caixa->sangrias = $this->repositorioCaixa
                ->buscarSangrias($ultimoRegistroCaixa->created_at);

            $caixa->suprimentos = $this->repositorioCaixa
                ->buscarSuprimentos($ultimoRegistroCaixa->created_at);

            $sangriaTotal = $this->repositorioCaixa
                ->buscarTotalSangria($ultimoRegistroCaixa->created_at);
            $suprimentoTotal = $this->repositorioCaixa
                ->buscarTotalSuprimento($ultimoRegistroCaixa->created_at);


            $caixa->totalCredito = $this->repositorioCaixa
                ->buscarTransacaoCredito($ultimoRegistroCaixa->created_at);
        
            $caixa->totalDebito = $this->repositorioCaixa
                ->buscarTransacaoDebito($ultimoRegistroCaixa->created_at);
            
            $caixa->dinheiro = $this->repositorioCaixa
                ->buscarTransacaoDinheiro($ultimoRegistroCaixa->created_at);

            $caixa->totalCreditoDebito = $caixa->totalCredito + $caixa->totalDebito;
            $caixa->total = $ultimoRegistroCaixa->valor_inicial
                + $caixa->totalCreditoDebito
                - $sangriaTotal
                + $suprimentoTotal
                + $caixa->dinheiro;
            $caixa->valor_inicial = $ultimoRegistroCaixa->valor_inicial;
            return $caixa;
        }
    }
    public function iniciarCaixa($dados){
        $valorInicial         = str_replace('.', '', $dados->valor_inicial);
        $dados->valor_inicial = str_replace(',', '.', $valorInicial);

        if ($this->repositorioCaixa->iniciarCaixaInserir($dados)) {
            return true;
        }
    }
    public function fecharCaixa(){
        if($this->repositorioCaixa->fecharCaixa()){
            return true;
        }
    }

    public function adicionarSuprimento($request){
        $valorAdicionar = str_replace('.', '', $request->valor_inicial);
        $request->valor_inicial = str_replace(',', '.', $valorAdicionar);
        if($this->repositorioCaixa->adicionarSuprimento($request))
        {    
            return response()->json([
                'success' => true,
                'message' => 'Dinheiro adicionado com sucesso!'
    
            ]);
        }
    }

    public function adicionarSangria($request){
        $valorRetirar = str_replace('.', '', $request->valor_inicial);
        $request->valor_inicial = str_replace(',', '.', $valorRetirar);
        if($this->repositorioCaixa->adicionarSangria($request))
        {
            return true;
        }
    }

}