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
        Schema::create('itens_nota_fiscal', function (Blueprint $table) {
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

            $table->decimal("quant");
            $table->decimal("preco");
            $table->decimal("quantdev");
            $table->decimal("valdesc");
            $table->decimal("aliqipi");
            $table->decimal("aliqicms");
            $table->decimal("baseicms");
            $table->decimal("descunit");
            $table->decimal("custgeral");
            $table->decimal("valche");
            $table->decimal("perdesc");
            $table->decimal("quanped");
            $table->decimal("valsubstri");
            $table->decimal("VALIPI2");
            $table->decimal("precotab")->nullable(true);
            $table->decimal("atuaitem")->nullable(true);
            $table->decimal("atucusto")->nullable(true);
            $table->decimal("custtran")->nullable(true);
            $table->decimal("icmtran")->nullable(true);
            $table->decimal("c2moetran")->nullable(true);
            $table->decimal("cmcontab")->nullable(true);
            $table->decimal("impoger")->nullable(true);
            $table->decimal("precostx")->nullable(true);
            $table->decimal("faconv")->nullable(true);
            $table->decimal("custven")->nullable(true);
            $table->decimal("percom")->nullable(true);
            $table->decimal("substrib")->nullable(true);
            $table->decimal("valipi")->nullable(true);

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
        Schema::dropIfExists('itens_nota_fiscal');
    }
};
