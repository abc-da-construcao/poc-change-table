<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoService {

    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionProdutoControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_produto')->first();

        //ainda não tem versao na tabela de controle
        if (empty($lastVersion)) {
            $version = DB::connection('sqlsrv_ERP')->selectOne('select CHANGE_TRACKING_CURRENT_VERSION() as version');
            return $version->version;
        }
        return $lastVersion->valor;
    }


    /**
     * retorna o ultimo valor q ainda não foi executado em busca dos trackings
     */
    public static function getLastVersionProdutoComplementoControle() {
        $lastVersion = Configuracoes::where('nome', 'change_tracking_produto_complemento')->first();

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
     * atualiza o valor na tabela de controle de produtos
     */
    public static function updateLastTrackingProdutoTable($version) {

        //atualiza a ultima versao na tabela de controle
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_produto')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_produto';
        }

        $LastVersionTable->valor = $version;
        $LastVersionTable->save();
    }

     /**
     * atualiza o valor na tabela de controle
     */
    public static function updateLastTrackingProdutoComplementoTable($version) {

        //atualiza a ultima versao na tabela de controle
        $LastVersionTable = Configuracoes::where('nome', 'change_tracking_produto_complemento')->first();

        if (empty($LastVersionTable)) {
            $LastVersionTable = new Configuracoes();
            $LastVersionTable->nome = 'change_tracking_produto_complemento';
        }

        $LastVersionTable->valor = $version;
        $LastVersionTable->save();
    }

    /**
     * inserir/update os dados de produto
     */
    public static function flushProduto($dados) {

        Produto::upsert($dados, ['codpro', 'dv', 'id_fornecedor'],
                [
                    "codpro",
                    "dv",
                    "operation",
                    "referencia",
                    "nome_original",
                    "ncm",
                    "modelo",
                    "venda_minima",
                    "codpro_fabricante",
                    "un1",
                    "un2",
                    "faconv",
                    "cod_disponibilidade",
                    "disponibilidade",
                    "classe",
                    "cod_classe",
                    "n1",
                    "n2",
                    "n3",
                    "id_fornecedor",
                    "fornecedor",
                    "estado_fornecedor_origem",
                    "altura",
                    "largura",
                    "peso",
                    "comprimento",
                    "custo_atual",
                    "icms_ultima_compra",
                    "data_ult_compra",
                    "custo_ult_pesq",
                    "qtd_min_compra",
                    "ean",
                    "cf",
                    "codigo_mens",
                    "tributacao_mg",
                    "origem",
                    "ref_end"
                ]);
    }

    /**
     * inserir/update os dados de produto
     */
    public static function flushProdutoComplemento($dados) {

        Produto::upsert($dados, ['codpro', 'dv', 'id_fornecedor'],
                [
                    "codpro",
                    "dv",
                    "id_fornecedor",
                    "operation",
                    "nome_original",
                    "venda_minima",
                    "codpro_fabricante",
                    "altura",
                    "largura",
                    "comprimento"
                ]);
    }

    /**
     * busca as ultimas modificações do produto da tabela no ERP
     */
    public static function getLastChagingTrackingProduto($lastVersionProduto) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                    "SELECT
                        Pro.Codpro AS 'codpro',
                        ct.dv AS 'dv',
                        ct.SYS_CHANGE_OPERATION AS 'operation',
                        TRIM(CONCAT(Pro.codinterno, '')) AS 'referencia',
                        cmp.descricaolonga AS 'nome_original',
                        TRIM(pro.codigoncm) AS 'ncm',
                        TRIM(Pro.modelo) AS 'modelo',
                        cmp.vendaminima AS 'venda_minima',
                        CONCAT(cmp.CODPROFABRICANTE, '') AS 'codpro_fabricante',
                        Pro.unid1 AS 'un1',
                        Pro.unid2 AS 'un2',
                        Pro.faconv AS 'faconv',
                        pro.disponibilidade AS 'cod_disponibilidade',
                        (SELECT abc.nome FROM abc_disponibilidade abc WHERE abc.disponibilidade = pro.disponibilidade) AS disponibilidade,
                        SUBSTRING(pro.clasprod, 1, 6) AS 'classe',
                        SUBSTRING(pro.clasprod, 1, 6) AS 'cod_classe',
                        (SELECT pcla.descr FROM classifcad pcla WHERE substring(pro.clasprod, 1, 2) = pcla.clasprod ) AS n1,
                        (SELECT pcla.descr FROM classifcad pcla WHERE substring(pro.clasprod, 1, 4) = pcla.clasprod ) AS n2,
                        (SELECT pcla.descr FROM classifcad pcla WHERE substring(pro.clasprod, 1, 6) = pcla.clasprod ) AS n3,
                        pro.codfor AS 'id_fornecedor',
                        fnd.NOME AS 'fornecedor',
                        (SELECT TOP 1 prov.sigla FROM provincia prov, endereco_r en, cidade_r d WHERE pro.codfor = en.ritem AND en.rcidade = d.oid AND d.rprovincia = prov.oid) AS 'estado_fornecedor_origem',
                        cmp.alturacm AS 'altura',
                        cmp.larguracm AS 'largura',
                        pro.pesounit AS 'peso',
                        cmp.comprimentocm AS 'comprimento',
                        pro.precocomp AS 'custo_atual',
                        pro.icmultcomp AS 'icms_ultima_compra',
                        pro.dtultcomp AS 'data_ult_compra',
                        (ISNULL((SELECT top 1 valorcusto
                                    FROM pesquisa
                                    WHERE codigoexterno = pro.codpro
                                    ORDER BY criadoem DESC), 0)) AS 'custo_ult_pesq',
                        (SELECT qtmincompr
                            FROM itemfilest
                            WHERE filial = '10'
                            AND codpro = pro.codpro) AS 'qtd_min_compra',
                        TRIM(CONCAT((SELECT top 1 referencia
                                        FROM prodrefcad
                                        WHERE codpro = pro.codpro
                                        AND CodigoBarraEAN IS NOT NULL
                                        AND CodigoBarraEAN NOT IN ('')), '')) AS 'ean',
                        pro.cf as 'cf',
                        pro.cm AS 'codigo_mens',
                        CASE tab.usomens
                            WHEN 'A' THEN 'ST'
                            WHEN 'T' THEN 'D/C'
                            WHEN 'B' THEN 'D/C_BASE_REDUZIDA'
                            WHEN 'I' THEN 'ISENTO' ------- ISENTO -----
                        END AS 'tributacao_mg',
                        CASE
                            WHEN pro.origem IN ('N',
                                                'M',
                                                'L') THEN 'Nacional'
                            WHEN pro.origem IN ('I',
                                                'G',
                                                'H') THEN 'Importado'
                        END AS 'origem',
                        RIGHT(TRIM(pro.codinterno), 1) AS 'ref_end'
                    FROM CHANGETABLE (CHANGES [PRODUTOCAD], :lastVersion) AS ct
                    INNER JOIN produtocad pro on pro.codpro = ct.codpro and pro.dv = ct.dv
                    INNER JOIN complementoproduto CMP ON pro.codpro = cmp.codpro
                    INNER JOIN fornececad fnd ON pro.codfor = fnd.oid
                    INNER JOIN item ite ON pro.disponibilidade = ite.oid
                    LEFT JOIN tabmenscad tab ON tab.cm = pro.cm"
                    ,['lastVersion' => $lastVersionProduto]);

        return json_decode(json_encode($dados), true);
    }

    /**
     * busca as ultimas modificações de complementos do produto da tabela no ERP
     */
    public static function getLastChagingTrackingProdutoComplemento($lastVersionProdutoComplemento) {

        $dados = DB::connection('sqlsrv_ERP')->select(
                    "SELECT
                        pro.Codpro AS 'codpro',
                        pro.dv,
                        pro.codfor AS 'id_fornecedor',
                        ct.SYS_CHANGE_OPERATION AS 'operation',
                        cmp.descricaolonga AS 'nome_original',
                        cmp.vendaminima AS 'venda_minima',
                        CONCAT(cmp.CODPROFABRICANTE, '') AS 'codpro_fabricante',
                        cmp.alturacm AS 'altura',
                        cmp.larguracm AS 'largura',
                        cmp.comprimentocm AS 'comprimento'
                    FROM CHANGETABLE (CHANGES [COMPLEMENTOPRODUTO], :lastVersion) AS ct
                    INNER JOIN produtocad pro on pro.codpro = ct.codpro
                    INNER JOIN complementoproduto CMP ON pro.codpro = cmp.codpro"
                    ,['lastVersion' => $lastVersionProdutoComplemento]);

        return json_decode(json_encode($dados), true);
    }

}
