<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Services\ERP\EstoqueService;
use App\Services\ERP\ChangeTrackingService;

class EstoqueController extends Controller {

    public function estoque() {
        try {
            //------------------------------------------------------------------
            //ESTOQUE ATUAL
            //------------------------------------------------------------------
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(EstoqueService::NOME_CONFIGURACOES_ATUAL);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $dadosTrackingERP = EstoqueService::getLastChagingTrackingEstoqueAtual($lastVersion);

            $chunks = array_chunk($dadosTrackingERP, 500);
            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                EstoqueService::flushEstoqueAtual($chunk);
            }

            //atualiza na tabela de configurações
            ChangeTrackingService::updateLastTrackingTable($updateVersion, EstoqueService::NOME_CONFIGURACOES_ATUAL);

            //------------------------------------------------------------------
            //ESTOQUE FUTURO
            //------------------------------------------------------------------
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionFuturo = ChangeTrackingService::getLastVersionControle(EstoqueService::NOME_CONFIGURACOES_FUTURO);

            //Busco a última versão do change tracking do SQL Server
            $updateVersionFuturo = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $dadosTrackingERPFuturo = EstoqueService::getLastChagingTrackingEstoqueFuturo($lastVersionFuturo);

            $chunks2 = array_chunk($dadosTrackingERPFuturo, 500);
            foreach ($chunks2 as $chunk) {
                //add/update na tabela "espelho"
                EstoqueService::flushEstoqueFuturo($chunk);
            }

            //atualiza na tabela de configurações
            ChangeTrackingService::updateLastTrackingTable($updateVersionFuturo, EstoqueService::NOME_CONFIGURACOES_FUTURO);
            
            //------------------------------------------------------------------
            //COMPRAS FUTURAS 15 E 45 DIAS
            //------------------------------------------------------------------
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionComprasFuturas = ChangeTrackingService::getLastVersionControle(EstoqueService::NOME_CONFIGURACOES_COMPRAS);

            //Busco a última versão do change tracking do SQL Server
            $updateVersionComprasFuturas = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $dadosTrackingERPComprasFuturas = EstoqueService::getLastChagingTrackingEstoqueCompras($lastVersionComprasFuturas);

            $chunks3 = array_chunk($dadosTrackingERPComprasFuturas, 500);
            foreach ($chunks3 as $chunk) {
                //add/update na tabela "espelho"
                EstoqueService::flushEstoqueFuturo($chunk);
            }

            //atualiza na tabela de configurações
            ChangeTrackingService::updateLastTrackingTable($updateVersionComprasFuturas, EstoqueService::NOME_CONFIGURACOES_COMPRAS);


            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}