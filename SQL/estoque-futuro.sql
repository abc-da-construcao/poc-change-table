SELECT 
    ct.codpro,
    pro.dv,
    TRIM(pro.codinterno) AS 'referencia',
    (SUM(i.quant) - SUM(i.quantrec)) as 'estoque_futuro',
    i.filial,
    ct.SYS_CHANGE_OPERATION AS last_operation,
    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
FROM CHANGETABLE (CHANGES [itemforcad], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN itemforcad i ON i.codpro = ct.codpro AND i.numped = ct.numped
LEFT JOIN produtocad pro ON pro.codpro = ct.codpro AND pro.dv = i.dv
WHERE i.quantrec <> i.quant
GROUP BY ct.codpro,
    pro.dv,
    ct.SYS_CHANGE_OPERATION,
    tc.commit_time,
    pro.codinterno,
    i.filial
