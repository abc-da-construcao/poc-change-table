<?php

namespace App\Http\Controllers;

use App\Services\ClasseProdutoService;

class ClasseProdutoController extends Controller {

    public function classe() {
        try {
            //** *********************************************************************************************************** *//
            //      Search for traking in table CLASSIFCAD
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionClassifCad = ClasseProdutoService::getLastVersionClassifCadControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersionClassifCad = ClasseProdutoService::getLastVersionTrackingTable();

            //busco as ultimas alteracoes de classes do produto no ERP
            $dadosClassifCadTrackingERP = ClasseProdutoService::getLastChagingTrackingClassifCad($lastVersionClassifCad);

            $chunksClassifCad = array_chunk($dadosClassifCadTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksClassifCad as $chunkClassifCad) {
                //add/update na tabela "espelho produto"
                ClasseProdutoService::flushClassifCad($chunkClassifCad);
            }
            //atualiza na tabela de configuracoes
            ClasseProdutoService::updateLastTrackingClassifCadTable($updateVersionClassifCad);

            //print execution
            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
