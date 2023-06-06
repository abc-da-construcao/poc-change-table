<?php

namespace App\Services\Plataforma;

use App\Models\ItensPedidoVendaPlataforma;
use Illuminate\Support\Facades\DB;

class ItensPedidoVendaService {

    const NOME_CONFIGURACOES = 'timestamp_plataforma_itens_pedido_venda';

    public static function getDadosPlataforma($timeStamp) {

        $dados = DB::connection('mysql_plataforma')->select(
                "SELECT  pp.id as 'idItemPedidoPvMdm',
                        CONCAT(pp.orcamento_id, '-plataforma') as 'idPedidoMdm',
                        p.codpro,
                        p.referencia,
                        p.codigoClasse,		
                        pp.pedidos_id ,
                        pp.pedido_id ,
                        pp.produtoid ,
                        pp.orcamento_id ,
                        pp.ambientes_id ,
                        pp.referencia as referencia_item,
                        pp.qtd ,
                        pp.caixa ,
                        pp.quebras ,
                        pp.preco ,
                        pp.total_desconto ,
                        pp.preco_unitario ,
                        pp.de,
                        pp.por ,
                        pp.preco_desconto ,
                        pp.desconto,
                        pp.codigo_cor_erp ,
                        pp.codigo_cor_fabricante ,
                        pp.cor_codigo_leque ,
                        pp.cor_nome_leque ,
                        pp.data_prevista ,
                        pp.id_rota ,
                        a.id as ambiente_id,
                        a.nome	as ambiente_nome
                FROM pedidos_produtos pp 
                        LEFT JOIN produtos p ON p.id = pp.produtoid
                        LEFT JOIN ambientes a ON a.id = pp.ambientes_id
                WHERE ((pp.updated_at IS NOT NULL and pp.updated_at >= :timeStamp) OR (pp.created_at >= :timeStampD))", ['timeStamp' => $timeStamp, 'timeStampD' => $timeStamp]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados 
     */
    public static function flushItens($dados) {

        ItensPedidoVendaPlataforma::upsert($dados, ['idItemPedidoPvMdm'],
                [
                    'idItemPedidoPvMdm',
                    'idPedidoMdm',
                    'codpro',
                    'referencia',
                    'codigoClasse',
                    'pedidos_id',
                    'pedido_id',
                    'produtoid',
                    'orcamento_id',
                    'ambientes_id',
                    'referencia_item',
                    'qtd',
                    'caixa',
                    'quebras',
                    'preco',
                    'total_desconto',
                    'preco_unitario',
                    'de',
                    'por',
                    'preco_desconto',
                    'desconto',
                    'codigo_cor_erp',
                    'codigo_cor_fabricante',
                    'cor_codigo_leque',
                    'cor_nome_leque',
                    'data_prevista',
                    'id_rota',
                    'ambiente_id',
                    'ambiente_nome',
        ]);
    }

}
