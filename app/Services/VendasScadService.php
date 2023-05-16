<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\VendasScad;
use Illuminate\Support\Facades\DB;

class VendasScadService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_vendas_s_cad')->first();

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
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_vendas_s_cad')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_vendas_s_cad';
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
                    v.numord,
                    v.filial,
                    v.localporta,
                    v.dtven,
                    v.usuven,
                    CASE
                        WHEN (p.referencia is not null) AND (p.referencia <> \'\') AND (p.referencia <> \' \')  
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
                    v.VALORDOACAO
           FROM CHANGETABLE (CHANGES [VENDASSCAD], :lastVersion) AS ct
           JOIN VENDASSCAD v on v.numord = ct.numord
           JOIN PEDICLICAD p on p.numped = v.numped', ['lastVersion' => $lastVersion]);
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
        ]);
    }

}
