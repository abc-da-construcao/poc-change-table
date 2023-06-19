<?php

use Illuminate\Support\Facades\Route;
//------------------------------------------------------------------------------
//ERP
//------------------------------------------------------------------------------
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
//------------------------------------------------------------------------------
//PLATAFORMA
//------------------------------------------------------------------------------
use App\Http\Controllers\Plataforma\FiliaisController as FilialPlataforma;
use App\Http\Controllers\Plataforma\EnderecoClienteController;
use App\Http\Controllers\Plataforma\ClientesController;
use App\Http\Controllers\Plataforma\ItensPedidoVendaController as ItensPedidosPlataforma;
use App\Http\Controllers\Plataforma\PagamentoController;
use App\Http\Controllers\Plataforma\PedidosController as PedidosPlataforma;
use App\Http\Controllers\Plataforma\EspecificadoresController;
use App\Http\Controllers\Plataforma\EspecificadoresVincularPedidoController;
use App\Http\Controllers\Plataforma\OrcamentosController;
use App\Http\Controllers\Plataforma\ItensOrcamentosController;
//------------------------------------------------------------------------------
//API PRODUTOS
//------------------------------------------------------------------------------
use App\Http\Controllers\ApiProdutos\ApiProdutoController;
use App\Http\Controllers\ApiProdutos\ApiProdutoImagemController;
use App\Http\Controllers\ApiProdutos\ApiProdutoAtributosController;
use App\Http\Controllers\ApiProdutos\ApiProdutoEstoqueIndustriaController;

//------------------------------------------------------------------------------
//ERP
//------------------------------------------------------------------------------
$router->group(['prefix' => 'erp'], function () use ($router) {
    $router->get('/tracking-pedido', [PedidoController::class, 'index']);
    $router->get('/tracking-estoque', [EstoqueController::class, 'estoque']);
    $router->get('/tracking-produto', [ProdutoController::class, 'produto']);
    $router->get('/tracking-basecalfat', [BaseCalFatController::class, 'basecalfat']);
    $router->get('/tracking-itens-pedido-venda', [ItensPedidoVendaController::class, 'itensPedido']);
    $router->get('/tracking-itens-pedido-compra', [ItensPedidoCompraController::class, 'itensPedido']);
    $router->get('/tracking-notas-fiscais-saida', [NotasFiscaisSaidaController::class, 'notasFiscais']);
    $router->get('/tracking-classe', [ClasseProdutoController::class, 'classe']);
    $router->get('/tracking-fornecedor', [FornecedorController::class, 'fornecedor']);
    $router->get('/tracking-vendas-s-cad', [VendasScadController::class, 'vendas']);
    $router->get('/tracking-itens-faturado', [ItensFaturadoController::class, 'itensFaturado']);
    $router->get('/tracking-filiais', [FiliaisController::class, 'filiais']);
    $router->get('/tracking-precos', [PrecosController::class, 'precos']);
});
//------------------------------------------------------------------------------
//PLATAFORMA
//------------------------------------------------------------------------------
$router->group(['prefix' => 'plataforma'], function () use ($router) {
    $router->get('/tracking-filiais', [FilialPlataforma::class, 'filiais']);
    $router->get('/tracking-endereco-clientes', [EnderecoClienteController::class, 'enderecos']);
    $router->get('/tracking-clientes', [ClientesController::class, 'clientes']);
    $router->get('/tracking-itens-pedido-venda', [ItensPedidosPlataforma::class, 'itens']);
    $router->get('/tracking-pagamento', [PagamentoController::class, 'pagamentos']);
    $router->get('/tracking-pedidos', [PedidosPlataforma::class, 'pedidos']);
    $router->get('/tracking-especificadores', [EspecificadoresController::class, 'index']);
    $router->get('/tracking-especificadores-vincular-pedido', [EspecificadoresVincularPedidoController::class, 'index']);
    $router->get('/tracking-orcamento', [OrcamentosController::class, 'index']);
    $router->get('/tracking-itens-orcamento', [ItensOrcamentosController::class, 'index']);
});
//------------------------------------------------------------------------------
//API PRODUTOS
//------------------------------------------------------------------------------
$router->group(['prefix' => 'apiProdutos'], function () use ($router) {
    $router->get('/tracking-apiProdutos', [ApiProdutoController::class, 'apiProdutos']);
    $router->get('/tracking-apiProdutosImagem', [ApiProdutoImagemController::class, 'apiProdutosImagem']);
    $router->get('/tracking-apiProdutosAtributos', [ApiProdutoAtributosController::class, 'apiProdutosAtributos']);
    $router->get('/tracking-apiProdutosEstoquesIndustria', [ApiProdutoEstoqueIndustriaController::class, 'apiProdutoEstoqueIndustria']);
});

Route::get('/', function () {
    return view('welcome');
});
