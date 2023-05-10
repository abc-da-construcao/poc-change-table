<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\NotasFiscais;
use Illuminate\Support\Facades\DB;

class NotaFiscaisService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_notas_fiscais')->first();

        //ainda não tem versao na tabela de controle
        if (empty($lastVersion)) {
            $version = DB::connection('sqlsrv_ERP')->selectOne('select CHANGE_TRACKING_CURRENT_VERSION() as version');
            return $version->version;
        }

        return $lastVersion->valor;
    }

    /**
     * retorna o ultimo tracking para a proximo controle interno da execuçao
     */
    public static function getLastVersionTrackingTable() {

        $version = DB::connection('sqlsrv_ERP')->selectOne('select CHANGE_TRACKING_CURRENT_VERSION() as version');
        return $version->version;
    }

    /**
     * atualiza o valor na tabela de controle
     */
    public static function updateLastTrackingTable($version) {

        //atualiza a ultima versao na tabela de controle
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_notas_fiscais')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_notas_fiscais';
        }

        $LastVersionTable->valor = $version;
        $LastVersionTable->save();
    }

    /**
     * busca as ultimas modificações da tabela no ERP
     */
    public static function getLastChagingTrackingERP($lastVersion) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                'SELECT
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
                    nf.numped,
                    nf.valentrad,
                    nf.codmetra,
                    nf.codtran,
                    nf.desconto,
                    nf.comissao,
                    nf.numord,
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
                    nf.oidserialecf
           FROM CHANGETABLE (CHANGES [NFSAIDACAD], :lastVersion) AS ct
        join NFSAIDACAD nf on nf.numord = ct.numord', ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados de pediclicad
     */
    public static function flushItensPedidos($dados) {

        NotasFiscais::upsert($dados, ['numord'],
                [
                    "numnota",
                    "serie",
                    "codclie",
                    "dtemis",
                    "espdoc",
                    "filial",
                    "estado",
                    "cfo",
                    "tpo",
                    "valcontab",
                    "baseicm",
                    "baseicm2",
                    "baseicm3",
                    "alqicm",
                    "alqicm2",
                    "alqicm3",
                    "valicm",
                    "valicm2",
                    "valicm3",
                    "baseipi",
                    "valipi",
                    "valsemicm",
                    "valsemipi",
                    "basestrib",
                    "valsubstri",
                    "valtribdif",
                    "destaqipi",
                    "valservico",
                    "valiss",
                    "valfrete",
                    "valseguro",
                    "freteinc",
                    "outricm",
                    "outripi",
                    "ccusto",
                    "obs",
                    "codvend",
                    "numped",
                    "valentrad",
                    "codmetra",
                    "codtran",
                    "desconto",
                    "comissao",
                    "numord",
                    "faturado",
                    "atualiz",
                    "flagemit",
                    "flagregfis",
                    "flagatua",
                    "icmsipi",
                    "valemba",
                    "codrote",
                    "codnatop",
                    "filtransf",
                    "tiponf",
                    "flaginter",
                    "flagcontab",
                    "codsitest",
                    "codsitfed",
                    "percsubst",
                    "lucro",
                    "rec",
                    "cxa",
                    "flu",
                    "ctb",
                    "atf",
                    "cus",
                    "integrado",
                    "dtcancel",
                    "baseiss",
                    "modelonf",
                    "condpag",
                    "est",
                    "lif",
                    "fat",
                    "exportado",
                    "codmes",
                    "peripi",
                    "localporta",
                    "conta",
                    "codtran2",
                    "cupomini",
                    "cupomfim",
                    "gve",
                    "baseicm4",
                    "alqicm4",
                    "valicm4",
                    "clasvend",
                    "flagcons",
                    "clifim",
                    "exporta",
                    "pedimpo",
                    "tiponota",
                    "numecf",
                    "numcupon",
                    "valnfche",
                    "clientea",
                    "nordven",
                    "numnfecf",
                    "baseicm5",
                    "alqicm5",
                    "valicm5",
                    "numordfis",
                    "impoger",
                    "icmsfonte",
                    "totmerc",
                    "totpeso",
                    "txfinan",
                    "exced",
                    "codlis",
                    "oiddocdeorigem",
                    "atuacum",
                    "jacomis",
                    "Contabilizado",
                    "codforout",
                    "deporigem",
                    "tpooutraent",
                    "contredz",
                    "gt",
                    "BaseIR",
                    "AliqIR",
                    "codger",
                    "OIDREVENDA",
                    "Historico",
                    "BaseINSS",
                    "AliqINSS",
                    "ValINSS",
                    "AliqISSRet",
                    "BaseISSRet",
                    "ValISSRet",
                    "ValIRRF",
                    "NFFutura",
                    "NOrdExpedic",
                    "validade",
                    "sitproduto",
                    "DESPNAOINCLUSAS",
                    "ICMSDESPNAOINCLUSAS",
                    "FRETESUBSTRIBUTARIA",
                    "SerieECF",
                    "GTFim",
                    "ValCanECF",
                    "ValDescECF",
                    "ContReiOpe",
                    "OUTRASDESPESASINCLUSAS",
                    "TipoEntr",
                    "NUMORDECF",
                    "TOTALPRECOCOMICMS",
                    "TOTALVALORICMS",
                    "DESPESASIMPORTACAO",
                    "oidserialecf",
        ]);
    }

}
