<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\ItensFaturado;
use Illuminate\Support\Facades\DB;

class ItensFaturadoService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_itens_faturado')->first();

        //ainda não tem versao na tabela de controle
        if (empty($lastVersion)) {
            $version = DB::connection('sqlsrv_ERP')->selectOne('select CHANGE_TRACKING_CURRENT_VERSION() as version');
            return $version->version;
        }

        return $lastVersion->valor;
    }

    /**
     * retorna o ultimo tracking para a proximo controle interno da execuçao
     */
    public static function getLastVersionTrackingTable() {

        $version = DB::connection('sqlsrv_ERP')->selectOne('select CHANGE_TRACKING_CURRENT_VERSION() as version');
        return $version->version;
    }

    /**
     * atualiza o valor na tabela de controle
     */
    public static function updateLastTrackingTable($version) {

        //atualiza a ultima versao na tabela de controle
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_itens_faturado')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_itens_faturado';
        }

        $LastVersionTable->valor = $version;
        $LastVersionTable->save();
    }

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

        ItensFaturado::upsert($dados, ['Reservado','Item'],
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
