<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\EspecificadoresVincularPedidoService;

class EspecificadoresVincularPedidoController extends Controller {

    public function index() {
        try {
            
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(EspecificadoresVincularPedidoService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();

            
            //busco as ultimas alteraçẽos na plataforma
            $filiaisPlataforma = EspecificadoresVincularPedidoService::getDadosPlataforma($lastVersion);
            $chunks = array_chunk($filiaisPlataforma, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                EspecificadoresVincularPedidoService::flush($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion,EspecificadoresVincularPedidoService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
