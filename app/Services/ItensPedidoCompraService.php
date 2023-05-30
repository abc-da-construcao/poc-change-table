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
                    ct.numped as numero_pedido,
                    ct.codpro,
                    i.dv,
                    i.quant as quantidade,
                    i.unid,
                    i.preco,
                    i.valoripi,
                    i.aliqipi,
                    i.quantrec as quantidade_recebida,
                    i.dtprevrec as data_previsao_recebimento,
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
                    pro.codinterno as referencia,
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
                    i.DTPREVFAT,
                    pro.descr,
                    pro.codfor,
                    fnd.NOME as 'FORNECEDOR',
                    fnd.CGC as 'DOCUMENTO',
                    ct.SYS_CHANGE_OPERATION AS 'last_operation',
                    COALESCE(tc.commit_time, GETDATE()) AS 'last_commit_time'
                 FROM CHANGETABLE (CHANGES [ITEMFORCAD], :lastVersion) AS ct
                 LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
                 LEFT JOIN ITEMFORCAD i on i.numped = ct.numped and i.codpro = ct.codpro
                 LEFT JOIN produtocad pro ON pro.codpro = ct.codpro AND pro.dv = i.dv
                 LEFT JOIN fornececad fnd ON pro.codfor = fnd.oid", ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados
     */
    public static function flushItensPedidos($dados) {

        ItensPedidoCompra::upsert($dados, ['Item', 'numero_pedido', 'codpro'],
                [
                    "numero_pedido",
                    "codpro",
                    "dv",
                    "quantidade",
                    "unid",
                    "preco",
                    "valoripi",
                    "aliqipi",
                    "quantidade_recebida",
                    "data_previsao_recebimento",
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
