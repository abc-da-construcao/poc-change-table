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

        Fornecedor::upsert($dados, ['clasprod'],
                        [
                            "clasprod",

                            "operation"
                        ]);
                    }


    /**
     * busca as ultimas modificações de complementos do produto da tabela no ERP
     */
    public static function getLastChagingTrackingFornecedor($lastVersionClassifCad) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                    ""
                    ,['lastVersion' => $lastVersionClassifCad]);

        return json_decode(json_encode($dados), true);
    }

}
