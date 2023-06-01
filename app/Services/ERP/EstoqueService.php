<?php

namespace App\Services\ERP;

use App\Models\Estoque;
use Illuminate\Support\Facades\DB;

class EstoqueService {

    const NOME_CONFIGURACOES_ATUAL = 'change_tracking_estoque_atual';
    const NOME_CONFIGURACOES_FUTURO = 'change_tracking_estoque_futuro';
    const NOME_CONFIGURACOES_COMPRAS = 'change_tracking_estoque_compras';


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
                    "last_operation",
                    "last_commit_time"
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
                    "compras_1",
                    "compras_2",
                    "last_operation",
                    "last_commit_time"
        ]);
    }

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingEstoqueAtual($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                "SELECT 
                    ct.codpro,
                    pro.dv,
                    TRIM(pro.codinterno) AS 'referencia',
                    TRIM(CONCAT((i.quant - i.qtdereserv), '')) AS 'estoque_atual',
                    ct.filial,
                    ct.SYS_CHANGE_OPERATION AS last_operation,
                    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
                FROM CHANGETABLE (CHANGES [ITEMFILEST], :lastVersion) AS ct
                LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
                LEFT JOIN itemfilest i ON i.codpro = ct.codpro and i.filial = ct.filial
                LEFT JOIN produtocad pro ON pro.codpro = i.codpro AND pro.dv = i.dv 
                WHERE (i.quant - i.qtdereserv) > 0", ['lastVersion' => $lastVersion]);

        return json_decode(json_encode($dados), true);
    }

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingEstoqueFuturo($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                " SELECT 
                        ct.codpro,
                        pro.dv,
                        TRIM(pro.codinterno) AS 'referencia',
                        (SUM(i.quant) - SUM(i.quantrec)) as 'estoque_futuro',
                        i.filial,
                        ct.SYS_CHANGE_OPERATION AS last_operation,
                        COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
                    FROM CHANGETABLE (CHANGES [itemforcad], :lastVersion) AS ct
                    LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
                    LEFT JOIN itemforcad i ON i.codpro = ct.codpro AND i.numped = ct.numped
                    LEFT JOIN produtocad pro ON pro.codpro = ct.codpro AND pro.dv = i.dv
                    WHERE i.quantrec <> i.quant
                    GROUP BY ct.codpro,
                        pro.dv,
                        ct.SYS_CHANGE_OPERATION,
                        tc.commit_time,
                        pro.codinterno,
                        i.filial", ['lastVersion' => $lastVersion]);

        return json_decode(json_encode($dados), true);
    }
    
    public static function getLastChagingTrackingEstoqueCompras($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                " SELECT 
                        ct.codpro,
                        pro.dv,
                        TRIM(pro.codinterno) AS 'referencia',
                        ISNULL((SUM(i.quant) - SUM(i.quantrec)), 0) as 'estoque_futuro',
                        i.filial, 
                        ISNULL((SELECT (SUM(ifc.quant) - SUM(ifc.quantrec)) FROM itemforcad ifc  WHERE ifc.codpro=ct.codpro AND ifc.filial = i.filial AND ifc.quantrec <> ifc.quant AND ifc.dtprevrec BETWEEN GETDATE() AND GETDATE() + 15 GROUP BY ifc.codpro, ifc.filial), 0) as 'compras_1', 
                        ISNULL((SELECT (SUM(ifc.quant) - SUM(ifc.quantrec)) FROM itemforcad ifc  WHERE ifc.codpro=ct.codpro AND ifc.filial = i.filial AND ifc.quantrec <> ifc.quant AND ifc.dtprevrec BETWEEN GETDATE() + 16 AND GETDATE() + 45 GROUP BY ifc.codpro, ifc.filial), 0) as 'compras_2',
                        ct.SYS_CHANGE_OPERATION AS last_operation,
                        COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
                    FROM CHANGETABLE (CHANGES [itemforcad], :lastVersion) AS ct
                    LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
                    LEFT JOIN produtocad pro ON pro.codpro = ct.codpro
                    LEFT JOIN itemforcad i ON i.codpro = ct.codpro
                        WHERE i.quantrec <> i.quant
                        GROUP BY ct.codpro,
                                 pro.dv,
                                 ct.SYS_CHANGE_OPERATION,
                                 tc.commit_time,
                                 pro.codinterno,
                                 i.filial", ['lastVersion' => $lastVersion]);

        return json_decode(json_encode($dados), true);
    }

}
