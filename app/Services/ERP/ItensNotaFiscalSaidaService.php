<?php

namespace App\Services\ERP;

use App\Models\ItensNotaFiscalSaida;
use Illuminate\Support\Facades\DB;

class ItensNotaFiscalSaidaService {

    /**
     * consulta os itens da nf
     */
    public static function getItensNF($numord, $in) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                'SELECT
                    numnota,
                    serie,
                    codpro,
                    dv,
                    quant,
                    unidade,
                    preco,
                    precotab,
                    quantdev,
                    numord,
                    dtemis,
                    filial,
                    valdesc,
                    aliqipi,
                    aliqicms,
                    baseicms,
                    ct,
                    cm,
                    cf,
                    ccusto,
                    codvend,
                    atuaitem,
                    atucusto,
                    codinterno,
                    partnum,
                    custtran,
                    icmtran,
                    c2moetran,
                    descunit,
                    cmcontab,
                    grupo,
                    seriepro,
                    numorddev,
                    custgeral,
                    valche,
                    perdesc,
                    numordfis,
                    impoger,
                    quanped,
                    cfo,
                    precostx,
                    faconv,
                    ITEM,
                    custven,
                    percom,
                    valsubstri,
                    substrib,
                    numos,
                    numordentrada,
                    itementrada,
                    RATENDEREQUISICAOVALOR,
                    ItemPEdido,
                    itemdev,
                    valipi,
                    ID,
                    VALIPI2,
                    IDCODREDBASE
           FROM ITNFSAICAD 
           WHERE numord IN (' . $in . ')', $numord);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados de itens nota
     */
    public static function flushItensNF($dados) {

        ItensNotaFiscalSaida::upsert($dados, ['numord', 'codpro', 'dv', 'ITEM'],
                [
                    "numnota",
                    "serie",
                    "codpro",
                    "dv",
                    "quant",
                    "unidade",
                    "preco",
                    "precotab",
                    "quantdev",
                    "numord",
                    "dtemis",
                    "filial",
                    "valdesc",
                    "aliqipi",
                    "aliqicms",
                    "baseicms",
                    "ct",
                    "cm",
                    "cf",
                    "ccusto",
                    "codvend",
                    "atuaitem",
                    "atucusto",
                    "codinterno",
                    "partnum",
                    "custtran",
                    "icmtran",
                    "c2moetran",
                    "descunit",
                    "cmcontab",
                    "grupo",
                    "seriepro",
                    "numorddev",
                    "custgeral",
                    "valche",
                    "perdesc",
                    "numordfis",
                    "impoger",
                    "quanped",
                    "cfo",
                    "precostx",
                    "faconv",
                    "ITEM",
                    "custven",
                    "percom",
                    "valsubstri",
                    "substrib",
                    "numos",
                    "numordentrada",
                    "itementrada",
                    "RATENDEREQUISICAOVALOR",
                    "ItemPEdido",
                    "itemdev",
                    "valipi",
                    "ID",
                    "VALIPI2",
                    "IDCODREDBASE",
        ]);
    }

}
