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

    public function index(){
        $caixa = $this->caixa->painelCaixa();
        if($caixa !== false &&  $caixa->aberto) {
            return view('caixa.caixa', ['caixa' =>$caixa]);
        } else {
            return view('caixa.caixaAbrir');
        }
    }
    public function iniciarCaixa(Request $request){
        if($this->caixa->iniciarCaixa($request)){
            return redirect(route('caixa.index'));
        }
    }
    public function fecharCaixa(){
        if($this->caixa->fecharCaixa()){
            return redirect(route('caixa.index'));
        }
    }
    public function adicionarSuprimento(Request $request){
        if($this->caixa->adicionarSuprimento($request)){
            return redirect(route('caixa.index'));
        }
    }
    public function adicionarSangria(Request $request){
        if($this->caixa->adicionarSangria($request)){
            return redirect(route('caixa.index'));
        }
    }
}
