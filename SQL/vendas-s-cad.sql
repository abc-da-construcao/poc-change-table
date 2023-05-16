SELECT
        v.numord,
        v.filial,
        v.localporta,
        v.dtven,
        v.usuven,
        CASE
            WHEN (p.referencia is not null) AND (p.referencia <> '') AND (p.referencia <> ' ')  
                THEN p.referencia
            ELSE CAST(p.numped AS VARCHAR(100))
        END AS pedido_id,
        v.numped,
        v.totven,
        v.freteorc,
        v.numfrete,
        v.dtentr,
        v.codtran,
        v.nordfrete,
        v.situacao,
        v.receber,
        v.taxanf,
        v.oiddocdeorigem,
        v.condpagposterior,
        v.PENDENTE,
        v.MANUAL,
        v.OUTRASDESPESASINCLUSAS,
        v.TOTRECANTECIPADO,
        v.TIPO,
        v.TROCO,
        v.RDOCDOACAO,
        v.VALORDOACAO
FROM CHANGETABLE (CHANGES [VENDASSCAD], :lastVersion) AS ct
JOIN VENDASSCAD v on v.numord = ct.numord
JOIN PEDICLICAD p on p.numped = v.numped
