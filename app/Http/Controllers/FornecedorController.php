<?php

namespace App\Http\Controllers;

use App\Services\FornecedorService;

class FornecedorController extends Controller {

    public function fornecedor() {
        try {
            //** *********************************************************************************************************** *//
            //      Search for traking in table PESSOA e ITEM para formar a tabela fornecedor no MDM
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionFornecedor = FornecedorService::getLastVersionFornecedorControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersionFornecedor = FornecedorService::getLastVersionTrackingTable();

            //busco as ultimas alteracoes de classes do produto no ERP
            $dadosFornecedorTrackingERP = FornecedorService::getLastChagingTrackingFornecedor($lastVersionFornecedor);

            $chunksFornecedor = array_chunk($dadosFornecedorTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksFornecedor as $chunkFornecedor) {
                //add/update na tabela "espelho produto"
                FornecedorService::flushFornecedor($chunkFornecedor);
            }
            //atualiza na tabela de configuracoes
            FornecedorService::updateLastTrackingFornecedorTable($updateVersionFornecedor);

            //print execution
            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
