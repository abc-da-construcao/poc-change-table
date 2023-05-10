<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\BaseCalFat;
use Illuminate\Support\Facades\DB;

class BaseCalFatService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionBaseCalFatControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_baseCalFat')->first();

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
    public static function updateLastTrackingBaseCalFatTable($version) {
        //atualiza a ultima versao na tabela de controle
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_baseCalFat')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_baseCalFat';
        }

        $LastVersionTable->valor = $version;
        $LastVersionTable->save();
    }


    /**
     * insert/update dos dados CT na tabela BaseCalFat
     */
    public static function flushBaseCalFat($dados) {

        BaseCalFat::upsert($dados, ['codpro', 'id_basecalfat'],
                [
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
                    "id_basecalfat",
                    "codigo_ce_st",
                    "observacao",
                    "operation"
                ]);
    }


    /**
     * busca as ultimas modificações de BaseCalFat da tabela no ERP
     */
    public static function getLastChagingTrackingBaseCalFat ($lastVersionBaseCalFat) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                    "SELECT
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
                        bc.ID AS 'id_basecalfat',
                        bc.CODIGOCEST AS 'codigo_ce_st',
                        bc.OBSERVACAO AS 'observacao',
                        ct.SYS_CHANGE_OPERATION AS 'operation'
                    FROM CHANGETABLE (CHANGES [BASECALFAT], :lastVersion) AS ct
                    INNER JOIN BASECALFAT bc on bc.ID = ct.ID"
                    ,['lastVersion' => $lastVersionBaseCalFat]);

        return json_decode(json_encode($dados), true);
    }

}