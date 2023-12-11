<?php

use App\Http\Controllers\CaixaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\VendasController;
use Illuminate\Support\Facades\Route;

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
Route::post('/caixa/fechar', [CaixaController::class, 'fecharCaixa'])->name('caixa.fechar');
Route::post('/caixa/abrir', [CaixaController::class, 'caixaAbrir'])->name('caixa.abrir.abrir');
Route::post('/caixa/adicionar', [CaixaController::class, 'addDinheiro'])->name('caixa.add');
Route::post('/caixa/sangria', [CaixaController::class, 'retirarDinheiro'])->name('caixa.sangria');


Route::get('/vender', [VendasController::class, 'venderView'])->name('venda.view');
Route::post('/vender/estoque', [VendasController::class, 'apiListar'])->name('estoque.api.listar');
Route::post('api/delete', [VendasController::class, 'apiDelete'])->name('estoque.api.delete');
Route::post('api/produto/', [VendasController::class, 'apiSave'])->name('estoque.api.save');

// Route::post('/venda', 'VendasController@Registrar')->name('venda.registrar');
// Route::get('/venda/cupom/', 'VendasController@GerarCupom')->name('venda.cupom.route');
Route::get('/venda/cupom/{id}', 'VendasController@GerarCupom')->name('venda.cupom');
// Route::post('/venda/cancelar/', 'VendasController@CancelarVenda')->name('venda.cancelar');








// { "data": "id" },
// { "data": "nome" },
// { "data": "codigo_barras" },
// { "data": "preco" },
// { "data": "preco_custo" },
// { "data": "lucro" },
// { "data": "estoque" },
// { "data": "fornecedor"},
// { "data": "categoria" },


// window.addEventListener('keydown', function (e) {
//     var tableVenda = document.querySelector('#tableVenda');
//     var rowCount = tableVenda.rows.length;
//     var code = e.key || e.code;
//     switch (code) {
//         case 'F1':
//         case 'F2':
//         case 'F3':
//         case 'F4':
//         case 'F6':
//         case 'F7':
//         case 'F8':
//         case 'F9':
//         case 'F10':
//         case 'F11':
//         case 'F12':
//             e.preventDefault();
//             break;
//         case 'F5':
//             if (rowCount > 1) {
//                 e.preventDefault();
//                 confimDialog.style.display = 'block';
//                 btnCancel.focus(); 
//             }
//     }
//     });




// Route::get('/relatorio/backup', [RelatorioController::class, 'ImportBackup'])->name('relatorio.backup');






