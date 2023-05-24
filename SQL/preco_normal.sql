SELECT
    trim(p.codinterno)       AS 'referencia',
    CONCAT(p.precoven,'')    AS 'de',
    f.filial     AS 'filial' ,
    f.NOME as 'filial_nome',
    av.DESCR AS 'desc_area_venda',
    p.areavend AS 'area_venda'
FROM CHANGETABLE (CHANGES [areaprecad], :lastVersion) AS ct
INNER JOIN areaprecad p on p.areavend = ct.areavend and p.codpro = ct.codpro
INNER JOIN ADITIVO a on a.nvalor = p.areavend
INNER JOIN DADOADICIONAL_V d  ON d.OID = a.RDEFINICAO  
INNER JOIN FILIALCAD f on f.OID = a.RITEM
INNER JOIN areavencad av ON p.areavend = av.areavend
WHERE d.oid = '29661' -- Dado adicional Área de Vendas atendida pela Filial