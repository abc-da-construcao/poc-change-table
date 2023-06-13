<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\PagamentoService;

class PagamentoController extends Controller {

    public function pagamentos() {
        try {

            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(PagamentoService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();

            //busco as ultimas alteraçẽos na plataforma
            $pagamentosPlataforma = PagamentoService::getDadosPagamentosPlataforma($lastVersion);
            dd($pagamentosPlataforma);
            $chunks = array_chunk($pagamentosPlataforma, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                PagamentoService::flushPagamentos($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion,PagamentoService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
