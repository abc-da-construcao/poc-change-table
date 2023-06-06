<?php

namespace App\Services\ApiProdutos;

use App\Models\Atributos;
use Illuminate\Support\Facades\DB;

class ApiProdutosAtributosService {

    const NOME_CONFIGURACOES = 'timestamp_apiProdutos_atributos';

    public static function getAtributosApiProdutos($timeStamp) {
        $dados = DB::connection('mysql_api_produtos')->select(
                "SELECT
                    a.id as 'id_atributos',
                    a.referencia,
                    a.nome,
                    a.valor,
                    a.filtravel,
                    a.removido,
                    a.slug_nome,
                    a.slug_valor,
                    a.created_at,
                    a.updated_at
                FROM atributos a
                WHERE  1=1
                AND ((a.updated_at IS NOT NULL and a.updated_at >= :timeStamp) OR (a.created_at >= :timeStampTwo))
                LIMIT 2000",
                ['timeStamp' => $timeStamp,
                'timeStampTwo' => $timeStamp]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados
     */
    public static function flushAtributosProdutosApiProdutos($dados) {

        Atributos::upsert($dados, ['id_atributos', 'referencia'],
                [
                    'id_atributos',
                    'referencia',
                    'nome',
                    'valor',
                    'filtravel',
                    'removido',
                    'slug_nome',
                    'slug_valor'
                ]);
    }

}
