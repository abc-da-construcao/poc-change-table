
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
    i.Item,
    i.Quant,
    i.Reservado,
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
    i.DATAALTEROUSITMANUT
FROM CHANGETABLE (CHANGES [ITEMFATURADO], :lastVersion) AS ct
JOIN ITEMFATURADO i on i.item = ct.item and i.reservado = ct.reservado
JOIN PEDICLICAD p on p.numped = i.pedido