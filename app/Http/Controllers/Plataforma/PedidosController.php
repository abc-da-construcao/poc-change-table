<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\PedidosService;

class PedidosController extends Controller {

    public function pedidos() {
        try {

            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(PedidosService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();


            //busco as ultimas alteraçẽos na plataforma
            $pedidosPlataforma = PedidosService::getDadosPedidoPlataforma($lastVersion);
            // dd($pedidosPlataforma);
            $chunks = array_chunk($pedidosPlataforma, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                PedidosService::flush($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion,PedidosService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
