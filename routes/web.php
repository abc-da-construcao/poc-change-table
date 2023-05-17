<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\BaseCalFatController;
use App\Http\Controllers\ItensPedidoController;
use App\Http\Controllers\NotasFiscaisController;
use App\Http\Controllers\ClasseProdutoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\VendasScadController;
use App\Http\Controllers\ItensFaturadoController;
use App\Http\Controllers\FiliaisController;

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
Route::get('/tracking-itens-pedido', [ItensPedidoController::class, 'itensPedido']);
Route::get('/tracking-notas-fiscais', [NotasFiscaisController::class, 'notasFiscais']);
Route::get('/tracking-classe', [ClasseProdutoController::class, 'classe']);
Route::get('/tracking-fornecedor', [FornecedorController::class, 'fornecedor']);
Route::get('/tracking-vendas-s-cad', [VendasScadController::class, 'vendas']);
Route::get('/tracking-itens-faturado', [ItensFaturadoController::class, 'itensFaturado']);
Route::get('/tracking-filiais', [FiliaisController::class, 'filiais']);

Route::get('/', function () {
    return view('welcome');
});
