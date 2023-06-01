SELECT 
    ct.codpro,
    pro.dv,
    TRIM(pro.codinterno) AS 'referencia',
    ISNULL((SUM(i.quant) - SUM(i.quantrec)), 0) as 'estoque_futuro',
    i.filial, 
    ISNULL((SELECT (SUM(ifc.quant) - SUM(ifc.quantrec)) FROM itemforcad ifc  WHERE ifc.codpro=ct.codpro AND ifc.filial = i.filial AND ifc.quantrec <> ifc.quant AND ifc.dtprevrec BETWEEN GETDATE() AND GETDATE() + 15 GROUP BY ifc.codpro, ifc.filial), 0) as 'compras_1', 
    ISNULL((SELECT (SUM(ifc.quant) - SUM(ifc.quantrec)) FROM itemforcad ifc  WHERE ifc.codpro=ct.codpro AND ifc.filial = i.filial AND ifc.quantrec <> ifc.quant AND ifc.dtprevrec BETWEEN GETDATE() + 16 AND GETDATE() + 45 GROUP BY ifc.codpro, ifc.filial), 0) as 'compras_2',
    ct.SYS_CHANGE_OPERATION AS last_operation,
    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
FROM CHANGETABLE (CHANGES [itemforcad], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN produtocad pro ON pro.codpro = ct.codpro
LEFT JOIN itemforcad i ON i.codpro = ct.codpro
    WHERE i.quantrec <> i.quant
    GROUP BY ct.codpro,
             pro.dv,
             ct.SYS_CHANGE_OPERATION,
             tc.commit_time,
             pro.codinterno,
             i.filial
