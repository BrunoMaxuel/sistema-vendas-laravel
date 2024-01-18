<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransacaoRequest;
use App\Models\Transacao;
use App\Models\Venda;
use App\Models\vendasDetalhadas;
use App\Services\TransacaoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoVendasController extends Controller
{
    protected $transacaoService;

    public function __construct(TransacaoService $transacaoService)
    {   
        $this->transacaoService = $transacaoService;
    }

    public function index(){
        $transacao = Transacao::where('user_id', Auth::id())->orderby('id', 'desc')->get();
        return view('relatorio.historicoVendas', ['transactions' => $transacao]);
    }   
    public function editarTransacao(TransacaoRequest $request){
        return $this->transacaoService->editarTransacao($request);
    }
    
    public function excluirTransacao(Request $request){
        $id = $request->id;
        $transacao = Transacao::where('user_id', Auth::id())->where('id', $id)->first();
    
        if($transacao){
            $transacao->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Transação não encontrada ou você não tem permissão para excluí-la']);
        }
    }
    
    public function historicoAPI(){
        $tr = Transacao::where('id', Auth::id())->orderby('id', 'desc')->get();
        foreach ($tr as $value){
            $value->total = number_format($value->total, 2, ',', '.');
        }
        return $tr;
    }
    public function historicoBuscarDetalhes(Request $request){
        $id_transacao = $request->dataId;
        $vendaDetalhe = vendasDetalhadas::where('user_id', Auth::id())->where('item_cancelado', false)->where('id_transacao', $id_transacao)->get();
        return response()->json($vendaDetalhe);
    }

    public function imprimirVendas(){
        $transacoes = Transacao::where('user_id', Auth::id())->get();
        $vendasDetalhada = vendasDetalhadas::where('user_id', Auth::id())->where('item_cancelado', false)->get();
        
        return view('relatorio.imprimirTodasVendas', ['transacoes' => $transacoes, 'vendasDetalhada' => $vendasDetalhada]);
    }

    public function imprimirVenda(Request $request){
        $id_transacao = $request->id;
        $vendasDetalhada = vendasDetalhadas::where('user_id', Auth::id())->where('item_cancelado', false)->where('id_transacao', $id_transacao)->get();
        return view('relatorio.imprimirDetalhesVendas', ['vendasDetalhada' => $vendasDetalhada]);
    }

    public function backupView(){
        return view('relatorio.backup', ['mysql'=>$this->MakeTmpBackup()]);
    }

    function MakeTmpBackup(){
        $ds = DIRECTORY_SEPARATOR;
        $path = database_path() . $ds . 'backups' . $ds . date('Y') . $ds . date('m') . $ds;
        $file = date('Y-m-d-H-i-s') . '.SQL';
        $fullfile = "\"" . $path . $file . "\"";
        $command = "mysqldump --user=".getenv('DB_USERNAME')." --password=".getenv('DB_PASSWORD')." --host=".getenv('DB_HOST'). " " . getenv('DB_DATABASE')." --add-drop-database -r {$fullfile}";

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        exec($command, $output);
        $data = file_get_contents($path . $file);

        unlink($path . $file);
        return (object)array(
            'filename'=> $file,
            'file' => base64_encode($data)
         );
    }
    function importBackup(Request $request){
        if($request->hasFile('file-sql')){
            $file = $request->file('file-sql')->store('temp');
            $sqlfile = storage_path('app/') . $file;
            $this->RestoreDatabase($sqlfile);
            $import = "Banco de dados restaurado com sucesso!";
        }else{
            $import = "Nenhum arquivo selecionado.";
        }
        return redirect()->route('backup.view')->with('msg', $import);
    }
    function RestoreDatabase($sqlfile){
        $command = "mysql --user=".getenv('DB_USERNAME')." --password=".getenv('DB_PASSWORD')." --host=".getenv('DB_HOST'). " " . getenv('DB_DATABASE')." < {$sqlfile}";
        exec($command, $output);
        unlink($sqlfile);
    }
    
}
