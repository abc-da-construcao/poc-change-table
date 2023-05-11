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

            $table->decimal("valcontab");
            $table->decimal("baseicm");
            $table->decimal("baseicm2");
            $table->decimal("baseicm3");
            $table->decimal("alqicm");
            $table->decimal("alqicm2");
            $table->decimal("alqicm3");
            $table->decimal("valicm");
            $table->decimal("valicm2");
            $table->decimal("valicm3");
            $table->decimal("baseipi");
            $table->decimal("valipi");
            $table->decimal("valsemicm");
            $table->decimal("valsemipi");
            $table->decimal("basestrib");
            $table->decimal("valsubstri");
            $table->decimal("valtribdif");
            $table->decimal("valservico");
            $table->decimal("valiss");
            $table->decimal("valfrete");
            $table->decimal("valseguro");
            $table->decimal("outricm");
            $table->decimal("outripi");
            $table->decimal("valentrad");
            $table->decimal("desconto");
            $table->decimal("comissao");
            $table->decimal("valemba");
            $table->decimal("percsubst");
            $table->decimal("lucro");
            $table->decimal("baseiss");
            $table->decimal("peripi");
            $table->decimal("baseicm4");
            $table->decimal("alqicm4");
            $table->decimal("valicm4");
            $table->decimal("valnfche");
            $table->decimal("baseicm5");
            $table->decimal("alqicm5");
            $table->decimal("valicm5");
            $table->decimal("BaseINSS");
            $table->decimal("AliqINSS");
            $table->decimal("ValINSS");
            $table->decimal("AliqISSRet");
            $table->decimal("BaseISSRet");
            $table->decimal("ValISSRet");
            $table->decimal("ValIRRF");
            $table->decimal("NFFutura");
            $table->decimal("faturado")->nullable(true);
            $table->decimal("atualiz")->nullable(true);
            $table->decimal("flagemit")->nullable(true);
            $table->decimal("flagregfis")->nullable(true);
            $table->decimal("flagatua")->nullable(true);
            $table->decimal("flaginter")->nullable(true);
            $table->decimal("flagcontab")->nullable(true);
            $table->decimal("rec")->nullable(true);
            $table->decimal("cxa")->nullable(true);
            $table->decimal("flu")->nullable(true);
            $table->decimal("ctb")->nullable(true);
            $table->decimal("atf")->nullable(true);
            $table->decimal("integrado")->nullable(true);
            $table->decimal("lif")->nullable(true);
            $table->decimal("fat")->nullable(true);
            $table->decimal("exportado")->nullable(true);
            $table->decimal("gve")->nullable(true);
            $table->decimal("flagcons")->nullable(true);
            $table->decimal("exporta")->nullable(true);
            $table->decimal("impoger")->nullable(true);
            $table->decimal("icmsfonte")->nullable(true);
            $table->decimal("totmerc")->nullable(true);
            $table->decimal("totpeso")->nullable(true);
            $table->decimal("txfinan")->nullable(true);
            $table->decimal("exced")->nullable(true);
            $table->decimal("atuacum")->nullable(true);
            $table->decimal("jacomis")->nullable(true);
            $table->decimal("Contabilizado")->nullable(true);
            $table->decimal("gt")->nullable(true);
            $table->decimal("BaseIR")->nullable(true);
            $table->decimal("AliqIR")->nullable(true);
            $table->decimal("validade")->nullable(true);
            $table->decimal("sitproduto")->nullable(true);
            $table->decimal("DESPNAOINCLUSAS")->nullable(true);
            $table->decimal("ICMSDESPNAOINCLUSAS")->nullable(true);
            $table->decimal("FRETESUBSTRIBUTARIA")->nullable(true);
            $table->decimal("GTFim")->nullable(true);
            $table->decimal("ValCanECF")->nullable(true);
            $table->decimal("ValDescECF")->nullable(true);
            $table->decimal("OUTRASDESPESASINCLUSAS")->nullable(true);
            $table->decimal("TOTALPRECOCOMICMS")->nullable(true);
            $table->decimal("TOTALVALORICMS")->nullable(true);
            $table->decimal("DESPESASIMPORTACAO")->nullable(true);

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

            $table->timestamps();
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