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
        Schema::create('itens_nota_fiscal_saida', function (Blueprint $table) {
            $table->id('indice');

            $table->string("numnota", 13);
            $table->string("serie", 3);
            $table->string("codpro", 5);
            $table->string("dv", 1);
            $table->string("unidade", 3);
            $table->string("filial", 2);
            $table->string("cm", 2);
            $table->string("cf", 4);
            $table->string("ccusto", 5);
            $table->string("codvend", 5);
            $table->string("grupo", 2);
            $table->string("seriepro", 10);
            $table->string("ct", 3)->nullable(true);
            $table->string("codinterno", 17)->nullable(true);
            $table->string("partnum", 17)->nullable(true);
            $table->string("cfo", 4)->nullable(true);
            $table->string("ITEM", 5)->nullable(true);
            $table->string("numos", 20)->nullable(true);
            $table->string("itementrada", 5)->nullable(true);
            $table->string("itemdev", 5)->nullable(true);

            $table->integer("numord");
            $table->integer("numorddev");
            $table->integer("numordfis");
            $table->integer("ID");
            $table->integer("numordentrada")->nullable(true);
            $table->integer("RATENDEREQUISICAOVALOR")->nullable(true);
            $table->integer("ItemPEdido")->nullable(true);
            $table->integer("IDCODREDBASE")->nullable(true);

            $table->double("quant");
            $table->double("preco");
            $table->double("quantdev");
            $table->double("valdesc");
            $table->double("aliqipi");
            $table->double("aliqicms");
            $table->double("baseicms");
            $table->double("descunit");
            $table->double("custgeral");
            $table->double("valche");
            $table->double("perdesc");
            $table->double("quanped");
            $table->double("valsubstri");
            $table->double("VALIPI2");
            $table->double("precotab")->nullable(true);
            $table->double("atuaitem")->nullable(true);
            $table->double("atucusto")->nullable(true);
            $table->double("custtran")->nullable(true);
            $table->double("icmtran")->nullable(true);
            $table->double("c2moetran")->nullable(true);
            $table->double("cmcontab")->nullable(true);
            $table->double("impoger")->nullable(true);
            $table->double("precostx")->nullable(true);
            $table->double("faconv")->nullable(true);
            $table->double("custven")->nullable(true);
            $table->double("percom")->nullable(true);
            $table->double("substrib")->nullable(true);
            $table->double("valipi")->nullable(true);

            $table->dateTime("dtemis");

            $table->unique(array('numord','codpro', 'dv','ITEM'));
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
        Schema::dropIfExists('itens_nota_fiscal_saida');
    }
};
