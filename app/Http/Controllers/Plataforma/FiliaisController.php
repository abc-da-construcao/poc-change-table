<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\FiliaisService;

class FiliaisController extends Controller {

    public function filiais() {
        try {
            
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(FiliaisService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();

            
            //busco as ultimas alteraçẽos na plataforma
            $filiaisPlataforma = FiliaisService::getDadosPlataforma($lastVersion);
            $chunks = array_chunk($filiaisPlataforma, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                FiliaisService::flushFiliais($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion,FiliaisService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
