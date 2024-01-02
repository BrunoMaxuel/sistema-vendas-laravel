<?php

use App\Http\Controllers\CaixaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HistoricoVendasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\VendasController;
use Illuminate\Support\Facades\Route;
 
Route::get('/login', [LoginController::class, 'loginView'])->name('login.view');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registrar', [LoginController::class, 'registrar'])->name('registrar');
Route::post('/registrar', [LoginController::class, 'registrarAction'])->name('registrar.action');

Route::middleware(['auth'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.view');
    Route::post('/clientes/editar', [ClientesController::class, 'editarView'])->name('clientes.editar');
    Route::post('/clientes/saveeditar', [ClientesController::class, 'saveEditar'])->name('clientes.saveEdit');
    Route::get('/clientes/adicionar',[ClientesController::class, 'adicionarClienteView'])->name('clientes.adicionar.view');
    Route::post('/clientes/adicionar',[ClientesController::class, 'adicionarCliente'])->name('clientes.adicionar.action');
    Route::post('/clientes/excluir',[ClientesController::class, 'excluirCliente'])->name('clientes.excluir');
    Route::post('/clientes/excluirAction',[ClientesController::class, 'excluirClienteAction'])->name('clientes.excluirAction');
    Route::get('/clientes/search', [ClientesController::class, 'search'])->name('clientes.search');


    Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.view');
    Route::get('/produtos/adicionar', [ProdutosController::class, 'produtosViewAdicionar'])->name('produtos.view.adicinar');
    Route::get('/produtos/search', [ProdutosController::class, 'search'])->name('produtos.search');
    Route::post('/produtos/editar', [ProdutosController::class, 'editarView'])->name('produtos.editar');
    Route::post('/produtos/saveeditar', [ProdutosController::class, 'saveEditar'])->name('produtos.saveEdit');
    Route::post('/produtos/excluir', [ProdutosController::class, 'excluirProduto'])->name('produtos.excluir');
    Route::post('/produtos/excluiraction', [ProdutosController::class, 'excluirProdutoAction'])->name('produtos.excluir.action');



    Route::get('/caixa', [CaixaController::class, 'caixaView'])->name('caixa.abrir.view');
    Route::post('/caixa/fechar', [CaixaController::class, 'fecharCaixa'])->name('caixa.fechar');
    Route::post('/caixa/abrir', [CaixaController::class, 'caixaAbrir'])->name('caixa.abrir.abrir');
    Route::post('/caixa/adicionar', [CaixaController::class, 'addDinheiro'])->name('caixa.add');
    Route::post('/caixa/sangria', [CaixaController::class, 'retirarDinheiro'])->name('caixa.sangria');


    Route::get('/vender', [VendasController::class, 'venderView'])->name('venda.view');
    Route::post('/venda/registrar', [VendasController::class, 'registrarVenda'])->name('venda.registrar');

    Route::post('api/delete', [VendasController::class, 'apiDelete'])->name('estoque.api.delete');
    Route::post('/vender/estoque', [VendasController::class, 'apiListar'])->name('estoque.api.listar');
    Route::post('/vender/vendaAndamento', [VendasController::class, 'vendaEmAndamento'])->name('venda.andamento');
    Route::post('/vender/vendaAndamento/cancelar', [VendasController::class, 'apiCancelar'])->name('venda.cancelar');
    Route::post('/vender/vendaAndamento/registrar', [VendasController::class, 'vendaEmAndamentoRegistrar'])->name('venda.andamento.registrar');
    Route::post('/vender/vendaAndamento/finalizar', [VendasController::class, 'finalizarVenda'])->name('venda.andamento.finalizar');
    Route::post('/vender/vendaAndamento/cancelarVenda', [VendasController::class, 'cancelarVenda'])->name('venda.andamento.cancelar');



    //Histórico e Backup
    Route::get('/historico', [HistoricoVendasController::class, 'historicoView'])->name('historico.view'); 
    Route::post('/historico', [HistoricoVendasController::class, 'historicoBuscarDetalhes'])->name('historico.detalhes'); 
    Route::post('/historico/editar', [HistoricoVendasController::class, 'historicoEdit'])->name('historico.edit'); 
    Route::get('/historico/imprimirVendas', [HistoricoVendasController::class, 'imprimirVendas'])->name('historico.imprimir.vendas'); 
    Route::get('/historico/imprimirVendaDetalhada/{id}', [HistoricoVendasController::class, 'imprimirVenda'])->name('historico.imprimir.venda');
    Route::get('/backup', [HistoricoVendasController::class, 'backupView'])->name('backup.view'); 
    Route::post('/backup', [HistoricoVendasController::class, 'importBackup'])->name('backup.importBackup'); 
});