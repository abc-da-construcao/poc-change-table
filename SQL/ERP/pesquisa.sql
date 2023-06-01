-- busca produto que sofreram alterações na tabela PESQUISA
SELECT
    pro.Codpro 			AS 'codpro',
    pro.dv 				AS 'dv',
    pro.codfor 		AS 'id_fornecedor',
    pro.codinterno		AS 'cod_interno_produtocad',
    pq.CODIGOEXTERNO	AS 'codigo_externo_pesquisa',
    pq.OID				AS 'oid_pesquisa',
    ct.SYS_CHANGE_OPERATION AS 'last_operation',
    COALESCE(tc.commit_time, GETDATE())  AS 'last_commit_time',
    ISNULL((SELECT TOP(1) pq.valorcusto FROM pesquisa_r pq WHERE pq.criadoem <= GETDATE()  AND pq.codigoexterno = pro.codpro ORDER BY criadoem DESC),0) AS 'valor_custo',
    ISNULL((SELECT TOP(1) pq.Valorsubsttrib FROM pesquisa_r pq WHERE pq.criadoem <= GETDATE()  AND pq.codigoexterno = pro.codpro ORDER BY criadoem DESC),0) AS 'valor_subst_nf',
    ISNULL((SELECT TOP(1) pq.Valtribantecipada FROM pesquisa_r pq WHERE pq.criadoem <= GETDATE() AND pq.codigoexterno = pro.codpro ORDER BY criadoem DESC),0) AS 'valor_subst_ant',
    ISNULL((SELECT TOP 1 valor FROM composicao_r WHERE rtipopesquisa = '23188' AND rpesquisa IN (SELECT TOP 1 OID FROM pesquisa_r WHERE codigoexterno = pro.codpro ORDER BY criadoem DESC)),0) AS 'perc_icms_compra',
    ISNULL((SELECT TOP 1 valor FROM composicao_r WHERE rtipopesquisa = '23198' AND rpesquisa IN (SELECT TOP 1 OID FROM pesquisa_r WHERE codigoexterno = pro.codpro ORDER BY criadoem DESC)),0) AS 'aliq_icms_compra',
    ISNULL((SELECT TOP 1 valor FROM composicao_r WHERE rtipopesquisa = '23160' AND rpesquisa IN (SELECT TOP 1 OID FROM pesquisa_r WHERE codigoexterno = pro.codpro ORDER BY criadoem DESC)),0) AS 'icms_sem_despesas_nao_inclusas'
FROM CHANGETABLE (CHANGES [PESQUISA], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN PESQUISA pq on pq.OID  = ct.oid
LEFT JOIN PRODUTOCAD pro on pro.codinterno = pq.CODIGOEXTERNO
WHERE criadoem = (SELECT TOP(1) ps.criadoem FROM PESQUISA ps  WHERE ps.codigoexterno = pro.codpro ORDER BY ps.criadoem DESC);
