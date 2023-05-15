
SELECT
        i.numped,
        CASE
            WHEN (p.referencia is not null) AND (p.referencia <> '') AND (p.referencia <> ' ')  
                THEN p.referencia
            ELSE CAST(p.numped AS VARCHAR(100))
        END AS pedido_id,
        i.codpro,
        i.dv,
        i.quant,
        i.unid,
        i.preco,
        i.valdesc,
        i.quantent,
        i.dtprevent,
        i.filial,
        i.numord,
        i.valoripi,
        i.aliqipi,
        i.ordprod,
        i.descunit,
        i.obs,
        i.numpedfil,
        i.situacao,
        i.filialcli,
        i.tipoentr,
        i.libquant,
        i.reserva,
        i.numcarga,
        i.perdesc,
        i.pendest,
        i.libest,
        i.novquanent,
        i.qtddisplib,
        i.precostx,
        i.tpa_cod,
        i.item,
        i.faconv,
        i.preconf,
        i.precocomp,
        i.quantdisp,
        i.quantped,
        i.descrate,
        i.quantcan,
        i.pendente,
        i.itemrelacionado,
        i.rcarenciaparcela,
        i.rdocplano,
        i.rdocentrada,
        i.fator1,
        i.fator2,
        i.ITEMSERVICO,
        i.filialretirada,
        i.filialtransferencia,
        i.faturamentodireto,
        i.mostruario,
        i.PRECOCOMIS,
        i.PLANOSEMJUROS,
        i.CODVEND,
        i.NUMPEDFILIAL,
        i.valentrada,
        i.fatoraux,
        i.sitfat,
        i.numordfat,
        i.numordret,
        i.numordtransf,
        i.itemselecionado,
        i.lotenf,
        i.validadenf,
        i.FlagEmit,
        i.garantiavenda,
        i.CMIPI,
        i.QUANTSOLICITADA,
        i.PaginaOrdemSeparacao,
        i.SequenciaOrdemSeparacao,
        i.TemSeguro,
        i.entregaexped,
        i.flagoferta,
        i.ItemFat,
        i.custoreposicao,
        i.PRECOTX,
        i.PRECOUNITORIG,
        i.ID_CLIENTECENTROCUSTO,
        i.PRECOCOMICMS,
        i.VALORICMS,
        i.FLAGCOMFAIXA,
        i.PERCCOM,
        i.PERCFAIXADESC,
        i.PERCFAIXADESCONTO,
        i.RCADASTROFAIXADESCONTO,
        i.PrecoOferta,
        i.VALORIPITX
FROM CHANGETABLE (CHANGES [ItemCliCad], :lastVersion) AS ct
JOIN ITEMCLICAD i on i.item = ct.item
JOIN PEDICLICAD p on p.numped = i.numped