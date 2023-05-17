<?php

namespace App\Http\Controllers;

use App\Services\ItensPedidoService;
use App\Services\ChangeTrackingService;

class ItensPedidoController extends Controller {

    public function itensPedido() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(ItensPedidoService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $itensPedidoTrackingERP = ItensPedidoService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($itensPedidoTrackingERP, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                ItensPedidoService::flushItensPedidos($chunk);
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion,ItensPedidoService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
