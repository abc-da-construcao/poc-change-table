<?php

namespace App\Services;

use App\Models\Filiais;
use Illuminate\Support\Facades\DB;

class FiliaisService {
    
    const NOME_CONFIGURACOES = 'change_tracking_filiais';

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERP($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                'SELECT
                    f.codempresa,
                    f.filial,
                    f.nome,
                    f.cgc,
                    f.oidempresa,
                    f.oid
           FROM CHANGETABLE (CHANGES [FILIALCAD], :lastVersion) AS ct
           JOIN FILIALCAD f on f.oid = ct.oid', ['lastVersion' => $lastVersion]);
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
        ]);
    }

}
