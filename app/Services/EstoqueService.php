<?php

namespace App\Services;

use App\Models\Estoque;
use Illuminate\Support\Facades\DB;

class EstoqueService {

    const NOME_CONFIGURACOES_ATUAL = 'change_tracking_estoque_atual';
    const NOME_CONFIGURACOES_FUTURO = 'change_tracking_estoque_futuro';


    /**
     * inserir/update os dados de estoque
     */
    public static function flushEstoqueAtual($dados) {

        Estoque::upsert($dados, ['codpro', 'dv', 'filial'],
                [
                    "codpro",
                    "dv",
                    "referencia",
                    "estoque_atual",
                    "filial",
        ]);
    }

    /**
     * inserir/update os dados de estoque
     */
    public static function flushEstoqueFuturo($dados) {

        Estoque::upsert($dados, ['codpro', 'dv', 'filial'],
                [
                    "codpro",
                    "dv",
                    "referencia",
                    "estoque_futuro",
                    "filial",
        ]);
    }

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingEstoqueAtual($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                "SELECT 
                    pro.codpro,
                    pro.dv,
                    TRIM(pro.codinterno) AS 'referencia',
                    TRIM(CONCAT((i.quant - i.qtdereserv), '')) AS 'estoque_atual',
                    i.filial 
                FROM
                    CHANGETABLE (CHANGES [ITEMFILEST], :lastVersion) AS ct
                INNER JOIN itemfilest i ON i.codpro = ct.codpro and i.filial = ct.filial
                INNER JOIN produtocad pro ON pro.codpro = i.codpro AND pro.dv = i.dv 
                WHERE (i.quant - i.qtdereserv) > 0", ['lastVersion' => $lastVersion]);

        return json_decode(json_encode($dados), true);
    }

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingEstoqueFuturo($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                " SELECT 
                        pro.codpro,
                        pro.dv,
                        TRIM(pro.codinterno) AS 'referencia',
                        (SUM(i.quant) - SUM(i.quantrec)) as 'estoque_futuro',
                        i.filial 
                    FROM
                        CHANGETABLE (CHANGES [itemforcad], :lastVersion) AS ct
                    INNER JOIN itemforcad i ON i.codpro = ct.codpro AND i.numped = ct.numped
                    INNER JOIN produtocad pro ON pro.codpro = ct.codpro AND pro.dv = i.dv
                    WHERE i.quantrec <> i.quant
                    GROUP BY pro.codpro,
                        pro.dv,
                        pro.codinterno,
                        i.filial", ['lastVersion' => $lastVersion]);

        return json_decode(json_encode($dados), true);
    }

}
