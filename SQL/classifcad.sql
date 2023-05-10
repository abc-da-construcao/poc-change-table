-- busca classes de produtos que sofreram alterações na tabela CLASSIFCAD
SELECT
	cc.id,
	cc.clasprod,
	cc.descr,
	CASE cc.PAGACOMISSAOINDOFERTA
		WHEN 1 THEN 1
	ELSE 0
	END AS 'PAGACOMISSAOINDOFERTA',
	cc.SIMILARIDADE, 
	CASE cc.ATIVA
		WHEN 1 THEN 1
	ELSE 0
	END AS 'IsActive',
	ct.SYS_CHANGE_OPERATION AS 'operation'
FROM CHANGETABLE (CHANGES [CLASSIFCAD], :lastVersion) AS ct
INNER JOIN CLASSIFCAD cc on cc.clasprod = ct.clasprod
INNER JOIN PRODUTOCAD pro on pro.clasprod = cc.clasprod;


