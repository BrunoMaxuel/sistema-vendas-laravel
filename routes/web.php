<?php

use App\Http\Controllers\CaixaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VenderController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/vender', [VenderController::class, 'index'])->name('vender.index');
Route::get('/', [HomeController::class, 'index'])->name('home.index');



//Rotas de clientes
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
Route::post('/caixa/abrir', [CaixaController::class, 'caixaAbrir'])->name('caixa.abrir.abrir');
Route::get('/caixa/fechar', [CaixaController::class, 'fecharCaixaView'])->name('caixa.fechar.view');
Route::post('/caixa/fechar', [CaixaController::class, 'fecharCaixa'])->name('caixa.fechar');




// Route::get('/caixa/sangria', 'CaixaController@sangriaView')->name('sangria');
// Route::post('/caixa/sangria', 'CaixaController@sangriaPost')->name('sangria');
// Route::get('/caixa/adicionar', 'CaixaController@addCaixaView')->name('caixa.add');
// Route::post('/caixa/adicionar', 'CaixaController@addCaixa')->name('caixa.add');


