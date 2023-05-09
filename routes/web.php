<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\BaseCalFatController;

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

Route::get('/', function () {
    return view('welcome');
});
