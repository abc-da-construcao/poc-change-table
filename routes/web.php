<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ERP\PedidoController;
use App\Http\Controllers\ERP\ProdutoController;
use App\Http\Controllers\ERP\EstoqueController;
use App\Http\Controllers\ERP\BaseCalFatController;
use App\Http\Controllers\ERP\ItensPedidoVendaController;
use App\Http\Controllers\ERP\ItensPedidoCompraController;
use App\Http\Controllers\ERP\NotasFiscaisSaidaController;
use App\Http\Controllers\ERP\ClasseProdutoController;
use App\Http\Controllers\ERP\FornecedorController;
use App\Http\Controllers\ERP\VendasScadController;
use App\Http\Controllers\ERP\ItensFaturadoController;
use App\Http\Controllers\ERP\FiliaisController;
use App\Http\Controllers\ERP\PrecosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tracking-pedido', [PedidoController::class, 'index']);
Route::get('/tracking-estoque', [EstoqueController::class, 'estoque']);
Route::get('/tracking-produto', [ProdutoController::class, 'produto']);
Route::get('/tracking-basecalfat', [BaseCalFatController::class, 'basecalfat']);
Route::get('/tracking-itens-pedido-venda', [ItensPedidoVendaController::class, 'itensPedido']);
Route::get('/tracking-itens-pedido-compra', [ItensPedidoCompraController::class, 'itensPedido']);
Route::get('/tracking-notas-fiscais-saida', [NotasFiscaisSaidaController::class, 'notasFiscais']);
Route::get('/tracking-classe', [ClasseProdutoController::class, 'classe']);
Route::get('/tracking-fornecedor', [FornecedorController::class, 'fornecedor']);
Route::get('/tracking-vendas-s-cad', [VendasScadController::class, 'vendas']);
Route::get('/tracking-itens-faturado', [ItensFaturadoController::class, 'itensFaturado']);
Route::get('/tracking-filiais', [FiliaisController::class, 'filiais']);
Route::get('/tracking-precos', [PrecosController::class, 'precos']);

Route::get('/', function () {
    return view('welcome');
});
