<?php

namespace App\Services;

use App\Models\ItensFaturado;
use Illuminate\Support\Facades\DB;

class ItensFaturadoService {

    const NOME_CONFIGURACOES = 'change_tracking_itens_faturado';

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERP($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                'SELECT
                    i.Usuario,
                    i.Estacao,
                    i.Filial,
                    CASE
                       WHEN (p.referencia is not null) AND (p.referencia <> \'\') AND (p.referencia <> \' \')  
                           THEN p.referencia
                       ELSE CAST(p.numped AS VARCHAR(100))
                    END AS pedido_id,
                    i.Pedido,
                    i.Codpro,
                    i.Item,
                    i.Quant,
                    i.Reservado,
                    i.Faturado,
                    i.Cancelado,
                    i.NUMEROLISTA,
                    i.ORDEMENTREGA,
                    i.SITMANUT,
                    i.VIAORDEMSEPARACAO,
                    i.NUMORD,
                    i.NUMPEDTRANSFERENCIA,
                    i.DataOrdemSeparacao,
                    i.ID,
                    i.DATAMONTAGEM,
                    i.NUMORDTRANSF,
                    i.ORDEMCARGA,
                    i.DTINICIOSEPARACAO,
                    i.DTFIMSEPARACAO,
                    i.ROTEIRIZADOR,
                    i.CARGAROTEIRIZADOR,
                    i.DestinoRoteirizador,
                    i.USUARIOALTEROUSITMANUT,
                    i.ESTACAOALTEROUSITMANUT,
                    i.PROGRAMAALTEROUSITMANUT,
                    i.DATAALTEROUSITMANUT
           FROM CHANGETABLE (CHANGES [ITEMFATURADO], :lastVersion) AS ct
           JOIN ITEMFATURADO i on i.item = ct.item and i.reservado = ct.reservado
           JOIN PEDICLICAD p on p.numped = i.pedido', ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flushItensVendasScad($dados) {

        ItensFaturado::upsert($dados, ['Reservado', 'Item'],
                [
                    "Usuario",
                    "Estacao",
                    "Filial",
                    "pedido_id",
                    "Pedido",
                    "Codpro",
                    "Item",
                    "Quant",
                    "Reservado",
                    "Faturado",
                    "Cancelado",
                    "NUMEROLISTA",
                    "ORDEMENTREGA",
                    "SITMANUT",
                    "VIAORDEMSEPARACAO",
                    "NUMORD",
                    "NUMPEDTRANSFERENCIA",
                    "DataOrdemSeparacao",
                    "ID",
                    "DATAMONTAGEM",
                    "NUMORDTRANSF",
                    "ORDEMCARGA",
                    "DTINICIOSEPARACAO",
                    "DTFIMSEPARACAO",
                    "ROTEIRIZADOR",
                    "CARGAROTEIRIZADOR",
                    "DestinoRoteirizador",
                    "USUARIOALTEROUSITMANUT",
                    "ESTACAOALTEROUSITMANUT",
                    "PROGRAMAALTEROUSITMANUT",
                    "DATAALTEROUSITMANUT",
        ]);
    }

}
