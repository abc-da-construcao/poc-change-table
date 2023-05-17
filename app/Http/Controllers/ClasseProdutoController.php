<?php

namespace App\Http\Controllers;

use App\Services\ClasseProdutoService;
use App\Services\ChangeTrackingService;

class ClasseProdutoController extends Controller {

    public function classe() {
        try {
            //** *********************************************************************************************************** *//
            //   Busca alteracoes na tabela CLASSIFCAD para alimentar a tabela classesr no MDM
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(ClasseProdutoService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteracoes de classes do produto no ERP
            $dadosClassifCadTrackingERP = ClasseProdutoService::getLastChagingTrackingClassifCad($lastVersion);

            $chunksClassifCad = array_chunk($dadosClassifCadTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunksClassifCad as $chunkClassifCad) {
                //add/update na tabela "espelho produto"
                ClasseProdutoService::flushClassifCad($chunkClassifCad);
            }
            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, ClasseProdutoService::NOME_CONFIGURACOES);

            //print execution
            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
