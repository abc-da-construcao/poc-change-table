<?php

namespace App\Services;

use App\Models\Precos;
use Illuminate\Support\Facades\DB;

class PrecosService {

    const NOME_CONFIGURACOES = 'change_tracking_precos';

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERP($lastVersion) {

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
                INNER JOIN PROMOCAOPLANO PP ON PP.RPROMOCAO = PPM.RPROMOCAO 
                INNER JOIN ADITIVO A ON A.RITEM = F.OID 
                INNER JOIN DADOADICIONAL_V DA ON A.RDEFINICAO = DA.OID 
                INNER JOIN AREAPRECAD APC ON APC.areavend = A.NVALOR AND APC.codinterno = PPM.CODIGOEXTERNO1 
                INNER JOIN AREAVENCAD AV ON APC.areavend = AV.AREAVEND 
                WHERE PPM.QtdeOfertada > 0
                    AND PP.RPLANODEPAGAMENTO = \'2230942\' -- Plano de pagamento A VISTA
                        AND DA.OID = \'29661\' -- Dado adicional \'Área de Vendas atendida pela Filial\'
                        AND CONCAT((CONVERT(date, SYSDATETIME())), \' 00:00:00.000\') >= PM.INICIO 
                        AND CONCAT((CONVERT(date, SYSDATETIME())), \' 23:59:59.000\') < PM.TERMINO + 1
                group BY 
                        PPM.codigoexterno1,
                        PPM.rpromocao, 
                        PPM.preco, 
                        PPM.oid, 
                        PPM.qtdeofertada, 
                        PPM.qtdereservada, 
                        PPM.areavend, 
                        PM.inicio, 
                        PM.termino, 
                        IA.rpessoa, 
                        F.filial, 
                        F.nome, 
                        APC.precoven, 
                        APC.precoven, 
                        AV.descr', ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flushPrecos($dados) {

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

}
