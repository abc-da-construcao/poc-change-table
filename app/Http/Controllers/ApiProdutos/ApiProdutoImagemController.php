<?php

namespace App\Http\Controllers\ApiProdutos;

use App\Http\Controllers\Controller;
use App\Services\ApiProdutos\TimestampApiProdutosService;
use App\Services\ApiProdutos\ApiProdutosImagemService;

class ApiProdutoImagemController extends Controller {

    public function apiProdutosImagem() {
            try {
                //Busco na tabela de configurações a ultima versão que utilizamos
                $lastVersion = TimestampApiProdutosService::getTimeStampByConfiguracao(ApiProdutosImagemService::NOME_CONFIGURACOES);

                //Busco a última versão do timeStamp do banco
                $updateVersion = TimestampApiProdutosService::getTimeStampBanco();

                //busco as ultimas alteraçẽos na plataforma
                $imagensApiProdutos = ApiProdutosImagemService::getImagensApiProdutos($lastVersion);
                // dd( $imagensApiProdutos);
                $chunks = array_chunk($imagensApiProdutos, 500);

                foreach ($chunks as $chunk) {
                    //add/update na tabela "espelho"
                    ApiProdutosImagemService::flushImagensProdutosApiProdutos($chunk);
                }

                /* atualiza na tabela de configurações */
                TimestampApiProdutosService::updateTimeStamp($updateVersion,ApiProdutosImagemService::NOME_CONFIGURACOES);

                dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
}
