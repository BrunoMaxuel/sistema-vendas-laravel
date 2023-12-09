<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Produto;
use App\Models\Sangria;
use App\Models\Suprimento;
use App\Models\Transacao;
use App\Models\Venda;
use Illuminate\Http\Request;

class CaixaController extends Controller
{   
    public function caixaView(){

        $ultimoRegistro = Caixa::latest()->first();
        if(!isset($ultimoRegistro) || $ultimoRegistro->aberto == false){
            $aberto = true;
            $caixa = null;
            return view('caixa.caixaAbrir', ['aberto'=>$aberto, 'caixa'=>$caixa]);
        }
        else{ 
            $transacoes =  Transacao::all();
            if(!isset($transacoes)){
                $transacoes = null;
            }
            $sangria = Sangria::all(); 
            $entradas = Suprimento::all();
            $detalhes = "";
            
            foreach ($transacoes as $objTransaction){
                $venda = Venda::where('transacao','=', $objTransaction->id)->get();
                $objTransaction->pagamento = str_replace(['DI','CR','DE'],['Dinheiro','Cartão de Crédito','Débido'],$objTransaction->pagamento);
                $objTransaction->desconto = $objTransaction->desconto . "%";

                foreach($venda as $objVenda){
                    $codigo = $objVenda->codigo_estoque;
                    $estoque = Produto::where('codigo','=',$codigo)->first();
                    $detalhes = $estoque->nome. ' | '. $detalhes ;
                }
                $objTransaction->detalhes = $detalhes;
                $detalhes = "";
            }
           
            if(!Caixa::all()){
                $caixaValor = (object) ['valor' => '0,00','inicial'=>'0,00','totalCredito'=>'0,00','totalDebito'=>'0,00','totalC'=>'0,00'];
            }else{
                $caixaValor = new Caixa();
                $caixaValor->valor = number_format($caixaValor->valor, 2, ',', '.');
                $caixaValor->inicial = number_format($caixaValor->inicial, 2, ',', '.');
                $caixaValor->totalCredito = 20.00;
                $caixaValor->totalDebito = 100.00;
                $caixaValor->totalC = 200.00;
            }
            $ultimoValor = Caixa::latest()->first(); 

        return view('caixa.caixa',['aberto'=>$ultimoValor,'caixaValor'=>$caixaValor,'transacoes'=>$transacoes,'sangria'=>$sangria,'entrada'=>$entradas]);
            
        }
    }

    public function caixaAbrir(Request $request){

        $caixa = new Caixa();
        $caixa->valor_inicial = $request->valor_inicial;
        $caixa->descricao = $request->descricao;
        $caixa->aberto = true;

        if ($caixa->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Caixa aberto com sucesso!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao abrir caixa! Falha ao salvar no banco de dados.'
            ]);
        }
        
    }
}
