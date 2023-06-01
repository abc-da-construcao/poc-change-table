-- busca classes de produtos que sofreram alterações na tabela CLASSIFCAD
SELECT
    cc.clasprod,
    cc.descr,
    cc.anal,
    cc.sainalista,
    cc.participacfem,
    cc.percentualcfem,
    cc.ativa,
    cc.pagacomissaoindoferta,
    cc.perccomissao,
    cc.percdescmaximogerente,
    cc.percdescmaximovendedor,
    cc.similaridade,
    cc.descrdetalhada,
    cc.prioridadeentrega,
    cc.id as 'id_erp',
    cc.atualizadoem,
    cc.codigo_gnre,
    ct.SYS_CHANGE_OPERATION AS 'last_operation',
    COALESCE(tc.commit_time, GETDATE())  AS 'last_commit_time'
FROM CHANGETABLE (CHANGES [CLASSIFCAD], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN CLASSIFCAD cc on cc.clasprod = ct.clasprod
LEFT JOIN PRODUTOCAD pro on pro.clasprod = cc.clasprod;


