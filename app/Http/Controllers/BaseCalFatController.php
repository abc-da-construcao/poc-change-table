<?php

namespace App\Http\Controllers;

use App\Services\BaseCalFatService;

class BaseCalFatController extends Controller {

    public function basecalfat() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionBaseCalFat = BaseCalFatService::getLastVersionBaseCalFatControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersionBaseCalFat = BaseCalFatService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $dadosBaseCalFatTrackingERP = BaseCalFatService::getLastChagingTrackingBaseCalFat($lastVersionBaseCalFat);

            $chunks = array_chunk($dadosBaseCalFatTrackingERP, 500); // limita a carga da consulta em 500 registros por vez
            foreach ($chunks as $chunk) {
                //add/update na tabela "baseCalFats"
                BaseCalFatService::flushBaseCalFat($chunk);
            }
            //atualiza na tabela de configurações
            BaseCalFatService::updateLastTrackingBaseCalFatTable($updateVersionBaseCalFat);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
