<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Produto;
use App\Models\Sangria;
use App\Models\Suprimento;
use App\Models\Transacao;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaixaController extends Controller
{   
    public function caixaView(){
        $ultimoRegistroCaixa = Caixa::where('user_id', Auth::id())->latest()->first();

        if(!isset($ultimoRegistroCaixa) || $ultimoRegistroCaixa->aberto == false){
            $aberto = false;
            $caixa = null;
            return view('caixa.caixaAbrir', ['aberto'=>$aberto, 'caixa'=>$caixa]);
        }
        else{ 
                $transacoes = Transacao::where('user_id', Auth::id())->where('created_at', '>=', $ultimoRegistroCaixa->created_at)->orderby('id', 'desc')->get();
                $sangrias = Sangria::where('user_id', Auth::id())->where('created_at', '>=', $ultimoRegistroCaixa->created_at)->get();
                $sangriaTotal = Sangria::where('user_id', Auth::id())->where('created_at', '>=', $ultimoRegistroCaixa->created_at)->sum('valor');
                $suprimentoTotal = Suprimento::where('user_id', Auth::id())->where('created_at', '>=', $ultimoRegistroCaixa->created_at)->sum('valor');
                
                $suprimento = Suprimento::where('user_id', Auth::id())->where('created_at', '>=', $ultimoRegistroCaixa->created_at)->get();
                $caixa  = (object) null;       

                $caixa->created_at = $ultimoRegistroCaixa->created_at;
                $caixa->descricao = $ultimoRegistroCaixa->descricao;
                $caixa->totalCredito = Transacao::where('user_id', Auth::id())->where('created_at','>=', $ultimoRegistroCaixa->created_at)
                ->where('pagamento','=','Crédito')
                ->sum('total'); 
            
                $caixa->totalDebito = Transacao::where('user_id', Auth::id())->where('created_at','>=', $ultimoRegistroCaixa->created_at)
                ->where('pagamento','=','Débito')
                ->sum('total'); 
                
                $caixa->dinheiro = Transacao::where('user_id', Auth::id())->where('created_at','>=', $ultimoRegistroCaixa->created_at)
                ->where('pagamento','=','Dinheiro')
                ->sum('total'); 
                $caixa->totalCreditoDebito = $caixa->totalCredito + $caixa->totalDebito;
                $caixa->total = $ultimoRegistroCaixa->valor_inicial;
                $caixa->total += $caixa->totalCreditoDebito;
                $caixa->total -= $sangriaTotal;
                $caixa->total += $suprimentoTotal;
                $caixa->total += $caixa->dinheiro;
                $caixa->valor_inicial = $ultimoRegistroCaixa->valor_inicial;
            
            return view('caixa.caixa',['aberto'=>$ultimoRegistroCaixa->aberto,'caixa'=>$caixa,'transacoes'=>$transacoes,'sangria'=>$sangrias,'entrada'=>$suprimento]);
            
        }
    }

    public function caixaAbrir(Request $request){
        $valorInicial = str_replace('.', '', $request->valor_inicial);
        $caixa = new Caixa();
        $caixa->user_id = Auth::id();
        $caixa->valor_inicial = str_replace(',', '.', $valorInicial);
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
        $caixa = Caixa::where('user_id', Auth::id())->latest()->first();
        $caixa->aberto = false;
        $caixa->save();
        return response()->json([
            'success' => true,
            'message' => 'Caixa fechado com sucesso!'
        ]);
    }
    public function addDinheiro(Request $request){
        $valorAdicionar = str_replace('.', '', $request->valor);
        $valorAdicionar = str_replace(',', '.', $valorAdicionar);
        $suprimento = new Suprimento();
        $suprimento->valor = $valorAdicionar;
        $suprimento->descricao = $request->descricao;
        $suprimento->user_id = Auth::id(); 
        $suprimento->save();
        return response()->json([
            'success' => true,
            'message' => 'Dinheiro adicionado com sucesso!'

        ]);
    }
    public function retirarDinheiro(Request $request){
        $valorRetirar = str_replace('.', '', $request->valor);
        $valorRetirar = str_replace(',', '.', $valorRetirar);
        $sangria = new Sangria();
        $sangria->valor = $valorRetirar;
        $sangria->descricao = $request->descricao;
        $sangria->user_id = Auth::id();
        $sangria->save();
        return response()->json([
            'success' => true,
            'message' => 'Dinheiro removido com sucesso!'

        ]);
    }
}
