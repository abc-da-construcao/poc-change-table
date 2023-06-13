<?php

namespace App\Services\Plataforma;

use App\Models\Especificadores;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;

class EspecificadoresService {

    const NOME_CONFIGURACOES = 'timestamp_plataforma_especificadores';

    public static function getDadosPlataforma($timeStamp) {

        $dados = DB::connection('mysql_plataforma')->select(
                "SELECT 	
                    REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as idEspecificadorMdm,
                    ee.id as 'idEspecificadorPlataforma',
                    ee.nome as 'nomeEspecificador',
                    c.id as 'maxIdClienteEspecificadorPlataforma',
                    c.updated_at as plataforma_updated_at,		
                    ec.numero_inscricao as 'inscEstadualEspecificador', 
                    ec.observacao,
                    ec.instagram,
                    ec.titular,
                    ec.nome_titular,
                    ec.documento_titular,
                    ec.conta_banco,
                    ec.conta_agencia,
                    ec.conta_tipo,
                    ec.conta_numero,
                    UPPER(c.nome) as 'nome',
                    LOWER(concat((SUBSTRING(c.nome, 1,1)), TRIM(SUBSTRING(SUBSTRING_INDEX(c.nome, ' ', -1), 1,20)), ee.id)) as 'portalUser',
                    LOWER(concat((SUBSTRING(c.nome, 1,3)), ee.id)) as 'aliassf',
                    c.user_id,
                    IFNULL(u.filial_id, 14) as 'filialReferencia',
                    u.name as 'NomeUserPv', 
                    u.nome_original as 'NomeOrigUserPv',	
                    u.filial_id as 'filial_id_user_cad', 
                    f.nome as 'filial_user_cad',
                    f.filial as 'idFilialMU',
                    u.id as 'idUserPv',
                    u.`user` as 'idUserMu'
                FROM especificadores_especificador ee
                INNER JOIN clientes c on c.id = (SELECT c2.id FROM clientes c2 WHERE REPLACE(REPLACE(REPLACE(c2.documento, '.', ''), '-', ''), '/', '') = REPLACE(REPLACE(REPLACE(ee.documento, '.', ''), '-', ''), '/', '') ORDER BY c2.id DESC LIMIT 1 )
                LEFT JOIN especificadores_complemento ec ON ec.cliente_id = c.id
                LEFT JOIN users u ON c.user_id = u.id  
                LEFT JOIN filiais f ON u.filial_id = f.id 
                WHERE ((ee.updated_at IS NOT NULL AND ee.updated_at >= :timeStamp) OR (ee.created_at >= :timeStampD))", ['timeStamp' => $timeStamp, 'timeStampD' => $timeStamp]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flush($dados) {

        Especificadores::upsert($dados, ['idEspecificadorMdm'],
                [
                    'idEspecificadorMdm',
                    'idEspecificadorPlataforma',
                    'nomeEspecificador',
                    'maxIdClienteEspecificadorPlataforma',
                    'plataforma_updated_at',
                    'inscEstadualEspecificador',
                    'observacao',
                    'instagram',
                    'titular',
                    'nome_titular',
                    'documento_titular',
                    'conta_banco',
                    'conta_agencia',
                    'conta_tipo',
                    'conta_numero',
                    'nome',
                    'portalUser',
                    'aliassf',
                    'user_id',
                    'filialReferencia',
                    'NomeUserPv',
                    'NomeOrigUserPv',
                    'filial_id_user_cad',
                    'filial_user_cad',
                    'idFilialMU',
                    'idUserPv',
                    'idUserMu'
        ]);
    }

}