SELECT 
    pro.codpro,
    pro.dv,
    TRIM(pro.codinterno) AS 'referencia',
    ISNULL((SUM(i.quant) - SUM(i.quantrec)), 0) as 'estoque_futuro',
    i.filial, 
    ISNULL((SELECT (SUM(ifc.quant) - SUM(ifc.quantrec)) FROM itemforcad ifc  WHERE ifc.codpro=pro.codpro AND ifc.filial = i.filial AND ifc.quantrec <> ifc.quant AND ifc.dtprevrec BETWEEN GETDATE() AND GETDATE() + 15 GROUP BY ifc.codpro, ifc.filial), 0) as 'compras_1', 
    ISNULL((SELECT (SUM(ifc.quant) - SUM(ifc.quantrec)) FROM itemforcad ifc  WHERE ifc.codpro=pro.codpro AND ifc.filial = i.filial AND ifc.quantrec <> ifc.quant AND ifc.dtprevrec BETWEEN GETDATE() + 16 AND GETDATE() + 45 GROUP BY ifc.codpro, ifc.filial), 0) as 'compras_2'
FROM
    CHANGETABLE (CHANGES [itemforcad], :lastVersion) AS ct
    INNER JOIN produtocad pro ON pro.codpro = ct.codpro
    LEFT JOIN itemforcad i ON i.codpro = ct.codpro
    WHERE i.quantrec <> i.quant
    GROUP BY pro.codpro,
             pro.dv,
             pro.codinterno,
             i.filial
