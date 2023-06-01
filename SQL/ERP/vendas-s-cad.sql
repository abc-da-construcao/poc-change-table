SELECT
    ct.numord,
    v.filial,
    v.localporta,
    v.dtven,
    v.usuven,
    CASE
        WHEN (p.referencia is not null) AND (p.referencia <> '') AND (p.referencia <> ' ')  
            THEN p.referencia
        ELSE CAST(p.numped AS VARCHAR(100))
    END AS pedido_id,
    v.numped,
    v.totven,
    v.freteorc,
    v.numfrete,
    v.dtentr,
    v.codtran,
    v.nordfrete,
    v.situacao,
    v.receber,
    v.taxanf,
    v.oiddocdeorigem,
    v.condpagposterior,
    v.PENDENTE,
    v.MANUAL,
    v.OUTRASDESPESASINCLUSAS,
    v.TOTRECANTECIPADO,
    v.TIPO,
    v.TROCO,
    v.RDOCDOACAO,
    v.VALORDOACAO,
    ct.SYS_CHANGE_OPERATION AS last_operation,
    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
FROM CHANGETABLE (CHANGES [VENDASSCAD], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN VENDASSCAD v on v.numord = ct.numord
LEFT JOIN PEDICLICAD p on p.numped = v.numped