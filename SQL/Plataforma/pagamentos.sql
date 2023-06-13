/** ==================================================================================== */
/** =================== CONTEXTO ===== PAGAMENTOS PLATAFORMA =========================== */
/** ==================================================================================== */
SELECT
    CONCAT(p.orçamento_id, '-plataforma') as 'id_pedido_mdm',
    REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as 'id_cliente_mdm',
    p.orçamento_id as 'pd_orçamento_id',
    p.pedidos_mu as 'pd_pedidos_mu',
    p.valor as 'pd_total_pedido',
    pglj.id as 'pglj_id',
    pglj.orcamento_id as 'pglj_orcamento_id',
    pglj.forma_id as 'pglj_forma_id',
    pglj.tipo_id as 'pglj_tipo_id',
    pglj.parcela as 'pglj_parcela',
    pglj.entrada as 'pglj_entrada',
    pglj.variavel as 'pglj_variavel',
    pglj.tipo as 'pglj_tipo',
    pglj.nome_tipo as 'pglj_nome_tipo',
    pglj.valor as 'pglj_valor',
    pglj.edit_data as 'pglj_edit_data',
    pglj.cartao as 'pglj_cartao',
    pglj.link_cielo as 'pglj_link_cielo',
    pglj.image_qrcode_pix as 'pglj_image_qrcode_pix',
    pglj.emv as 'pglj_emv',
    pglj.txid as 'pglj_txid',
    pglj.end_to_end_id as 'pglj_end_to_end_id',
    pglj.link_boleto as 'pglj_link_boleto',
    pglj.boleto_tentativa as 'pglj_boleto_tentativa',
    pglj.data_boleto as 'pglj_data_boleto',
    pglj.data_pagamento_boleto as 'pglj_data_pagamento_boleto',
    pglj.data_pagamento_pix as 'pglj_data_pagamento_pix',
    pglj.nsu as 'pglj_nsu',
    pglj.tid as 'pglj_tid',
    pglj.item_nsu_mu as 'pglj_item_nsu_mu',
    pglj.status as 'pglj_status',
    pglj.origem as 'pglj_origem',
    pglj.data as 'pglj_data',
    pglj.data_pix as 'pglj_data_pix',
    pglj.log_app_pagseguro as 'pglj_log_app_pagseguro',
    pglj.created_at as 'pglj_created_at',
    pglj.updated_at as 'pglj_updated_at',
    pgfnc.id as 'pgfnc_id',
    pgfnc.orcamento_id as 'pgfnc_orcamento_id',
    pgfnc.oid_plano as 'pgfnc_oid_plano',
    pgfnc.oid_documento as 'pgfnc_oid_documento',
    pgfnc.oid_entrada as 'pgfnc_oid_entrada',
    pgfnc.parcelas as 'pgfnc_parcelas',
    pgfnc.carencia as 'pgfnc_carencia',
    pgfnc.valor as 'pgfnc_valor',
    pgfnc.created_at as 'pgfnc_created_at',
    tpdoc.id as 'tpdoc_id',
    tpdoc.oid_forma_pagamento as 'tpdoc_oid_forma_pagamento',
    tpdoc.oid_tipo_documento as 'tpdoc_oid_tipo_documento',
    tpdoc.nome as 'tpdoc_nome',
    tpdoc.entrada as 'tpdoc_entrada',
    tpdoc.created_at as 'tpdoc_created_at',
    p.created_at as 'created_at',
    p.updated_at as 'updated_at'
FROM pedidos p
LEFT join clientes c ON c.id = p.cliente_id
LEFT JOIN pagamento_loja as pglj ON pglj.orcamento_id = p.orçamento_id
LEFT JOIN pagamento_financiamento as pgfnc ON pgfnc.orcamento_id = p.orçamento_id
LEFT JOIN tipo_documento as tpdoc ON tpdoc.oid_tipo_documento = pgfnc.oid_entrada
WHERE
    ((p.updated_at IS NOT NULL and p.updated_at >= :timeStamp) OR (p.created_at >= :timeStamp))
ORDER BY
    p.id DESC;
