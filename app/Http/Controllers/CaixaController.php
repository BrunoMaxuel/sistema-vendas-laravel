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

        $ultimoRegistroCaixa = Caixa::latest()->first();
        if(!isset($ultimoRegistroCaixa) || $ultimoRegistroCaixa->aberto == false){
            $aberto = false;
            $caixa = null;
            return view('caixa.caixaAbrir', ['aberto'=>$aberto, 'caixa'=>$caixa]);
        }
        else{ 
            $transacoes = Transacao::where('created_at', '>=', $ultimoRegistroCaixa->created_at)->get();
            $sangria = Sangria::where('created_at', '>=', $ultimoRegistroCaixa->created_at)->get();
            $sangriaTotal = Sangria::where('created_at', '>=', $ultimoRegistroCaixa->created_at)->sum('valor');
            $suprimentoTotal = Suprimento::where('created_at', '>=', $ultimoRegistroCaixa->created_at)->sum('valor');
            
            $suprimento = Suprimento::where('created_at', '>=', $ultimoRegistroCaixa->created_at)->get();
            $caixa  = (object) null;       
            $caixa->total = str_replace(',', '.', str_replace('.', '', $ultimoRegistroCaixa->valor_inicial));

            $caixa->created_at = $ultimoRegistroCaixa->created_at;
            $caixa->descricao = $ultimoRegistroCaixa->descricao;
            $caixa->totalCredito = Transacao::where('created_at','>=', $ultimoRegistroCaixa->created_at)
                ->where('pagamento','=','Crédito')
                ->sum('total'); 
            
            $caixa->totalDebito = Transacao::where('created_at','>=', $ultimoRegistroCaixa->created_at)
                ->where('pagamento','=','Débito')
                ->sum('total'); 
                
            $caixa->dinheiro = Transacao::where('created_at','>=', $ultimoRegistroCaixa->created_at)
                ->where('pagamento','=','Dinheiro')
                ->sum('total'); 
                
                $caixa->totalCreditoDebito = $caixa->totalCredito + $caixa->totalDebito;

                $caixa->total += $caixa->totalCreditoDebito;
                $caixa->total -= $sangriaTotal;
                $caixa->total += $suprimentoTotal;
                $caixa->total += $caixa->dinheiro;

                
                
                $caixa->valor_inicial = $ultimoRegistroCaixa->valor_inicial;      
            
            return view('caixa.caixa',['aberto'=>$ultimoRegistroCaixa->aberto,'caixa'=>$caixa,'transacoes'=>$transacoes,'sangria'=>$sangria,'entrada'=>$suprimento]);
            
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
    public function fecharCaixa(){
        $caixa = new Caixa();
        $caixa->aberto = false;
        $caixa->save();
        return response()->json([
            'success' => true,
            'message' => 'Caixa fechado com sucesso!'
        ]);
    }
    public function addDinheiro(Request $request){
        $suprimento = new Suprimento();
        $suprimento->valor = $request->valor;
        $suprimento->descricao = $request->descricao;
        $suprimento->save();
        return response()->json([
            'success' => true,
            'message' => 'Dinheiro adicionado com sucesso!'

        ]);
    }
    public function retirarDinheiro(Request $request){
        $sangria = new Sangria();
        $sangria->valor = $request->valor;
        $sangria->descricao = $request->descricao;
        $sangria->save();
        return response()->json([
            'success' => true,
            'message' => 'Dinheiro removido com sucesso!'

        ]);
    }
}
