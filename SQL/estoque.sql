SELECT 
    ct.codpro,
    pro.dv,
    TRIM(pro.codinterno) AS 'referencia',
    TRIM(CONCAT((i.quant - i.qtdereserv), '')) AS 'estoque_atual',
    ct.filial,
    ct.SYS_CHANGE_OPERATION AS last_operation,
    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
FROM CHANGETABLE (CHANGES [ITEMFILEST], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN itemfilest i ON i.codpro = ct.codpro and i.filial = ct.filial
LEFT JOIN produtocad pro ON pro.codpro = i.codpro AND pro.dv = i.dv 
WHERE (i.quant - i.qtdereserv) > 0