<?php

namespace App\Services\Plataforma;

use App\Models\Filiais;
use Illuminate\Support\Facades\DB;

class FiliaisService {

    const NOME_CONFIGURACOES = 'timestamp_plataforma_filiais';

    public static function getDadosPlataforma($timeStamp) {

        $dados = DB::connection('mysql_plataforma')->select(
                "SELECT 
                    f.are_venda_id as plataforma_are_venda_id,
                    f.tipo_loja_id as plataforma_tipo_loja_id,
                    f.empresa as plataforma_empresa,
                    f.filial as plataforma_filial,
                    f.nome as plataforma_nome,
                    f.nome_amigavel as plataforma_nome_amigavel,
                    f.cgc as plataforma_cgc,
                    f.oid_empresa as plataforma_oid_empresa ,
                    f.oid,
                    f.filial_virtual as plataforma_filial_virtual ,
                    f.ativo as plataforma_filial_ativo,
                    f.dash as plataforma_dash,
                    f.ponto_retirada as plataforma_ponto_retirada,
                    f.conta_gerencial as plataforma_conta_gerencial,
                    f.cnpj_franquia as plataforma_cnpj_franquia,
                    fc.filial_id as plataforma_filial_id,
                    fc.transfer as plataforma_transfer,
                    fc.virtual as plataforma_virtual,
                    fc.margem as plataforma_margem,
                    fc.operador_logistico as plataforma_operador_logistico,
                    fc.loja_fisica as plataforma_loja_fisica,
                    fc.retirar_loja as plataforma_retirar_loja,
                    fc.franquia as plataforma_franquia,
                    fc.loja_propria as plataforma_loja_propria,
                    fc.prazo_entrega as plataforma_prazo_entrega,
                    fc.prazo_maximo_retirada as plataforma_prazo_maximo_retirada,
                    fc.latitude as plataforma_latitude,
                    fc.longitude as plataforma_longitude,
                    fc.tray as plataforma_tray,
                    fe.cep as plataforma_cep,
                    fe.endereco as plataforma_endereco,
                    fe.bairro as plataforma_bairro,
                    fe.complemento as plataforma_complemento,
                    fe.numero as plataforma_numero,
                    fe.cidade as plataforma_cidade ,
                    fe.estado as plataforma_estado ,
                    fe.contato as plataforma_contato,
                    fe.ativo as plataforma_endereco_ativo
                    FROM filiais f 
                        LEFT JOIN filiais_complemento fc ON f.id = fc.filial_id  
                        LEFT JOIN filiais_endereco fe ON f.id = fe.filial_id  
                    WHERE f.updated_at >= :timeStamp
                        AND f.oid is not null", ['timeStamp' => $timeStamp]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flushFiliais($dados) {

        Filiais::upsert($dados, ['oid'],
                [
                    'plataforma_are_venda_id',
                    'plataforma_tipo_loja_id',
                    'plataforma_empresa',
                    'plataforma_filial',
                    'plataforma_nome',
                    'plataforma_nome_amigavel',
                    'plataforma_cgc',
                    'plataforma_oid_empresa',
                    'oid',
                    'plataforma_filial_ativo',
                    'plataforma_dash',
                    'plataforma_ponto_retirada',
                    'plataforma_conta_gerencial',
                    'plataforma_cnpj_franquia',
                    'plataforma_filial_id',
                    'plataforma_transfer',
                    'plataforma_virtual',
                    'plataforma_margem',
                    'plataforma_operador_logistico',
                    'plataforma_loja_fisica',
                    'plataforma_retirar_loja',
                    'plataforma_franquia',
                    'plataforma_loja_propria',
                    'plataforma_prazo_entrega',
                    'plataforma_prazo_maximo_retirada',
                    'plataforma_latitude',
                    'plataforma_longitude',
                    'plataforma_tray',
                    'plataforma_cep',
                    'plataforma_endereco',
                    'plataforma_bairro',
                    'plataforma_complemento',
                    'plataforma_numero',
                    'plataforma_cidade',
                    'plataforma_estado',
                    'plataforma_contato',
                    'plataforma_endereco_ativo'
        ]);
    }

}
