<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\PagamentoService;
use App\Services\Plataforma\PagamentoOrcamentoService;

class PagamentoController extends Controller {

    public function pagamentos() {
        try {

            //------------------------------------------------------------------
            // PAGAMENTOS PEDIDOS
            //------------------------------------------------------------------
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(PagamentoService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();

            //busco as ultimas alteraçẽos na plataforma
            $pagamentosPlataforma = PagamentoService::getDadosPagamentosPlataforma($lastVersion);
            $chunks = array_chunk($pagamentosPlataforma, 500);

            foreach ($chunks as $chunk) {
                //add/update na tabela "espelho"
                PagamentoService::flushPagamentos($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion, PagamentoService::NOME_CONFIGURACOES);

            //------------------------------------------------------------------
            // PAGAMENTOS ORCAMENTO
            //------------------------------------------------------------------
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion2 = TimestampService::getTimeStampByConfiguracao(PagamentoOrcamentoService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion2 = TimestampService::getTimeStampBanco();

            //busco as ultimas alteraçẽos na plataforma
            $pagamentosPlataforma2 = PagamentoOrcamentoService::getDadosPagamentosOrcamento($lastVersion2);
            $chunks2 = array_chunk($pagamentosPlataforma2, 500);

            foreach ($chunks2 as $chunk) {
                //add/update na tabela "espelho"
                PagamentoOrcamentoService::flush($chunk);
            }

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion2, PagamentoOrcamentoService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
