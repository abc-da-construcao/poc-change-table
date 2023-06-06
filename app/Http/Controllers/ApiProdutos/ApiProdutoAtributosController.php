<?php

namespace App\Http\Controllers\ApiProdutos;

use App\Http\Controllers\Controller;
use App\Services\ApiProdutos\TimestampApiProdutosService;
use App\Services\ApiProdutos\ApiProdutosAtributosService;

class ApiProdutoAtributosController extends Controller {

    public function apiProdutosAtributos() {
            try {
                //Busco na tabela de configurações a ultima versão que utilizamos
                $lastVersion = TimestampApiProdutosService::getTimeStampByConfiguracao(ApiProdutosAtributosService::NOME_CONFIGURACOES);

                //Busco a última versão do timeStamp do banco
                $updateVersion = TimestampApiProdutosService::getTimeStampBanco();

                //busco as ultimas alteraçẽos na plataforma
                $atributosApiProdutos = ApiProdutosAtributosService::getAtributosApiProdutos($lastVersion);
                // dd($atributosApiProdutos);
                $chunks = array_chunk($atributosApiProdutos, 500);

                foreach ($chunks as $chunk) {
                    //add/update na tabela "espelho"
                    ApiProdutosAtributosService::flushAtributosProdutosApiProdutos($chunk);
                }

                /* atualiza na tabela de configurações */
                TimestampApiProdutosService::updateTimeStamp($updateVersion,ApiProdutosAtributosService::NOME_CONFIGURACOES);

                dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
}
