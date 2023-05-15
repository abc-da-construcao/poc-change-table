<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\ClasseProduto;
use Illuminate\Support\Facades\DB;

class ClasseProdutoService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionClassifCadControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_produto_classifCad')->first();

        //ainda não tem versao na tabela de controle
        if (empty($lastVersion)) {
            $version = DB::connection('sqlsrv_ERP')->selectOne('select CHANGE_TRACKING_CURRENT_VERSION() as version');
            return $version->version;
        }
        return $lastVersion->valor;
    }


    /**
     * atualiza o valor na tabela de controle
     */
    public static function updateLastTrackingClassifCadTable($version) {

        //atualiza a ultima versao na tabela de controle
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_produto_classifCad')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_produto_classifCad';
        }

        $LastVersionTable->valor = $version;
        $LastVersionTable->save();
    }


    /**
     * retorna o ultimo tracking para a proximo controle interno da execuçao
     */
    public static function getLastVersionTrackingTable() {

        $version = DB::connection('sqlsrv_ERP')->selectOne('select CHANGE_TRACKING_CURRENT_VERSION() as version');
        return $version->version;
    }


    /**
     * inserir/update os dados de produto
    */
    public static function flushClassifCad($dados) {

        ClasseProduto::upsert($dados, ['clasprod'],
                        [
                            "clasprod",
                            "descr",
                            "anal",
                            "sainalista",
                            "participacfem",
                            "percentualcfem",
                            "ativa",
                            "pagacomissaoindoferta",
                            "perccomissao",
                            "percdescmaximogerente",
                            "percdescmaximovendedor",
                            "similaridade",
                            "descrdetalhada",
                            "prioridadeentrega",
                            "id_erp",
                            "atualizadoem",
                            "codigo_gnre",
                            "operation"
                        ]);
                    }


    /**
     * busca as ultimas modificações de complementos do produto da tabela no ERP
     */
    public static function getLastChagingTrackingClassifCad($lastVersionClassifCad) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                    "SELECT
                        cc.clasprod,
                        cc.descr,
                        cc.anal,
                        cc.sainalista,
                        cc.participacfem,
                        cc.percentualcfem,
                        cc.ativa,
                        cc.pagacomissaoindoferta,
                        cc.perccomissao,
                        cc.percdescmaximogerente,
                        cc.percdescmaximovendedor,
                        cc.similaridade,
                        cc.descrdetalhada,
                        cc.prioridadeentrega,
                        cc.id as 'id_erp',
                        cc.atualizadoem,
                        cc.codigo_gnre,
                        ct.SYS_CHANGE_OPERATION AS 'operation'
                    FROM CHANGETABLE (CHANGES [CLASSIFCAD], :lastVersion) AS ct
                    INNER JOIN CLASSIFCAD cc on cc.clasprod = ct.clasprod
                    INNER JOIN PRODUTOCAD pro on pro.clasprod = cc.clasprod"
                    ,['lastVersion' => $lastVersionClassifCad]);

        return json_decode(json_encode($dados), true);
    }

}
