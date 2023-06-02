<?php

namespace App\Services\ERP;

use App\Models\BaseCalFat;
use Illuminate\Support\Facades\DB;

class BaseCalFatService {

    const NOME_CONFIGURACOES = 'change_tracking_baseCalFat';

    /**
     * insert/update dos dados CT na tabela BaseCalFat
     */
    public static function flushBaseCalFat($dados) {

        BaseCalFat::upsert($dados, ['id_basecalfat'],
                [
                    "id_basecalfat",
                    "codpro",
                    "base_cont",
                    "bas_en_cont",
                    "cod_mensagem",
                    "aliq_cont",
                    "aliq_n_cont",
                    "perc_subtri",
                    "estado_origem",
                    "estado_destino",
                    "base_calc_produto",
                    "aliquota_produto",
                    "tpo",
                    "cfo",
                    "classificacao_ cliente",
                    "tipo_Cliente",
                    "perc_base_despesas",
                    "cffoncont",
                    "codmensncont",
                    "cf",
                    "alq_cred_icms_st",
                    "alq_deb_icms_st",
                    "desconsto_icms_proprio_valor_st",
                    "diferencial_aliquota_st",
                    "filial",
                    "tipo_subst_venda",
                    "tipo_tributacao",
                    "aliquota_estado",
                    "base_cred_icms_st",
                    "base_deb_icms_st",
                    "carga_tributaria_media",
                    "manter_base_padrao_reducao",
                    "optante_simples",
                    "base_cheia_difal",
                    "perf_cp",
                    "desoneracao_icms",
                    "mot_des_icms",
                    "cbenef",
                    "carga_liquida",
                    "codigo_ce_st",
                    "observacao",
                    "last_operation",
                    "last_commit_time",
                ]);
    }


    /**
     * busca as ultimas modificações de BaseCalFat da tabela no ERP
     */
    public static function getLastChagingTrackingBaseCalFat ($lastVersionBaseCalFat) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                    "SELECT
                        ct.ID AS 'id_basecalfat',
                        bc.codpro AS 'codpro',
                        bc.basecont AS 'base_cont',
                        bc.basencont AS 'bas_en_cont',
                        bc.codmens AS 'cod_mensagem',
                        bc.aliqcont AS 'aliq_cont',
                        bc.aliqncont AS 'aliq_n_cont',
                        bc.percsubtri AS 'perc_subtri',
                        bc.estadoorigem AS 'estado_origem',
                        bc.estadodestino AS 'estado_destino',
                        bc.basecalcproduto AS 'base_calc_produto',
                        bc.aliquotaproduto AS 'aliquota_produto',
                        bc.tpo AS 'tpo',
                        bc.cfo AS 'cfo',
                        bc.Classificacaocliente AS 'classificacao_ cliente',
                        bc.TipoCliente AS 'tipo_Cliente',
                        bc.PERCBASEDESPESAS AS 'perc_base_despesas',
                        bc.CFONCONT AS 'cffoncont',
                        bc.CODMENSNCONT AS 'codmensncont',
                        bc.CF AS 'cf',
                        bc.ALQCREDICMSST AS 'alq_cred_icms_st',
                        bc.ALQDEBICMSST AS 'alq_deb_icms_st',
                        bc.DESCONSICMSPROPRIOVALORST AS 'desconsto_icms_proprio_valor_st',
                        bc.DIFERENCIALALIQUOTAST AS 'diferencial_aliquota_st',
                        bc.FILIAL AS 'filial',
                        bc.TIPOSUBSTVENDA AS 'tipo_subst_venda',
                        bc.TIPOTRIBUTACAO AS 'tipo_tributacao',
                        bc.ALIQUOTAESTADO AS 'aliquota_estado',
                        bc.BASECREDICMSST AS 'base_cred_icms_st',
                        bc.BASEDEBICMSST AS 'base_deb_icms_st',
                        bc.CARGATRIBUTARIAMEDIA AS 'carga_tributaria_media',
                        bc.MANTERBASEPADRAOREDUCAO AS 'manter_base_padrao_reducao',
                        bc.OPTANTESIMPLES AS 'optante_simples',
                        bc.BASECHEIADIFAL AS 'base_cheia_difal',
                        bc.PERFCP AS 'perf_cp',
                        bc.DesoneracaoICMS AS 'desoneracao_icms',
                        bc.MotDesICMS AS 'mot_des_icms',
                        bc.cBENEF AS 'cbenef',
                        bc.CARGALIQUIDA AS 'carga_liquida',
                        bc.CODIGOCEST AS 'codigo_ce_st',
                        bc.OBSERVACAO AS 'observacao',
                        ct.SYS_CHANGE_OPERATION AS 'last_operation',
                        COALESCE(tc.commit_time, GETDATE())  AS 'last_commit_time'
                    FROM CHANGETABLE (CHANGES [BASECALFAT], :lastVersion) AS ct
                    LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
                    LEFT JOIN BASECALFAT bc on bc.ID = ct.ID"
                    ,['lastVersion' => $lastVersionBaseCalFat]);

        return json_decode(json_encode($dados), true);
    }

}
