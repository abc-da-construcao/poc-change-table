<?php

namespace App\Services\ApiProdutos;

use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ApiProdutosService {

    const NOME_CONFIGURACOES = 'timestamp_apiProdutos_produtos';

    public static function getDadosProdutosApiProdutos($timeStamp) {

        $dados = DB::connection('mysql_api_produtos')->select(
                "SELECT
                    pd.codpro,
                    pd.referencia as 'api_produtos_referencia',
                    pd.modelo as 'api_produtos_modelo',
                    pd.nome_original as 'api_produtos_nome_original',
                    pd.venda_minima as 'api_produtos_venda_minima',
                    pd.descricao_amigavel as 'api_produtos_descricao_amigavel',
                    pd.nome_amigavel as 'api_produtos_nome_web',
                    pd.descricao_longa as 'ap_produtos_descricao_longa',
                    pd.embalagem as 'api_produtos_embalagem',
                    pd.tags as 'api_produtos_tags',
                    pd.obs as 'api_produtos_obs',
                    substring(pd.url_video, 0, 254) as 'api_produtos_video'
                FROM
                    produtos pd
                WHERE pd.updated_at >= :timeStamp",
                ['timeStamp' => $timeStamp]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados
     */
    public static function flushProdutosApiProdutos($dados) {

        Produto::upsert($dados, ['codpro'],
                [
                    'codpro',
                    'api_produtos_referencia',
                    'api_produtos_modelo',
                    'api_produtos_nome_original',
                    'api_produtos_venda_minima',
                    'api_produtos_descricao_amigavel',
                    'api_produtos_nome_web',
                    'ap_produtos_descricao_longa',
                    'api_produtos_embalagem',
                    'api_produtos_tags',
                    'api_produtos_obs',
                    'api_produtos_video'
                ]);
    }

}
