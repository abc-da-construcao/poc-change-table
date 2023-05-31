SELECT
    i.Usuario,
    i.Estacao,
    i.Filial,
    CASE
       WHEN (p.referencia is not null) AND (p.referencia <> '') AND (p.referencia <> ' ')  
           THEN p.referencia
       ELSE CAST(p.numped AS VARCHAR(100))
    END AS pedido_id,
    i.Pedido,
    i.Codpro,
    ct.Item,
    i.Quant,
    ct.Reservado,
    i.Faturado,
    i.Cancelado,
    i.NUMEROLISTA,
    i.ORDEMENTREGA,
    i.SITMANUT,
    i.VIAORDEMSEPARACAO,
    i.NUMORD,
    i.NUMPEDTRANSFERENCIA,
    i.DataOrdemSeparacao,
    i.ID,
    i.DATAMONTAGEM,
    i.NUMORDTRANSF,
    i.ORDEMCARGA,
    i.DTINICIOSEPARACAO,
    i.DTFIMSEPARACAO,
    i.ROTEIRIZADOR,
    i.CARGAROTEIRIZADOR,
    i.DestinoRoteirizador,
    i.USUARIOALTEROUSITMANUT,
    i.ESTACAOALTEROUSITMANUT,
    i.PROGRAMAALTEROUSITMANUT,
    i.DATAALTEROUSITMANUT,
    ct.SYS_CHANGE_OPERATION AS last_operation,
    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
FROM CHANGETABLE (CHANGES [ITEMFATURADO], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN ITEMFATURADO i on i.item = ct.item and i.reservado = ct.reservado
LEFT JOIN PEDICLICAD p on p.numped = i.pedido