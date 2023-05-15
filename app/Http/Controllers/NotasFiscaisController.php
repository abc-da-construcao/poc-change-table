<?php

namespace App\Http\Controllers;

use App\Services\NotaFiscaisService;
use App\Services\ItensNotaFiscalService;

class NotasFiscaisController extends Controller {

    public function notasFiscais() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = NotaFiscaisService::getLastVersionControle();

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = NotaFiscaisService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $notasFiscaisERP = NotaFiscaisService::getLastChagingTrackingERP($lastVersion);

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
                NotaFiscaisService::flushItensPedidos($chunk);
            }

            if (count($numord) > 0) {
                //upinsert itens da nota
                $itensNf = ItensNotaFiscalService::getItensNF($numord, $in);
                $chunksNF = array_chunk($itensNf, 500);
                foreach ($chunksNF as $chunk) {
                    //add/update na tabela "espelho"
                    ItensNotaFiscalService::flushItensNF($chunk);
                }
            }

            /* atualiza na tabela de configurações */
            NotaFiscaisService::updateLastTrackingTable($updateVersion);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
