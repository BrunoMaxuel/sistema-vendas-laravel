<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Produto;
use App\Models\Sangria;
use App\Models\Suprimento;
use App\Models\Transacao;
use App\Models\Venda;
use App\Services\CaixaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaixaController extends Controller
{   
    protected $caixa;
    public function __construct(CaixaService $caixa)
    {
        $this->caixa = $caixa;
    }

    public function caixaView(){
        $caixa = $this->caixa->painelCaixa();
        
        if($caixa !== false &&  $caixa->aberto) {
            return view('caixa.caixa', ['caixa' =>$caixa]);
        } else {
            return view('caixa.caixaAbrir');
        }
    }
    public function caixaAbrir(Request $request){
        return $this->caixa->iniciarCaixa($request);        
    }
    public function fecharCaixa(){
        return $this->caixa->fecharCaixa();
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
