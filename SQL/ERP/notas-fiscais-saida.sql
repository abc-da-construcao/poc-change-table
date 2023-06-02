SELECT
    nf.numnota,
    nf.serie,
    nf.codclie,
    nf.dtemis,
    nf.espdoc,
    nf.filial,
    nf.estado,
    nf.cfo,
    nf.tpo,
    nf.valcontab,
    nf.baseicm,
    nf.baseicm2,
    nf.baseicm3,
    nf.alqicm,
    nf.alqicm2,
    nf.alqicm3,
    nf.valicm,
    nf.valicm2,
    nf.valicm3,
    nf.baseipi,
    nf.valipi,
    nf.valsemicm,
    nf.valsemipi,
    nf.basestrib,
    nf.valsubstri,
    nf.valtribdif,
    nf.destaqipi,
    nf.valservico,
    nf.valiss,
    nf.valfrete,
    nf.valseguro,
    nf.freteinc,
    nf.outricm,
    nf.outripi,
    nf.ccusto,
    nf.obs,
    nf.codvend,
    CASE
        WHEN (p.referencia is not null) AND (p.referencia <> '') AND (p.referencia <> ' ')  
            THEN p.referencia
        ELSE CAST(p.numped AS VARCHAR(100))
    END AS pedido_id,
    nf.numped,
    nf.valentrad,
    nf.codmetra,
    nf.codtran,
    nf.desconto,
    nf.comissao,
    ct.numord,
    nf.faturado,
    nf.atualiz,
    nf.flagemit,
    nf.flagregfis,
    nf.flagatua,
    nf.icmsipi,
    nf.valemba,
    nf.codrote,
    nf.codnatop,
    nf.filtransf,
    nf.tiponf,
    nf.flaginter,
    nf.flagcontab,
    nf.codsitest,
    nf.codsitfed,
    nf.percsubst,
    nf.lucro,
    nf.rec,
    nf.cxa,
    nf.flu,
    nf.ctb,
    nf.atf,
    nf.cus,
    nf.integrado,
    nf.dtcancel,
    nf.baseiss,
    nf.modelonf,
    nf.condpag,
    nf.est,
    nf.lif,
    nf.fat,
    nf.exportado,
    nf.codmes,
    nf.peripi,
    nf.localporta,
    nf.conta,
    nf.codtran2,
    nf.cupomini,
    nf.cupomfim,
    nf.gve,
    nf.baseicm4,
    nf.alqicm4,
    nf.valicm4,
    nf.clasvend,
    nf.flagcons,
    nf.clifim,
    nf.exporta,
    nf.pedimpo,
    nf.tiponota,
    nf.numecf,
    nf.numcupon,
    nf.valnfche,
    nf.clientea,
    nf.nordven,
    nf.numnfecf,
    nf.baseicm5,
    nf.alqicm5,
    nf.valicm5,
    nf.numordfis,
    nf.impoger,
    nf.icmsfonte,
    nf.totmerc,
    nf.totpeso,
    nf.txfinan,
    nf.exced,
    nf.codlis,
    nf.oiddocdeorigem,
    nf.atuacum,
    nf.jacomis,
    nf.Contabilizado,
    nf.codforout,
    nf.deporigem,
    nf.tpooutraent,
    nf.contredz,
    nf.gt,
    nf.BaseIR,
    nf.AliqIR,
    nf.codger,
    nf.OIDREVENDA,
    nf.Historico,
    nf.BaseINSS,
    nf.AliqINSS,
    nf.ValINSS,
    nf.AliqISSRet,
    nf.BaseISSRet,
    nf.ValISSRet,
    nf.ValIRRF,
    nf.NFFutura,
    nf.NOrdExpedic,
    nf.validade,
    nf.sitproduto,
    nf.DESPNAOINCLUSAS,
    nf.ICMSDESPNAOINCLUSAS,
    nf.FRETESUBSTRIBUTARIA,
    nf.SerieECF,
    nf.GTFim,
    nf.ValCanECF,
    nf.ValDescECF,
    nf.ContReiOpe,
    nf.OUTRASDESPESASINCLUSAS,
    nf.TipoEntr,
    nf.NUMORDECF,
    nf.TOTALPRECOCOMICMS,
    nf.TOTALVALORICMS,
    nf.DESPESASIMPORTACAO,
    nf.oidserialecf,
    ct.SYS_CHANGE_OPERATION AS 'last_operation',
    COALESCE(tc.commit_time, GETDATE()) AS 'last_commit_time'
FROM CHANGETABLE (CHANGES [NFSAIDACAD], :lastVersion) AS ct
LEFT JOIN sys.dm_tran_commit_table tc on ct.sys_change_version = tc.commit_ts
LEFT JOIN NFSAIDACAD nf on nf.numord = ct.numord
LEFT JOIN PEDICLICAD p on p.numped = nf.numped