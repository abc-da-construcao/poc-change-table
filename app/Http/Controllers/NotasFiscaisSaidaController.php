<?php

namespace App\Http\Controllers;

use App\Services\NotaFiscaisSaidaService;
use App\Services\ItensNotaFiscalSaidaService;
use App\Services\ChangeTrackingService;

class NotasFiscaisSaidaController extends Controller {

    public function notasFiscais() {
        try {
            //------------------------------------------------------------------
            //NOTAS FISCAIS
            //------------------------------------------------------------------
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(NotaFiscaisSaidaService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $notasFiscaisERP = NotaFiscaisSaidaService::getLastChagingTrackingERP($lastVersion);

            $in = '';
            $numord = [];

            //upinsert nota fiscal
            $chunks = array_chunk($notasFiscaisERP, 500);
            foreach ($chunks as $chunk) {
                $in .= str_repeat('?,', count($chunk) - 1) . '?';

                foreach ($chunk as $value) {
                    $numord[] = $value['numord'];
                }
                //add/update na tabela "espelho"
                NotaFiscaisSaidaService::flushINotaFiscal($chunk);
            }

            if (count($numord) > 0) {
                //upinsert itens da nota
                $itensNf = ItensNotaFiscalSaidaService::getItensNF($numord, $in);
                $chunksNF = array_chunk($itensNf, 500);
                foreach ($chunksNF as $chunk) {
                    //add/update na tabela "espelho"
                    ItensNotaFiscalSaidaService::flushItensNF($chunk);
                }
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, NotaFiscaisSaidaService::NOME_CONFIGURACOES);

            //------------------------------------------------------------------
            //COMPLEMENTO NF SAIDA
            //------------------------------------------------------------------
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersionComplemento = ChangeTrackingService::getLastVersionControle(NotaFiscaisSaidaService::NOME_CONFIGURACOES_COMPLEMENTO);

            //Busco a última versão do change tracking do SQL Server
            $updateVersionComplemento = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $notasFiscaisERPComplemento = NotaFiscaisSaidaService::getLastChagingTrackingERPcomplementosNF($lastVersionComplemento);

            //upinsert nota fiscal
            $chunksComplemento = array_chunk($notasFiscaisERPComplemento, 500);
            foreach ($chunksComplemento as $chunk) {
               
                //add/update na tabela "espelho"
                NotaFiscaisSaidaService::flushIComplementoNotaFiscal($chunk);
            }

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersionComplemento, NotaFiscaisSaidaService::NOME_CONFIGURACOES_COMPLEMENTO);
            
            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
