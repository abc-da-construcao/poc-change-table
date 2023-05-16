<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionFornecedorControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_fornecedor')->first();

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
    public static function updateLastTrackingFornecedorTable($version) {

        //atualiza a ultima versao na tabela de controle
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_fornecedor')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_fornecedor';
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
    public static function flushFornecedor($dados) {

        Fornecedor::upsert($dados, ['oid'],
                        [
                            "oid",
                            "rescopo",
                            "nome",
                            "razao_social",
                            "identificador",
                            "codigo",
                            "atualizado_em",
                            "criado_em",
                            "atualizado_por",
                            "criado_por",
                            "cid",
                            "observacao",
                            "excluido",
                            "operation"
                        ]);
                    }


    /**
     * busca as ultimas modificações do foprnecedor da tabela [PESSOA] no ERP
     */
    public static function getLastChagingTrackingFornecedor($lastVersionFornecedor) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                    "SELECT
                        i.OID AS 'oid',
                        i.RESCOPO AS 'rescopo',
                        i.NOME AS 'nome',
                        p.RAZAOSOCIAL AS 'razao_social',
                        p.IDENTIFICADOR AS 'identificador',
                        i.CODIGO AS 'codigo',
                        i.ATUALIZADOEM AS 'atualizado_em',
                        i.CRIADOEM AS 'criadoe_m',
                        i.ATUALIZADOPOR AS 'atualizado_por',
                        i.CRIADOPOR AS 'criado_por',
                        i.CID AS 'cid',
                        i.OBSERVACAO AS 'observacao',
                        i.EXCLUIDO AS 'excluido',
                        ct.SYS_CHANGE_OPERATION AS 'operation'
                    FROM CHANGETABLE (CHANGES [PESSOA], :lastVersion) AS ct
                    INNER JOIN PESSOA p ON p.OID = ct.OID
                    INNER JOIN  ITEM i ON p.OID = i.OID
                    WHERE (i.EXCLUIDO = 0)
                    AND p.OID = i.OID
                    AND i.OID in (select c.RITEM from CLASSIFICACAO c where c.RCATEGORIA = 2125 or c.OID = 7)"
                    ,['lastVersion' => $lastVersionFornecedor]);

        return json_decode(json_encode($dados), true);
    }

}
