<?php

namespace App\Http\Controllers;

use App\Services\VendasScadService;

class VendasScadController extends Controller {

    public function vendas() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = VendasScadService::getLastVersionControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = VendasScadService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $vendasScadERP = VendasScadService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($vendasScadERP, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                VendasScadService::flushItensVendasScad($chunk);
            }

            /* atualiza na tabela de configurações */
            VendasScadService::updateLastTrackingTable($updateVersion);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
