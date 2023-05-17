<?php

namespace App\Services;

use App\Models\ClasseProduto;
use Illuminate\Support\Facades\DB;

class ClasseProdutoService {

    const NOME_CONFIGURACOES = 'change_tracking_produto_classifCad';

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
