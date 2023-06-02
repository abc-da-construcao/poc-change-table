<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\EnderecoClienteService;

class EnderecoClienteController extends Controller {

    public function enderecos() {
        try {
            
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(EnderecoClienteService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();

            
            //busco as ultimas alteraçẽos na plataforma
            $enderecosPlatorma = EnderecoClienteService::getDadosPlataforma($lastVersion);
            
            $chunks = array_chunk($enderecosPlatorma, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                EnderecoClienteService::flushEnderecos($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion,EnderecoClienteService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
