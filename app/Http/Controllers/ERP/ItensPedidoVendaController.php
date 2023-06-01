<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Services\ERP\ItensPedidoVendaService;
use App\Services\ERP\ChangeTrackingService;

class ItensPedidoVendaController extends Controller {

    public function itensPedido() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(ItensPedidoVendaService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $itensPedidoTrackingERP = ItensPedidoVendaService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($itensPedidoTrackingERP, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                ItensPedidoVendaService::flushItensPedidos($chunk);
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion,ItensPedidoVendaService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
