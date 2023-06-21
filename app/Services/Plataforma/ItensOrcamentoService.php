<?php

namespace App\Services\Plataforma;

use App\Models\ItensOrcamento;
use Illuminate\Support\Facades\DB;

class ItensOrcamentoService {

    const NOME_CONFIGURACOES = 'timestamp_plataforma_itens_orcamentos';

    public static function getDadosPlataforma($timeStamp) {

        $dados = DB::connection('mysql_plataforma')->select(
                "SELECT
                    CONCAT(o.id, '-plataforma') as 'orcamento_id',
                    CONCAT(o.id, '-plataforma') as 'idOrcamentoMdm',
                    o.status ,
                    o.prazo ,
                    o.cupom_id ,
                    o.motivo_perdido ,
                    o.extra ,
                    o.total as total_pedido,
                    o.obs,
                    o.info_adicionais ,
                    o.origem_id ,
                    o.orcamento_original ,
                    o.area_venda_id ,
                    o.ie_produtor_rural_id ,
                    o.neurotech_status ,
                    o.neurotech_user_id ,
                    o.neurotech_data_acao,
                    o.neurotech_data_duplicata ,
                    o.neurotech_restricao_cadastral ,
                    o.neurotech_restricao_externa ,
                    o.neurotech_restricao_receita ,
                    o.neurotech_vencidos ,
                    o.neurotech_compras ,
                    o.neurotech_vencer,
                    o.created_at as orcamento_created_at,
                    o.updated_at as orcamento_updated_at,
                    co.users_id,
                    co.cliente_id,
                    co.ambientes_id,
                    co.referencia,
                    co.produto_id,
                    co.qtd,
                    co.caixa,
                    co.de,
                    co.preco,
                    co.preco_desconto,
                    co.desconto,
                    co.total_desconto,
                    co.peso_unitario,
                    co.cupomid,
                    co.codigo_cupom_id,
                    co.frete_id,
                    co.transportadora,
                    co.frete,
                    co.cep,
                    co.estado,
                    co.cidade,
                    co.produto_gratis ,
                    co.produto_tintometrico,
                    co.codigo_cor_erp,
                    co.codigo_cor_fabricante,
                    co.cor_codigo_leque,
                    co.cor_nome_leque,
                    co.data_prevista,
                    co.id_rota ,
                    a.nome as nome_ambiente
                FROM orcamentos o 
                    INNER JOIN carrinho_orcamento co ON co.orcamento_id = o.id
                    INNER JOIN ambientes a ON a .id = co.ambientes_id
                WHERE ((o.updated_at is not null and o.updated_at >= :timeStamp) or (o.created_at >= :timeStampD))", ['timeStamp' => $timeStamp, 'timeStampD' => $timeStamp]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flush($dados) {

        ItensOrcamento::upsert($dados, ['orcamento_id'],
                [
                    'orcamento_id',
                    'idOrcamentoMdm',
                    'status',
                    'prazo',
                    'cupom_id',
                    'motivo_perdido',
                    'extra',
                    'total_pedido',
                    'obs',
                    'info_adicionais',
                    'origem_id',
                    'orcamento_original',
                    'area_venda_id',
                    'ie_produtor_rural_id',
                    'neurotech_status',
                    'neurotech_user_id',
                    'neurotech_data_acao',
                    'neurotech_data_duplicata',
                    'neurotech_restricao_cadastral',
                    'neurotech_restricao_externa',
                    'neurotech_restricao_receita',
                    'neurotech_vencidos',
                    'neurotech_compras',
                    'neurotech_vencer',
                    'orcamento_created_at',
                    'orcamento_updated_at',
                    'users_id',
                    'cliente_id',
                    'ambientes_id',
                    'referencia',
                    'produto_id',
                    'qtd',
                    'caixa',
                    'de',
                    'preco',
                    'preco_desconto',
                    'desconto',
                    'total_desconto',
                    'peso_unitario',
                    'cupomid',
                    'codigo_cupom_id',
                    'frete_id',
                    'transportadora',
                    'frete',
                    'cep',
                    'estado',
                    'cidade',
                    'produto_gratis',
                    'produto_tintometrico',
                    'codigo_cor_erp',
                    'codigo_cor_fabricante',
                    'cor_codigo_leque',
                    'cor_nome_leque',
                    'data_prevista',
                    'id_rota',
                    'nome_ambiente',
        ]);
    }

}
