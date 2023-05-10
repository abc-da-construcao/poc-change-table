<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\ItensPedido;
use Illuminate\Support\Facades\DB;

class ItensPedidoService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_itens_pedido')->first();

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
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_itens_pedido')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_itens_pedido';
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
                    i.numped,
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
           JOIN ITEMCLICAD i on i.item = ct.item', ['lastVersion' => $lastVersion]);
        return json_decode(json_encode($dados), true);
    }

    /**
     * inserir/update os dados de pediclicad
     */
    public static function flushItensPedidos($dados) {

        ItensPedido::upsert($dados, ['item', 'numped'],
                [
                    "numped",
                    "codpro",
                    "dv",
                    "quant",
                    "unid",
                    "preco",
                    "valdesc",
                    "quantent",
                    "dtprevent",
                    "filial",
                    "numord",
                    "valoripi",
                    "aliqipi",
                    "ordprod",
                    "descunit",
                    "obs",
                    "numpedfil",
                    "situacao",
                    "filialcli",
                    "tipoentr",
                    "libquant",
                    "reserva",
                    "numcarga",
                    "perdesc",
                    "pendest",
                    "libest",
                    "novquanent",
                    "qtddisplib",
                    "precostx",
                    "tpa_cod",
                    "item",
                    "faconv",
                    "preconf",
                    "precocomp",
                    "quantdisp",
                    "quantped",
                    "descrate",
                    "quantcan",
                    "pendente",
                    "itemrelacionado",
                    "rcarenciaparcela",
                    "rdocplano",
                    "rdocentrada",
                    "fator1",
                    "fator2",
                    "ITEMSERVICO",
                    "filialretirada",
                    "filialtransferencia",
                    "faturamentodireto",
                    "mostruario",
                    "PRECOCOMIS",
                    "PLANOSEMJUROS",
                    "CODVEND",
                    "NUMPEDFILIAL",
                    "valentrada",
                    "fatoraux",
                    "sitfat",
                    "numordfat",
                    "numordret",
                    "numordtransf",
                    "itemselecionado",
                    "lotenf",
                    "validadenf",
                    "FlagEmit",
                    "garantiavenda",
                    "CMIPI",
                    "QUANTSOLICITADA",
                    "PaginaOrdemSeparacao",
                    "SequenciaOrdemSeparacao",
                    "TemSeguro",
                    "entregaexped",
                    "flagoferta",
                    "ItemFat",
                    "custoreposicao",
                    "PRECOTX",
                    "PRECOUNITORIG",
                    "ID_CLIENTECENTROCUSTO",
                    "PRECOCOMICMS",
                    "VALORICMS",
                    "FLAGCOMFAIXA",
                    "PERCCOM",
                    "PERCFAIXADESC",
                    "PERCFAIXADESCONTO",
                    "RCADASTROFAIXADESCONTO",
                    "PrecoOferta",
                    "VALORIPITX",
        ]);
    }

}