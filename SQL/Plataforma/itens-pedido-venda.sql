
SELECT  pp.id as 'idItemPedidoPvMdm',
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
WHERE ((pp.updated_at IS NOT NULL and pp.updated_at >= :timeStamp) OR (pp.created_at >= :timeStampD))