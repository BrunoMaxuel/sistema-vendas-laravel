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
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.view');
Route::post('/clientes/editar', [ClientesController::class, 'editarView'])->name('clientes.editar.view');
Route::post('/clientes/saveEditar', [ClientesController::class, 'editarSave'])->name('clientes.editar.save');
Route::get('/clientes/cadastrar',[ClientesController::class, 'cadastrarCliente'])->name('clientes.cadastrar');


Route::post('/clientes/save', 'ClientesController@cadastrar')->name('clientes.save');
Route::post('/cliente/editar', 'ClientesController@editar')->name('clientes.editar');
Route::post('/cliente/saveeditar', 'ClientesController@saveEditar')->name('clientes.saveEdit');
