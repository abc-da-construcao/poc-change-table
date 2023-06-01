SELECT
    trim(p.codinterno) AS referencia,
    CONCAT(p.precoven,'') AS de,
    f.filial AS filial ,
    f.NOME as filial_nome,
    av.DESCR AS desc_area_venda,
    ct.areavend AS area_venda,
    ct.SYS_CHANGE_OPERATION AS last_operation,
    COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
FROM CHANGETABLE (CHANGES [areaprecad], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN areaprecad p on p.areavend = ct.areavend and p.codpro = ct.codpro
LEFT JOIN ADITIVO a on a.nvalor = p.areavend
LEFT JOIN DADOADICIONAL_V d  ON d.OID = a.RDEFINICAO  
LEFT JOIN FILIALCAD f on f.OID = a.RITEM
LEFT JOIN areavencad av ON p.areavend = av.areavend
WHERE d.oid = '29661' -- Dado adicional Área de Vendas atendida pela Filial