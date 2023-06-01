-- busca fornecedores que sofreram alterações na tabela PESSOA
SELECT
    i.OID AS 'oid',
    i.RESCOPO AS 'rescopo',
    i.NOME AS 'nome',
    p.RAZAOSOCIAL AS 'razao_social',
    p.IDENTIFICADOR AS 'identificador',
    i.CODIGO AS 'codigo',
    i.ATUALIZADOEM AS 'atualizado_em',
    i.CRIADOEM AS 'criado_em',
    i.ATUALIZADOPOR AS 'atualizado_por',
    i.CRIADOPOR AS 'criado_por',
    i.CID AS 'cid',
    i.OBSERVACAO AS 'observacao',
    i.EXCLUIDO AS 'excluido',
    ct.SYS_CHANGE_OPERATION AS 'last_operation',
    COALESCE(tc.commit_time, GETDATE())  AS 'last_commit_time'
FROM CHANGETABLE (CHANGES [PESSOA], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN PESSOA p ON p.OID = ct.OID
LEFT JOIN  ITEM i ON p.OID = i.OID
WHERE (i.EXCLUIDO = 0)
AND p.OID = i.OID
AND p.RAZAOSOCIAL != ''
AND i.OID in (select c.RITEM from CLASSIFICACAO c where c.RCATEGORIA = 2125 or c.OID = 7);

