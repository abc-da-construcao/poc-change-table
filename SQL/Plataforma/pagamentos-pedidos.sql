SELECT
    CONCAT(p.orçamento_id, '-plataforma') as 'plataforma_id_pedido_mdm',
    REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as 'plataforma_id_cliente_mdm',
    p.orçamento_id as 'pd_orcamento_id',
    CASE
        WHEN pglj.id is null and pgfnc.id is not null THEN CONCAT( p.orçamento_id,'-financiamento-',pgfnc.id )
         WHEN pglj.id is not null and pgfnc.id is null then CONCAT( p.orçamento_id,'-loja-',pglj.id )
       ELSE CONCAT(p.orçamento_id,'-pedido')
    end as 'orcamento_id',
    p.pedidos_mu as 'plataforma_pd_pedidos_mu',
    CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE((UPPER(REPLACE(TRIM(c.nome), ' ', ''))), 'Á','A'), 'À','A'), 'Ã','A'), 'Â','A'), 'É','E'), 'È','E'), 'Ê','E'), 'Í','I'), 'Ì','I'), 'Î','I'), 'Ó','O'), 'Ò','O'), 'Ô','O'), 'Õ','O'), 'Ú','U'), 'Ù','U'), 'Û','U'), 'Ü','U'), 'Ç','C'), REPLACE(REPLACE(REPLACE(REPLACE(IFNULL(IFNULL(c.celular, c.telefone), c.email), '(', ''), ')', ''), '-', ''), ' ', '') )  as 'idLeadMdm',
    pglj.id as 'plataforma_pglj_id',
    pglj.orcamento_id as 'pglj_orcamento_id',
    pglj.forma_id as 'plataforma_pglj_forma_id',
    pglj.tipo_id as 'plataforma_pglj_tipo_id',
    pglj.parcela as 'plataforma_pglj_parcela',
    pglj.entrada as 'plataforma_pglj_entrada',
    pglj.variavel as 'plataforma_pglj_variavel',
    pglj.tipo as 'plataforma_pglj_tipo',
    pglj.nome_tipo as 'plataforma_pglj_nome_tipo',
    pglj.valor as 'plataforma_pglj_valor',
    pglj.edit_data as 'plataforma_pglj_edit_data',
    pglj.cartao as 'plataforma_pglj_cartao',
    pglj.link_cielo as 'plataforma_pglj_link_cielo',
    pglj.image_qrcode_pix as 'plataforma_pglj_image_qrcode_pix',
    pglj.emv as 'plataforma_pglj_emv',
    pglj.txid as 'plataforma_pglj_txid',
    pglj.end_to_end_id as 'plataforma_pglj_end_to_end_id',
    pglj.link_boleto as 'plataforma_pglj_link_boleto',
    pglj.boleto_tentativa as 'plataforma_pglj_boleto_tentativa',
    pglj.data_boleto as 'plataforma_pglj_data_boleto',
    pglj.data_pagamento_boleto as 'plataforma_pglj_data_pagamento_boleto',
    pglj.data_pagamento_pix as 'plataforma_pglj_data_pagamento_pix',
    pglj.nsu as 'plataforma_pglj_nsu',
    pglj.tid as 'plataforma_pglj_tid',
    pglj.item_nsu_mu as 'plataforma_pglj_item_nsu_mu',
    pglj.status as 'plataforma_pglj_status',
    pglj.origem as 'plataforma_pglj_origem',
    pglj.data as 'plataforma_pglj_data',
    pglj.data_pix as 'plataforma_pglj_data_pix',
    pglj.log_app_pagseguro as 'plataforma_pglj_log_app_pagseguro',
    pglj.created_at as 'plataforma_pglj_created_at',
    pglj.updated_at as 'plataforma_pglj_updated_at',
    pgfnc.id as 'plataforma_pgfnc_id',
    pgfnc.orcamento_id as 'plataforma_pgfnc_orcamento_id',
    pgfnc.oid_plano as 'plataforma_pgfnc_oid_plano',
    pgfnc.oid_documento as 'plataforma_pgfnc_oid_documento',
    pgfnc.oid_entrada as 'plataforma_pgfnc_oid_entrada',
    pgfnc.parcelas as 'plataforma_pgfnc_parcelas',
    pgfnc.carencia as 'plataforma_pgfnc_carencia',
    pgfnc.valor as 'plataforma_pgfnc_valor',
    pgfnc.created_at as 'plataforma_pgfnc_created_at',
    tpdoc.id as 'plataforma_tpdoc_id',
    tpdoc.oid_forma_pagamento as 'plataforma_tpdoc_oid_forma_pagamento',
    tpdoc.oid_tipo_documento as 'plataforma_tpdoc_oid_tipo_documento',
    tpdoc.nome as 'plataforma_tpdoc_nome',
    tpdoc.entrada as 'plataforma_tpdoc_entrada',
    tpdoc.created_at as 'plataforma_tpdoc_created_at',
    p.created_at as 'plataforma_pd_created_at',
    p.updated_at as 'plataforma_pd_updated_at'
FROM pedidos p
LEFT join clientes c ON c.id = p.cliente_id
LEFT JOIN pagamento_loja as pglj ON pglj.orcamento_id = p.orçamento_id
LEFT JOIN pagamento_financiamento as pgfnc ON pgfnc.orcamento_id = p.orçamento_id
LEFT JOIN tipo_documento tpdoc ON tpdoc.oid_tipo_documento = pglj.tipo_id and pglj.forma_id = tpdoc.oid_forma_pagamento
WHERE (pglj.id IS NOT NULL OR pgfnc.id IS NOT NULL)
   and ((p.updated_at IS NOT NULL and p.updated_at >= :timeStamp) OR (p.created_at >= :timeStamptTwo))