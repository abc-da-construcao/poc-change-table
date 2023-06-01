<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Services\ERP\FornecedorService;
use App\Services\ERP\ChangeTrackingService;

class FornecedorController extends Controller {

    public function fornecedor() {
        try {
            //** *********************************************************************************************************** *//
            //   Busca alteracoes nas tabelas PESSOA e ITEM para alimentar a tabela fornecedor no MDM
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(FornecedorService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteracoes de classes do produto no ERP
            $dadosFornecedorTrackingERP = FornecedorService::getLastChagingTrackingFornecedor($lastVersion);

            $chunksFornecedor = array_chunk($dadosFornecedorTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksFornecedor as $chunkFornecedor) {
                //add/update na tabela "espelho produto"
                FornecedorService::flushFornecedor($chunkFornecedor);
            }
            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, FornecedorService::NOME_CONFIGURACOES);

            //print execution
            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
