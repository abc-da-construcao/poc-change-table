<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\EspecificadoresService;

class EspecificadoresController extends Controller {

    public function index() {
        try {
            
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(EspecificadoresService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();

            
            //busco as ultimas alteraçẽos na plataforma
            $filiaisPlataforma = EspecificadoresService::getDadosPlataforma($lastVersion);
            $chunks = array_chunk($filiaisPlataforma, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                EspecificadoresService::flush($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion,EspecificadoresService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
