<?php

namespace App\Services\ERP;

use App\Models\Filiais;
use Illuminate\Support\Facades\DB;

class FiliaisService {
    
    const NOME_CONFIGURACOES = 'change_tracking_filiais';

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERP($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                "SELECT
                    f.codempresa,
                    f.filial,
                    f.nome,
                    f.cgc,
                    f.oidempresa,
                    ct.oid,
                    ct.SYS_CHANGE_OPERATION AS last_operation,
                    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
           FROM CHANGETABLE (CHANGES [FILIALCAD], :lastVersion) AS ct
           LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
           LEFT JOIN FILIALCAD f on f.oid = ct.oid", ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flushFiliais($dados) {

        Filiais::upsert($dados, ['oid'],
                [
                    "codempresa",
                    "filial",
                    "nome",
                    "cgc",
                    "oidempresa",
                    "oid",
                    "last_operation",
                    "last_commit_time"
        ]);
    }

}
