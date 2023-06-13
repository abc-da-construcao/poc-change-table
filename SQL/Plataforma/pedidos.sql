SELECT  
    CONCAT(p.orçamento_id, '-plataforma') as 'pedido_id',
    CONCAT(p.orçamento_id, '-plataforma') as 'plataforma_idPedidoMdm',
    REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as 'plataforma_idClienteMdm',
    p.cliente_id as 'plataforma_IdClientePlataforma', 
    UPPER(c.nome) as 'plataforma_CLIENTE', 
    REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as plataforma_Documento,
    c.email as plataforma_email, 
    c.telefone as plataforma_telefone, 
    c.celular as plataforma_celular, 
    c.inscricao as plataforma_inscricao, 
    c.contribuinte_icms as plataforma_contribuinte_icms,  
    p.orçamento_id as plataforma_orçamento_id,
    p.frete_id as plataforma_frete_id,
    p.tipo_cartao as plataforma_tipo_cartao,
    p.tipo_pagamento as plataforma_tipo_pagamento,
    p.PaymentId as plataforma_PaymentId,
    p.score as plataforma_score,
    p.ReturnMessage as plataforma_ReturnMessage,
    p.ReturnCode as plataforma_ReturnCode,
    p.transportadora as plataforma_transportadora,
    p.prazo_entrega as plataforma_prazo_entrega,
    p.empresaId as plataforma_empresaId,
    p.nosso_numero as plataforma_nosso_numero,
    p.vencimento as plataforma_vencimento,
    p.rand_email as plataforma_rand_email,
    p.obs as plataforma_obs,
    p.info_adicionais as plataforma_info_adicionais,
    p.area_venda_id as plataforma_area_venda_id,
    p.created_at as plataforma_created_at,
    p.updated_at as plataforma_updated_at,		
    p.valor as 'plataforma_valorPedido', 
    p.status as 'plataforma_codStatus', 
    s.status as 'plataforma_statusPedido', 
    p.id as 'plataforma_idPedidoPlataforma', 
    IFNULL(p.valor_frete, 0) as 'plataforma_valor_frete' , 
    p.desconto as plataforma_desconto, 
    p.valor_carrinho_sem_desconto as plataforma_valor_carrinho_sem_desconto, 
    p.valor_total_pedido as plataforma_valor_total_pedido, 
    p.qtd_parcelas as plataforma_qtd_parcelas, 
    IFNULL(p.extra, 0) as 'plataforma_extra', 
    p.valor - (IFNULL(p.extra, 0) + IFNULL(p.valor_frete,0)) as 'plataforma_ValorPontuacaoAbcx',
    fv.tipo as 'plataforma_tipoPedido',
    p.users_id as 'plataforma_IdUserCadPedidoPlataforma',	
    ufp.filial_id as 'plataforma_idfilialCatPedido',				
    fp.nome as 'plataforma_nomeFilialPedido',
    fp.filial as 'plataforma_idFilialPedidoMU',
    ufp.name as 'plataforma_NomeUserFilialPedido', 
    ufp.nome_original as 'plataforma_NomeOrigUserFilialPedido',
    ufp.id as 'plataforma_idPlataformaUserFilialPedido',
    ufp.`user` as 'plataforma_idMuUserFilialPedido',
    IFNULL(fv.filial_id, ufp.filial_id) as 'plataforma_idCatFilialOrigem', 
    IFNULL(fo.nome, fp.nome)  as 'plataforma_nomeFilialOrigemPedido',
    IFNULL(fo.filial, fp.filial) as 'plataforma_idFilialOrigemMU',
    av.nome as 'plataforma_nomeAv',
    av.canal_venda_id as plataforma_canal_venda_id,
    av.descricao as 'plataforma_descAv',
    av.codigo as 'plataforma_codigoAv',
    p.cupom_id as plataforma_cupom_id,
    cp.tipo_cupom_id as plataforma_tipo_cupom_id,
    cp.nome as 'plataforma_nomeCupom',
    cp.qtd as 'plataforma_qtdCupom' ,
    cp.frete_gratis as 'plataforma_cupomFreteGratis',
    cp.desconto as 'plataforma_valorDescontoCupom',
    tc.nome as 'plataforma_tipoCupom',
    tvc.nome as 'plataforma_tipoValidacaoCupom'
FROM digitala_vendas.pedidos p
    LEFT JOIN digitala_vendas.clientes c ON p.cliente_id = c.id 
    LEFT JOIN digitala_vendas.status s ON s.id = p.status 
    LEFT JOIN digitala_vendas.users ufp ON p.users_id = ufp.id 
    LEFT JOIN digitala_vendas.filiais fp ON ufp.filial_id = fp.id 
    LEFT JOIN digitala_vendas.filiais_vinculos fv ON fv.users_user = ufp.`user`
    LEFT JOIN digitala_vendas.filiais fo ON fo.id = fv.filial_id
    LEFT JOIN area_venda av ON av.id = fp.are_venda_id 
    LEFT JOIN cupom cp ON cp.id = p.cupom_id
    LEFT JOIN tipo_cupom  tc ON tc.id = cp.tipo_cupom_id
    LEFT JOIN tipo_validacao_cupom tvc ON tvc.id = cp.tipo_validacao_cupom_id
WHERE ((p.updated_at IS NOT NULL and p.updated_at >= :timeStamp) OR (p.created_at >= :timeStampD))