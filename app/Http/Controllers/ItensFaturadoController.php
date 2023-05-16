<?php

namespace App\Http\Controllers;

use App\Services\ItensFaturadoService;

class ItensFaturadoController extends Controller {

    public function itensFaturado() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ItensFaturadoService::getLastVersionControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ItensFaturadoService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $vendasScadERP = ItensFaturadoService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($vendasScadERP, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                ItensFaturadoService::flushItensVendasScad($chunk);
            }

            /* atualiza na tabela de configurações */
            ItensFaturadoService::updateLastTrackingTable($updateVersion);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
