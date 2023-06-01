<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Services\ERP\ProdutoService;
use App\Services\ERP\ChangeTrackingService;

class ProdutoController extends Controller {

    public function produto() {
        try {
            //** *********************************************************************************************************** *//
            //   Busca alteracoes na tabela PRODUTOCAD para alimentar a tabela produtos no MDM
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(ProdutoService::NOME_CONFIGURACOES_PROD);
            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();
            //busco as ultimas alteraçẽos no ERP
            $dadosProdutoTrackingERP = ProdutoService::getLastChagingTrackingProduto($lastVersion);

            $chunks = array_chunk($dadosProdutoTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho produto"
                ProdutoService::flushProduto($chunk);
            }
            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, ProdutoService::NOME_CONFIGURACOES_PROD);


            //** *********************************************************************************************************** *//
            //   Busca alteracoes na tabela COMPLEMENTOPRODUTO para alimentar a tabela produtos no MDM
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(ProdutoService::NOME_CONFIGURACOES_COMPL_PROD);
            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();
            //busco as ultimas alteraçẽos de complemento do produto no ERP
            $dadosProdutoComplementoTrackingERP = ProdutoService::getLastChagingTrackingProdutoComplemento($lastVersion);

            $chunksComp = array_chunk($dadosProdutoComplementoTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksComp as $chunkComp) {
                //add/update na tabela "espelho produto"
                ProdutoService::flushProdutoComplemento($chunkComp);
            }
            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, ProdutoService::NOME_CONFIGURACOES_COMPL_PROD);


            //** *********************************************************************************************************** *//
            //   Busca alteracoes na tabela PESQUISA para alimentar a tabela produtos no MDM
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(ProdutoService::NOME_CONFIGURACOES_PESQUISA);
            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();
            //busco as ultimas alteraçẽos de complemento do produto no ERP
            $dadosProdutoPesquisaTrackingERP = ProdutoService::getLastChagingTrackingProdutoPesquisa($lastVersion);

            $chunksPesquisa = array_chunk($dadosProdutoPesquisaTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksPesquisa as $chunkPesquisa) {
                //add/update na tabela "espelho produto"
                ProdutoService::flushProdutoPesquisa($chunkPesquisa);
            }
            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, ProdutoService::NOME_CONFIGURACOES_PESQUISA);

            //print execution
            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
