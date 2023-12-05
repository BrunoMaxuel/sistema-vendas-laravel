<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VenderController;
use App\Http\Controllers\ClientesController;

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



