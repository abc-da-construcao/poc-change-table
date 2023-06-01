<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Services\ERP\PrecosService;
use App\Services\ERP\ChangeTrackingService;

class PrecosController extends Controller {

    public function precos() {
        try {
            
            //------------------------------------------------------------------
            //PREÇOS EM PROMOÇÃO
            //------------------------------------------------------------------
            
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionPromocao = ChangeTrackingService::getLastVersionControle(PrecosService::NOME_CONFIGURACOES_PRECO_PROMOCAO);

            //Busco a última versão do change tracking do SQL Server
            $updateVersionPromocao = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $vendasScadERPpromocao = PrecosService::getLastChagingTrackingERPpromocao($lastVersionPromocao);

            $chunksPromocao = array_chunk($vendasScadERPpromocao, 500);

            foreach ($chunksPromocao as $chunk) {
                //add/update na tabela "espelho"
                PrecosService::flushPrecosPromocao($chunk);
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersionPromocao, PrecosService::NOME_CONFIGURACOES_PRECO_PROMOCAO);

            //------------------------------------------------------------------
            //PREÇOS NORMAIS
            //------------------------------------------------------------------
            
                        //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionNormal = ChangeTrackingService::getLastVersionControle(PrecosService::NOME_CONFIGURACOES_PRECO_NORMAL);

            //Busco a última versão do change tracking do SQL Server
            $updateVersionNormal = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $vendasScadERPnormal = PrecosService::getLastChagingTrackingERPnormal($lastVersionNormal);

            $chunksNormal = array_chunk($vendasScadERPnormal, 500);

            foreach ($chunksNormal as $chunk) {
                //add/update na tabela "espelho"
                PrecosService::flushPrecosNormal($chunk);
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersionNormal, PrecosService::NOME_CONFIGURACOES_PRECO_NORMAL);

            
            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
