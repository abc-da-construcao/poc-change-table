SELECT 
    pro.codpro,
    pro.dv,
    TRIM(pro.codinterno) AS 'referencia',
    (SUM(i.quant) - SUM(i.quantrec)) as 'estoque_futuro',
    i.filial 
FROM
    CHANGETABLE (CHANGES [itemforcad], :lastVersion) AS ct
INNER JOIN itemforcad i ON i.codpro = ct.codpro AND i.numped = ct.numped
INNER JOIN produtocad pro ON pro.codpro = ct.codpro AND pro.dv = i.dv
WHERE i.quantrec <> i.quant
GROUP BY pro.codpro,
    pro.dv,
    pro.codinterno,
    i.filial
