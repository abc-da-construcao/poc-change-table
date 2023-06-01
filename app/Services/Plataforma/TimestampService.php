<?php

namespace App\Services\Plataforma;

use App\Models\Configuracoes;
use Illuminate\Support\Facades\DB;

class TimestampService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getTimeStampByConfiguracao($nome) {
        $lastVersion = Configuracoes::where('nome', $nome)->first();

        //ainda não tem versao na tabela de controle
        if (empty($lastVersion)) {
            $version = DB::connection('mysql_plataforma')->selectOne('select NOW() as timestamp');
            return $version->timestamp;
        }

        return $lastVersion->valor;
    }

    /**
     * retorna o ultimo tracking para a proximo controle interno da execuçao
     */
    public static function getTimeStampBanco() {

        $version = DB::connection('mysql_plataforma')->selectOne('select NOW() as timestamp');
        return $version->timestamp;
    }

    /**
     * atualiza o valor na tabela de controle
     */
    public static function updateTimeStamp($version, $nome) {

        //atualiza a ultima versao na tabela de controle
        $LastVersionTable = Configuracoes::where('nome', $nome)->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = $nome;
        }

        $LastVersionTable->valor = $version;
        $LastVersionTable->save();
    }

}
