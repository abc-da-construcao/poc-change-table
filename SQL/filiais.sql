
SELECT
        f.codempresa,
        f.filial,
        f.nome,
        f.cgc,
        f.oidempresa,
        f.oid
FROM CHANGETABLE (CHANGES [FILIALCAD], :lastVersion) AS ct
JOIN FILIALCAD f on f.oid = ct.oid