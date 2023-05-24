<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->string("numnota", 13);
            $table->string("serie", 3);
            $table->string("espdoc", 3);
            $table->string("filial", 2);
            $table->string("estado", 2);
            $table->string("cfo", 4);
            $table->string("tpo", 30);
            $table->string("destaqipi", 1);
            $table->string("freteinc", 1);
            $table->string("ccusto", 5);
            $table->string("obs", 20);
            $table->string("codvend", 5);
            $table->string("codmetra", 2);
            $table->string("codtran", 3);
            $table->string("icmsipi", 1);
            $table->string("codrote", 2);
            $table->string("filtransf", 2);
            $table->string("tiponf", 2);
            $table->string("codsitest", 5);
            $table->string("codsitfed", 5);
            $table->string("cus", 1);
            $table->string("modelonf", 2);
            $table->string("est", 1);
            $table->string("codmes", 2);
            $table->string("codtran2", 3);
            $table->string("cupomini", 6);
            $table->string("cupomfim", 6);
            $table->string("clasvend", 2);
            $table->string("pedimpo", 8);
            $table->string("tiponota", 1);
            $table->string("numecf", 3);
            $table->string("numcupon", 4);
            $table->string("numnfecf", 6);
            $table->string("TipoEntr", 1);
            $table->string("codlis", 2)->nullable(true);
            $table->string("deporigem", 2)->nullable(true);
            $table->string("contredz", 6)->nullable(true);
            $table->string("codger", 5)->nullable(true);
            $table->string("Historico", 254)->nullable(true);
            $table->string("SerieECF", 20)->nullable(true);
            $table->string("ContReiOpe", 3)->nullable(true);

            $table->dateTime("dtemis")->nullable(true);
            $table->dateTime("dtcancel")->nullable(true);

            $table->double("valcontab");
            $table->double("baseicm");
            $table->double("baseicm2");
            $table->double("baseicm3");
            $table->double("alqicm");
            $table->double("alqicm2");
            $table->double("alqicm3");
            $table->double("valicm");
            $table->double("valicm2");
            $table->double("valicm3");
            $table->double("baseipi");
            $table->double("valipi");
            $table->double("valsemicm");
            $table->double("valsemipi");
            $table->double("basestrib");
            $table->double("valsubstri");
            $table->double("valtribdif");
            $table->double("valservico");
            $table->double("valiss");
            $table->double("valfrete");
            $table->double("valseguro");
            $table->double("outricm");
            $table->double("outripi");
            $table->double("valentrad");
            $table->double("desconto");
            $table->double("comissao");
            $table->double("valemba");
            $table->double("percsubst");
            $table->double("lucro");
            $table->double("baseiss");
            $table->double("peripi");
            $table->double("baseicm4");
            $table->double("alqicm4");
            $table->double("valicm4");
            $table->double("valnfche");
            $table->double("baseicm5");
            $table->double("alqicm5");
            $table->double("valicm5");
            $table->double("BaseINSS");
            $table->double("AliqINSS");
            $table->double("ValINSS");
            $table->double("AliqISSRet");
            $table->double("BaseISSRet");
            $table->double("ValISSRet");
            $table->double("ValIRRF");
            $table->double("NFFutura");
            $table->double("faturado")->nullable(true);
            $table->double("atualiz")->nullable(true);
            $table->double("flagemit")->nullable(true);
            $table->double("flagregfis")->nullable(true);
            $table->double("flagatua")->nullable(true);
            $table->double("flaginter")->nullable(true);
            $table->double("flagcontab")->nullable(true);
            $table->double("rec")->nullable(true);
            $table->double("cxa")->nullable(true);
            $table->double("flu")->nullable(true);
            $table->double("ctb")->nullable(true);
            $table->double("atf")->nullable(true);
            $table->double("integrado")->nullable(true);
            $table->double("lif")->nullable(true);
            $table->double("fat")->nullable(true);
            $table->double("exportado")->nullable(true);
            $table->double("gve")->nullable(true);
            $table->double("flagcons")->nullable(true);
            $table->double("exporta")->nullable(true);
            $table->double("impoger")->nullable(true);
            $table->double("icmsfonte")->nullable(true);
            $table->double("totmerc")->nullable(true);
            $table->double("totpeso")->nullable(true);
            $table->double("txfinan")->nullable(true);
            $table->double("exced")->nullable(true);
            $table->double("atuacum")->nullable(true);
            $table->double("jacomis")->nullable(true);
            $table->double("Contabilizado")->nullable(true);
            $table->double("gt")->nullable(true);
            $table->double("BaseIR")->nullable(true);
            $table->double("AliqIR")->nullable(true);
            $table->double("validade")->nullable(true);
            $table->double("sitproduto")->nullable(true);
            $table->double("DESPNAOINCLUSAS")->nullable(true);
            $table->double("ICMSDESPNAOINCLUSAS")->nullable(true);
            $table->double("FRETESUBSTRIBUTARIA")->nullable(true);
            $table->double("GTFim")->nullable(true);
            $table->double("ValCanECF")->nullable(true);
            $table->double("ValDescECF")->nullable(true);
            $table->double("OUTRASDESPESASINCLUSAS")->nullable(true);
            $table->double("TOTALPRECOCOMICMS")->nullable(true);
            $table->double("TOTALVALORICMS")->nullable(true);
            $table->double("DESPESASIMPORTACAO")->nullable(true);

            $table->string("pedido_id", 100);
            $table->integer("numped")->nullable(true);
            $table->integer("codnatop")->nullable(true);
            $table->integer("localporta")->nullable(true);
            $table->integer("conta")->nullable(true);
            $table->integer("oiddocdeorigem")->nullable(true);
            $table->integer("codforout")->nullable(true);
            $table->integer("tpooutraent")->nullable(true);
            $table->integer("OIDREVENDA")->nullable(true);
            $table->integer("NOrdExpedic")->nullable(true);
            $table->integer("NUMORDECF")->nullable(true);
            $table->integer("oidserialecf")->nullable(true);
            $table->integer("codclie");
            $table->integer("numord");
            $table->integer("condpag");
            $table->integer("clifim");
            $table->integer("clientea");
            $table->integer("nordven");
            $table->integer("numordfis");

            $table->unique(array('numord'));

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notas_fiscais');
    }
};