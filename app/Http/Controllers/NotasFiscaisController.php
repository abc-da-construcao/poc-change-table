<?php

namespace App\Http\Controllers;

use App\Services\ItensPedidoService;

class NotasFiscaisController extends Controller {

    public function itensPedido() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ItensPedidoService::getLastVersionControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ItensPedidoService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $itensPedidoTrackingERP = ItensPedidoService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($itensPedidoTrackingERP, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                ItensPedidoService::flushItensPedidos($chunk);
            }

            /* atualiza na tabela de configurações */
            ItensPedidoService::updateLastTrackingTable($updateVersion);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
