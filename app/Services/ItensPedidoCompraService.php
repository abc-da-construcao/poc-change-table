<?php

namespace App\Services;

use App\Models\ItensPedidoCompra;
use Illuminate\Support\Facades\DB;

class ItensPedidoCompraService {
    
    const NOME_CONFIGURACOES = 'change_tracking_itens_pedido_compra';

  
    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERP($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                "SELECT
                    i.numped,
                    i.codpro,
                    i.dv,
                    i.quant,
                    i.unid,
                    i.preco,
                    i.valoripi,
                    i.aliqipi,
                    i.quantrec,
                    i.dtprevrec,
                    i.filial,
                    i.numord,
                    i.valdesc,
                    i.dtpedido,
                    i.txembal,
                    i.txsubst,
                    i.descunit,
                    i.precobas,
                    i.valoricms,
                    i.aliqicms,
                    i.referencia,
                    i.desccomer,
                    i.descfinan,
                    i.perdesc,
                    i.faconv,
                    i.quantcan,
                    i.Item,
                    i.TextoTecnico,
                    i.PrecoLista,
                    i.PrecoCusto,
                    i.PRECOUNITFINAL,
                    i.libprobloq,
                    i.VALSUBSTRI,
                    i.VALTRIBANTECIPADA,
                    i.BASEICMS,
                    i.PERCICMS,
                    i.PERCSUBSTRI,
                    i.ID,
                    i.RSITUACAO,
                    i.DTPREVFAT
                 FROM CHANGETABLE (CHANGES [ITEMFORCAD], :lastVersion) AS ct
                 JOIN ITEMFORCAD i on i.numped = ct.numped and i.codpro = ct.codpro", ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados
     */
    public static function flushItensPedidos($dados) {

        ItensPedidoCompra::upsert($dados, ['Item', 'numped', 'codpro'],
                [
                    "numped",
                    "codpro",
                    "dv",
                    "quant",
                    "unid",
                    "preco",
                    "valoripi",
                    "aliqipi",
                    "quantrec",
                    "dtprevrec",
                    "filial",
                    "numord",
                    "valdesc",
                    "dtpedido",
                    "txembal",
                    "txsubst",
                    "descunit",
                    "precobas",
                    "valoricms",
                    "aliqicms",
                    "referencia",
                    "desccomer",
                    "descfinan",
                    "perdesc",
                    "faconv",
                    "quantcan",
                    "Item",
                    "TextoTecnico",
                    "PrecoLista",
                    "PrecoCusto",
                    "PRECOUNITFINAL",
                    "libprobloq",
                    "VALSUBSTRI",
                    "VALTRIBANTECIPADA",
                    "BASEICMS",
                    "PERCICMS",
                    "PERCSUBSTRI",
                    "ID",
                    "RSITUACAO",
                    "DTPREVFAT",
        ]);
    }

}
