<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Services\ERP\ChangeTrackingService;
use App\Services\ERP\FiliaisService;

class FiliaisController extends Controller {

    public function filiais() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(FiliaisService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $vendasScadERP = FiliaisService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($vendasScadERP, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                FiliaisService::flushFiliais($chunk);
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion,FiliaisService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
