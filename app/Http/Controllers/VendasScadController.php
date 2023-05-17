<?php

namespace App\Http\Controllers;

use App\Services\VendasScadService;
use App\Services\ChangeTrackingService;

class VendasScadController extends Controller {

    public function vendas() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(VendasScadService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $vendasScadERP = VendasScadService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($vendasScadERP, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                VendasScadService::flushItensVendasScad($chunk);
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, VendasScadService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
