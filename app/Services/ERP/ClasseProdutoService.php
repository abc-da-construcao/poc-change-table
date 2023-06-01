<?php

namespace App\Services\ERP;

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
                            "last_operation",
                            "last_commit_time"
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
                        ct.SYS_CHANGE_OPERATION AS 'last_operation',
                        COALESCE(tc.commit_time, GETDATE())  AS 'last_commit_time'
                    FROM CHANGETABLE (CHANGES [CLASSIFCAD], :lastVersion) AS ct
                    LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
                    LEFT JOIN CLASSIFCAD cc on cc.clasprod = ct.clasprod
                    LEFT JOIN PRODUTOCAD pro on pro.clasprod = cc.clasprod"
                    ,['lastVersion' => $lastVersionClassifCad]);

        return json_decode(json_encode($dados), true);
    }

}
