-- busca complemento do produto que sofreram alterações na tabela COMPLEMENTOPRODUTO
SELECT
    ct.Codpro AS 'codpro',
    pro.dv,
    pro.codfor AS 'id_fornecedor',
    ct.SYS_CHANGE_OPERATION AS 'last_operation',
    COALESCE(tc.commit_time, GETDATE())  AS 'last_commit_time',
    cmp.descricaolonga AS 'nome_original',
    cmp.vendaminima AS 'venda_minima',
    CONCAT(cmp.CODPROFABRICANTE, '') AS 'codpro_fabricante',
    cmp.alturacm AS 'altura',
    cmp.larguracm AS 'largura',
    cmp.comprimentocm AS 'comprimento'
FROM CHANGETABLE (CHANGES [COMPLEMENTOPRODUTO], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN produtocad pro on pro.codpro = ct.codpro
LEFT JOIN complementoproduto cmp ON pro.codpro = cmp.codpro;
