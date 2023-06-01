<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Services\ERP\BaseCalFatService;
use App\Services\ERP\ChangeTrackingService;

class BaseCalFatController extends Controller {

    public function basecalfat() {
        try {
            //** *********************************************************************************************************** *//
            //      Search for traking in table BaseCalFat
            //** *********************************************************************************************************** *//
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(BaseCalFatService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $dadosBaseCalFatTrackingERP = BaseCalFatService::getLastChagingTrackingBaseCalFat($lastVersion);

            $chunks = array_chunk($dadosBaseCalFatTrackingERP, 500); // limita a carga da consulta em 500 registros por vez

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                BaseCalFatService::flushBaseCalFat($chunk);
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, BaseCalFatService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
