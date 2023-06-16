<?php

namespace App\Services\Plataforma;

use App\Models\Orcamentos;
use Illuminate\Support\Facades\DB;

class OrcamentoService {

    const NOME_CONFIGURACOES = 'timestamp_plataforma_orcamentos';

    public static function getDadosPlataforma($timeStamp) {

        $dados = DB::connection('mysql_plataforma')->select(
                "SELECT  
                        CONCAT(orc.id, '-plataforma') as 'orcamento_id',
                        CONCAT(orc.id, '-plataforma') as 'idOrcamentoMdm',
                        REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as 'idClienteMdm',
                        CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE((UPPER(REPLACE(TRIM(c.nome), ' ', ''))), 'Á','A'), 'À','A'), 'Ã','A'), 'Â','A'), 'É','E'), 'È','E'), 'Ê','E'), 'Í','I'), 'Ì','I'), 'Î','I'), 'Ó','O'), 'Ò','O'), 'Ô','O'), 'Õ','O'), 'Ú','U'), 'Ù','U'), 'Û','U'), 'Ü','U'), 'Ç','C'), REPLACE(REPLACE(REPLACE(REPLACE(IFNULL(IFNULL(c.celular, c.telefone), c.email), '(', ''), ')', ''), '-', ''), ' ', '') )  as 'idLeadMdm',
                        orc.cliente_id as 'IdClientePlataforma', 
                        UPPER(c.nome) as 'CLIENTE', 
                        REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as Documento,
                        c.email, 
                        c.telefone, 
                        c.celular, 
                        c.inscricao, 
                        c.contribuinte_icms,		
                        fv.tipo as 'tipoPedido',
                        orc.users_id as 'IdUserCadPedidoPlataforma',	
                        ufp.filial_id as 'idfilialCatPedido',				
                        fp.nome as 'nomeFilialPedido',
                        fp.filial as 'idFilialPedidoMU',
                        ufp.name as 'NomeUserFilialPedido', 
                        ufp.nome_original as 'NomeOrigUserFilialPedido',
                        ufp.id as 'idPlataformaUserFilialPedido',
                        ufp.`user` as 'idMuUserFilialPedido',
                        IFNULL(fv.filial_id, ufp.filial_id) as 'idCatFilialOrigem', 
                        IFNULL(fo.nome, fp.nome)  as 'nomeFilialOrigemPedido',
                        IFNULL(fo.filial, fp.filial) as 'idFilialOrigemMU',
                        av.nome as 'nomeAv',
                        av.canal_venda_id,
                        av.descricao as 'descAv',
                        av.codigo as 'codigoAv',
                        orc.cupom_id,
                        cp.tipo_cupom_id,
                        cp.nome as 'nomeCupom',
                        cp.qtd as 'qtdCupom' ,
                        cp.frete_gratis as 'cupomFreteGratis',
                        cp.desconto as 'valorDescontoCupom',
                        tc.nome as 'tipoCupom',
                        tvc.nome as 'tipoValidacaoCupom',
                        ende.clientes_id ,
                        ende.oid_cliente ,
                        ende.oid_endereco ,
                        ende.oid_classificacao ,
                        ende.destinatario ,
                        ende.cep ,
                        ende.endereco,
                        ende.numero,
                        ende.complemento ,
                        ende.bairro,
                        ende.cidade,
                        ende.estado,
                        ende.referencia ,
                        ende.tipo ,
                        ende.principal,
                        ende.mesmo,
                        ende.oid_cidade,
                        ende.oid_estado 
                FROM orcamentos orc
                INNER JOIN clientes c ON c.id = orc.cliente_id	
                INNER JOIN enderecos ende ON ende.clientes_id = orc.cliente_id AND ende.principal = 1 AND tipo IN ('ENTREGA', 'entrega')
                LEFT JOIN status s on s.id = orc.status 
                LEFT JOIN users ufp on orc.users_id = ufp.id 
                LEFT JOIN filiais fp on ufp.filial_id = fp.id 
                LEFT JOIN filiais_vinculos fv on fv.users_user = ufp.`user`
                LEFT JOIN filiais fo on fo.id = fv.filial_id
                LEFT JOIN area_venda av on av.id = fp.are_venda_id 
                LEFT JOIN cupom cp ON cp.id = orc.cupom_id
                LEFT JOIN tipo_cupom  tc ON tc.id = cp.tipo_cupom_id
                LEFT JOIN tipo_validacao_cupom tvc ON tvc.id = cp.tipo_validacao_cupom_id
                WHERE ((orc.updated_at is not null and orc.updated_at >= :timeStamp) or (orc.created_at >= :timeStampD))", ['timeStamp' => $timeStamp, 'timeStampD' => $timeStamp]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flush($dados) {

        Orcamentos::upsert($dados, ['orcamento_id'],
                [
                    'orcamento_id',
                    'idOrcamentoMdm',
                    'idClienteMdm',
                    'idLeadMdm',
                    'IdClientePlataforma',
                    'CLIENTE',
                    'Documento',
                    'email',
                    'telefone',
                    'celular',
                    'inscricao',
                    'contribuinte_icms',
                    'tipoPedido',
                    'IdUserCadPedidoPlataforma',
                    'idfilialCatPedido',
                    'nomeFilialPedido',
                    'idFilialPedidoMU',
                    'NomeUserFilialPedido',
                    'NomeOrigUserFilialPedido',
                    'idPlataformaUserFilialPedido',
                    'idMuUserFilialPedido',
                    'idCatFilialOrigem',
                    'nomeFilialOrigemPedido',
                    'idFilialOrigemMU',
                    'nomeAv',
                    'canal_venda_id',
                    'descAv',
                    'codigoAv',
                    'cupom_id',
                    'tipo_cupom_id',
                    'nomeCupom',
                    'qtdCupom',
                    'cupomFreteGratis',
                    'valorDescontoCupom',
                    'tipoCupom',
                    'tipoValidacaoCupom',
                    'clientes_id',
                    'oid_cliente',
                    'oid_endereco',
                    'oid_classificacao',
                    'destinatario',
                    'cep',
                    'endereco',
                    'numero',
                    'complemento',
                    'bairro',
                    'cidade',
                    'estado',
                    'referencia',
                    'tipo',
                    'principal',
                    'mesmo',
                    'oid_cidade',
                    'oid_estado'
        ]);
    }

}
