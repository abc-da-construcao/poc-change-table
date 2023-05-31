<?php

namespace App\Services;

use App\Models\Precos;
use Illuminate\Support\Facades\DB;

class PrecosService {

    const NOME_CONFIGURACOES_PRECO_PROMOCAO = 'change_tracking_precos_promocao';
    const NOME_CONFIGURACOES_PRECO_NORMAL = 'change_tracking_precos_normal';

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERPpromocao($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                'SELECT 
                    PPM.CODIGOEXTERNO1 as \'referencia\',
                    PPM.rpromocao, 
                    PPM.PRECO AS \'oferta\', 
                    PPM.oid as \'oid_produto_promocao\', 
                    PPM.QtdeOfertada as \'qtde_ofertada\', 
                    PPM.QtdeReservada as \'qtde_reservada\', 
                    PPM.AREAVEND as \'area_venda\', 
                    PM.inicio, 
                    PM.termino, 
                    IA.rpessoa, 
                    F.filial, 
                    F.NOME as \'filial_nome\', 
                    APC.precoven AS \'de\', 
                    ISNULL(PPM.PRECO, APC.precoven ) AS \'por\', 
                    AV.DESCR AS \'desc_area_venda\'
                FROM CHANGETABLE (CHANGES [PRODUTOPROMOCAO], :lastVersion) AS ct
                INNER JOIN PRODUTOPROMOCAO PPM ON ct.oid = PPM.OID 
                INNER JOIN PROMOCAO PM ON PM.OID = PPM.RPROMOCAO 
                INNER JOIN ITEMAUTORIZADO IA ON IA.RITEM = PPM.RPROMOCAO 
                INNER JOIN FILIALCAD F ON IA.RPESSOA = F.OID 
                INNER JOIN ADITIVO A ON A.RITEM = F.OID 
                INNER JOIN AREAPRECAD APC ON APC.areavend = A.NVALOR AND APC.codinterno = PPM.CODIGOEXTERNO1 
                INNER JOIN AREAVENCAD AV ON APC.areavend = AV.AREAVEND 
                WHERE PPM.QtdeOfertada > 0
                        AND A.RDEFINICAO = \'29661\' -- Dado adicional \'Área de Vendas atendida pela Filial\'
                        AND CONCAT((CONVERT(date, SYSDATETIME())), \' 00:00:00.000\') >= PM.INICIO 
                        AND CONCAT((CONVERT(date, SYSDATETIME())), \' 23:59:59.000\') < PM.TERMINO + 1
                ', ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flushPrecosPromocao($dados) {

        Precos::upsert($dados, ['referencia', 'filial'],
                [
                    "referencia",
                    "rpromocao",
                    "oferta",
                    "oid_produto_promocao",
                    "qtde_ofertada",
                    "qtde_reservada",
                    "area_venda",
                    "inicio",
                    "termino",
                    "rpessoa",
                    "filial",
                    "filial_nome",
                    "de",
                    "por",
                    "desc_area_venda",
        ]);
    }

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERPnormal($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                "SELECT
                        trim(p.codinterno) AS referencia,
                        CONCAT(p.precoven,'') AS de,
                        f.filial AS filial ,
                        f.NOME as filial_nome,
                        av.DESCR AS desc_area_venda,
                        ct.areavend AS area_venda,
                        ct.SYS_CHANGE_OPERATION AS last_operation,
                        COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
                    FROM CHANGETABLE (CHANGES [areaprecad], :lastVersion) AS ct
                    LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
                    LEFT JOIN areaprecad p on p.areavend = ct.areavend and p.codpro = ct.codpro
                    LEFT JOIN ADITIVO a on a.nvalor = p.areavend
                    LEFT JOIN DADOADICIONAL_V d  ON d.OID = a.RDEFINICAO  
                    LEFT JOIN FILIALCAD f on f.OID = a.RITEM
                    LEFT JOIN areavencad av ON p.areavend = av.areavend
                    WHERE d.oid = '29661' -- Dado adicional Área de Vendas atendida pela Filial", ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }
    
        /**
     * inserir/update os dados 
     */
    public static function flushPrecosNormal($dados) {

        Precos::upsert($dados, ['referencia', 'filial'],
                [
                    "referencia",
                    "de",
                    "filial",
                    "filial_nome",
                    "desc_area_venda",
                    "area_venda",
                    "last_operation",
                    "last_commit_time"
                    
        ]);
    }

}
