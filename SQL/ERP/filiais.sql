SELECT
        f.codempresa,
        f.filial,
        f.nome,
        f.cgc,
        f.oidempresa,
        ct.oid,
        ct.SYS_CHANGE_OPERATION AS last_operation,
        COALESCE(tc.commit_time, GETDATE()) AS last_commit_time
FROM CHANGETABLE (CHANGES [FILIALCAD], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN FILIALCAD f on f.oid = ct.oid