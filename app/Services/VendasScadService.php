<?php

namespace App\Services;

use App\Models\VendasScad;
use Illuminate\Support\Facades\DB;

class VendasScadService {

    const NOME_CONFIGURACOES = 'change_tracking_vendas_s_cad';

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERP($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                "SELECT
                    ct.numord,
                    v.filial,
                    v.localporta,
                    v.dtven,
                    v.usuven,
                    CASE
                        WHEN (p.referencia is not null) AND (p.referencia <> '') AND (p.referencia <> ' ')  
                            THEN p.referencia
                        ELSE CAST(p.numped AS VARCHAR(100))
                    END AS pedido_id,
                    v.numped,
                    v.totven,
                    v.freteorc,
                    v.numfrete,
                    v.dtentr,
                    v.codtran,
                    v.nordfrete,
                    v.situacao,
                    v.receber,
                    v.taxanf,
                    v.oiddocdeorigem,
                    v.condpagposterior,
                    v.PENDENTE,
                    v.MANUAL,
                    v.OUTRASDESPESASINCLUSAS,
                    v.TOTRECANTECIPADO,
                    v.TIPO,
                    v.TROCO,
                    v.RDOCDOACAO,
                    v.VALORDOACAO,
                    ct.SYS_CHANGE_OPERATION AS last_operation,
                    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
           FROM CHANGETABLE (CHANGES [VENDASSCAD], :lastVersion) AS ct
           LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
           LEFT JOIN VENDASSCAD v on v.numord = ct.numord
           LEFT JOIN PEDICLICAD p on p.numped = v.numped", ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flushItensVendasScad($dados) {

        VendasScad::upsert($dados, ['numord'],
                [
                    "numord",
                    "filial",
                    "localporta",
                    "dtven",
                    "usuven",
                    "pedido_id",
                    "numped",
                    "totven",
                    "freteorc",
                    "numfrete",
                    "dtentr",
                    "codtran",
                    "nordfrete",
                    "situacao",
                    "receber",
                    "taxanf",
                    "oiddocdeorigem",
                    "condpagposterior",
                    "PENDENTE",
                    "MANUAL",
                    "OUTRASDESPESASINCLUSAS",
                    "TOTRECANTECIPADO",
                    "TIPO",
                    "TROCO",
                    "RDOCDOACAO",
                    "VALORDOACAO",
                    "last_operation",
                    "last_commit_time"
        ]);
    }

}
