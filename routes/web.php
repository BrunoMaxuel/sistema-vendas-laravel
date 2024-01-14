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
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.auth');

Route::middleware(['auth'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    
    Route::get('/clientes', [ClientesController::class, 'index'])->name('cliente.index');
    Route::post('/clientes/pesquisar', [ClientesController::class, 'search'])->name('cliente.search');
    Route::get('/clientes/adicionar',[ClientesController::class, 'painelAdicionar'])->name('cliente.painel.adicionar');
    Route::post('/clientes/editar', [ClientesController::class, 'editarCliente'])->name('cliente.editar');
    Route::post('/clientes/adicionar',[ClientesController::class, 'adicionarCliente'])->name('cliente.adicionar');
    Route::delete('/clientes/excluir',[ClientesController::class, 'excluirCliente'])->name('cliente.excluir');
    
    
    Route::get('/produtos', [ProdutosController::class, 'index'])->name('produto.index');
    Route::get('/produtos/adicionar', [ProdutosController::class, 'produtosViewAdicionar'])->name('produtos.view.adicinar');
    Route::get('/produtos/search', [ProdutosController::class, 'search'])->name('produtos.search');
    Route::post('/produtos/editarproduto', [ProdutosController::class, 'editarProduto'])->name('produto.editar');
    Route::post('/produtos/novoproduto', [ProdutosController::class, 'novoProduto'])->name('produto.adicionar');
    Route::delete('/produtos/excluir', [ProdutosController::class, 'excluirProduto'])->name('produto.excluir');
    
    
    
    Route::get('/caixa', [CaixaController::class, 'index'])->name('caixa.index');
    Route::post('/caixa/fechar', [CaixaController::class, 'fecharCaixa'])->name('caixa.fechar');
    Route::post('/caixa/abrir', [CaixaController::class, 'iniciarCaixa'])->name('caixa.iniciar');
    Route::post('/caixa/adicionar', [CaixaController::class, 'adicionarSuprimento'])->name('caixa.add');
    Route::post('/caixa/sangria', [CaixaController::class, 'adicionarSangria'])->name('caixa.sangria');
    

    Route::get('/vender', [VendasController::class, 'index'])->name('venda.index');
    Route::post('/venda/registrar', [VendasController::class, 'registrarVenda'])->name('venda.registrar');
    Route::post('/vender/estoque', [VendasController::class, 'buscarProdutos'])->name('estoque.api.listar');
    Route::post('/vender/vendaAndamento', [VendasController::class, 'vendaEmAndamento'])->name('venda.andamento');
    Route::post('/vender/vendaAndamento/cancelar', [VendasController::class, 'cancelarItemVenda'])->name('venda.cancelar');
    Route::post('/vender/vendaAndamento/registrar', [VendasController::class, 'vendaEmAndamentoRegistrar'])->name('venda.andamento.registrar');
    Route::post('/vender/finalizar', [VendasController::class, 'finalizarVenda'])->name('venda.finalizar');
    Route::post('/vender/vendaAndamento/cancelarVenda', [VendasController::class, 'cancelarVenda'])->name('venda.andamento.cancelar');
    
    

    //Histórico e Backup
    Route::get('/historico', [HistoricoVendasController::class, 'index'])->name('historico.view'); 
    Route::post('/historico', [HistoricoVendasController::class, 'historicoBuscarDetalhes'])->name('historico.detalhes'); 
    Route::post('/historico/editar', [HistoricoVendasController::class, 'editarTransacao'])->name('historico.editar'); 
    Route::delete('/historico/excluir', [HistoricoVendasController::class, 'excluirTransacao'])->name('historico.excluir'); 
    Route::get('/historico/imprimirVendas', [HistoricoVendasController::class, 'imprimirVendas'])->name('historico.imprimir.vendas'); 
    Route::get('/historico/imprimirVendaDetalhada/{id}', [HistoricoVendasController::class, 'imprimirVenda'])->name('historico.imprimir.venda');
    Route::get('/backup', [HistoricoVendasController::class, 'backupView'])->name('backup.view'); 
    Route::post('/backup', [HistoricoVendasController::class, 'importBackup'])->name('backup.importBackup'); 







    Route::post('/logout', [LoginController::class, 'deslogar'])->name('logout');
    Route::get('/registrar', [LoginController::class, 'registrar'])->name('registrar');
    Route::post('/registrar', [LoginController::class, 'processoRegistrar'])->name('registrar.action');
});