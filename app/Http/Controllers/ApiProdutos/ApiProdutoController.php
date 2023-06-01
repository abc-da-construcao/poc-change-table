<?php

namespace App\Http\Controllers\ApiProdutos;

use App\Http\Controllers\Controller;
use App\Services\ApiProdutos\TimestampApiProdutosService;
use App\Services\ApiProdutos\ApiProdutosService;

class ApiProdutoController extends Controller {

    public function apiProdutos() {
            try {
                //Busco na tabela de configurações a ultima versão que utilizamos
                $lastVersion = TimestampApiProdutosService::getTimeStampByConfiguracao(ApiProdutosService::NOME_CONFIGURACOES);

                //Busco a última versão do timeStamp do banco
                $updateVersion = TimestampApiProdutosService::getTimeStampBanco();

                //busco as ultimas alteraçẽos na plataforma
                $produtosApiProdutos = ApiProdutosService::getDadosProdutosApiProdutos($lastVersion);
                // dd( $produtosApiProdutos);
                $chunks = array_chunk($produtosApiProdutos, 500);

                foreach ($chunks as $chunk) {
                    //add/update na tabela "espelho"
                    ApiProdutosService::flushProdutosApiProdutos($chunk);
                }

                /* atualiza na tabela de configurações */
                TimestampApiProdutosService::updateTimeStamp($updateVersion,ApiProdutosService::NOME_CONFIGURACOES);

                dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
}
