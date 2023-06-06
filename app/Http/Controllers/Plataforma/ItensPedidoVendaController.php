<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\ItensPedidoVendaService;

class ItensPedidoVendaController extends Controller {

    public function itens() {
        try {
            
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(ItensPedidoVendaService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();

            
            //busco as ultimas alteraçẽos na plataforma
            $itensPedidoVenda = ItensPedidoVendaService::getDadosPlataforma($lastVersion);
            
            $chunks = array_chunk($itensPedidoVenda, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                ItensPedidoVendaService::flushItens($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion,ItensPedidoVendaService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
