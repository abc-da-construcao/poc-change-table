<?php

namespace App\Http\Controllers;

use App\Services\ProdutoService;

class ProdutoController extends Controller {

    public function produto() {
        try {
            //** *********************************************************************************************************** *//
            //      Search for traking in table PRODUTOCAD
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionProduto = ProdutoService::getLastVersionProdutoControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersionProduct = ProdutoService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $dadosProdutoTrackingERP = ProdutoService::getLastChagingTrackingProduto($lastVersionProduto);

            $chunks = array_chunk($dadosProdutoTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho produto"
                ProdutoService::flushProduto($chunk);
            }
            //atualiza na tabela de configurações
            ProdutoService::updateLastTrackingProdutoTable($updateVersionProduct);


            //** *********************************************************************************************************** *//
            //      Search for traking in table COMPLEMENTOPRODUTO
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionProdutoComplemento = ProdutoService::getLastVersionProdutoComplementoControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersionComplement = ProdutoService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos de complemento do produto no ERP
            $dadosProdutoComplementoTrackingERP = ProdutoService::getLastChagingTrackingProdutoComplemento($lastVersionProdutoComplemento);

            $chunksComp = array_chunk($dadosProdutoComplementoTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksComp as $chunkComp) {
                //add/update na tabela "espelho produto"
                ProdutoService::flushProdutoComplemento($chunkComp);
            }
            //atualiza na tabela de configurações
            ProdutoService::updateLastTrackingProdutoComplementoTable($updateVersionComplement);


            //** *********************************************************************************************************** *//
            //      Search for traking in table PESQUISA
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionProdutoPesquisa = ProdutoService::getLastVersionProdutoPesquisaControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersionPesquisa = ProdutoService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos de complemento do produto no ERP
            $dadosProdutoPesquisaTrackingERP = ProdutoService::getLastChagingTrackingProdutoPesquisa($lastVersionProdutoPesquisa);

            $chunksPesquisa = array_chunk($dadosProdutoPesquisaTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksPesquisa as $chunkPesquisa) {
                //add/update na tabela "espelho produto"
                ProdutoService::flushProdutoPesquisa($chunkPesquisa);
            }
            //atualiza na tabela de configurações
            ProdutoService::updateLastTrackingProdutoPesquisaTable($updateVersionPesquisa);


            //** *********************************************************************************************************** *//
            //      Search for traking in table CLASSIFCAD
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionClassifCad = ProdutoService::getLastVersionClassifCadControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersionClassifCad = ProdutoService::getLastVersionTrackingTable();

            //busco as ultimas alteracoes de classes do produto no ERP
            $dadosClassifCadTrackingERP = ProdutoService::getLastChagingTrackingClassifCad($lastVersionClassifCad);

            $chunksClassifCad = array_chunk($dadosClassifCadTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksClassifCad as $chunkClassifCad) {
                //add/update na tabela "espelho produto"
                ProdutoService::flushClassifCad($chunkClassifCad);
            }
            //atualiza na tabela de configuracoes
            ProdutoService::updateLastTrackingClassifCadTable($updateVersionClassifCad);

            //print execution
            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
