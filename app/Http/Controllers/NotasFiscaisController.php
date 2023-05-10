<?php

namespace App\Http\Controllers;

use App\Services\NotaFiscaisService;

class NotasFiscaisController extends Controller {

    public function notasFiscais() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = NotaFiscaisService::getLastVersionControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = NotaFiscaisService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $notasFiscaisERP = NotaFiscaisService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($notasFiscaisERP, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                NotaFiscaisService::flushItensPedidos($chunk);
            }

            /* atualiza na tabela de configurações */
            NotaFiscaisService::updateLastTrackingTable($updateVersion);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
