<?php

namespace App\Http\Controllers\ApiProdutos;

use App\Http\Controllers\Controller;
use App\Services\ApiProdutos\TimestampApiProdutosService;
use App\Services\ApiProdutos\ApiProdutosEstoqueIndustriaService;

class ApiProdutoEstoqueIndustriaController extends Controller {

    public function apiProdutoEstoqueIndustria() {
            try {
                //Busco na tabela de configurações a ultima versão que utilizamos
                $lastVersion = TimestampApiProdutosService::getTimeStampByConfiguracao(ApiProdutosEstoqueIndustriaService::NOME_CONFIGURACOES);

                //Busco a última versão do timeStamp do banco
                $updateVersion = TimestampApiProdutosService::getTimeStampBanco();

                //busco as ultimas alteraçẽos na plataforma
                $estoquesIndustriaApiProdutos = ApiProdutosEstoqueIndustriaService::getEstoquesIndustriaApiProdutos($lastVersion);
                // dd($estoquesIndustriaApiProdutos);
                $chunks = array_chunk($estoquesIndustriaApiProdutos, 500);

                foreach ($chunks as $chunk) {
                    //add/update na tabela "espelho"
                    ApiProdutosEstoqueIndustriaService::flushEstoquesIndustriaApiProdutos($chunk);
                }

                /* atualiza na tabela de configurações */
                TimestampApiProdutosService::updateTimeStamp($updateVersion,ApiProdutosEstoqueIndustriaService::NOME_CONFIGURACOES);

                dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
}
