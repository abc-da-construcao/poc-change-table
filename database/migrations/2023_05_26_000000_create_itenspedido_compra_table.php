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
        Schema::create('itens_pedido_compra', function (Blueprint $table) {
            $table->id('indice');
            
            $table->string("Item", 5)->nullable(true);
            $table->integer("numped");
            
            $table->string("codpro", 5);
            $table->string("dv", 1);
            $table->string("unid", 3);
            $table->string("filial", 2);
            $table->string("referencia", 15);
            $table->string("libprobloq", 3)->nullable(true);
            $table->text("TextoTecnico")->nullable(true);

            $table->dateTime("DTPREVFAT")->nullable(true);
            $table->dateTime("dtprevrec")->nullable(true);
            $table->dateTime("dtpedido")->nullable(true);

            $table->integer("numord");
            $table->integer("ID");
            $table->integer("RSITUACAO")->nullable(true);

            $table->decimal("quant", 13, 3);
            $table->decimal("preco", 18, 5);
            $table->decimal("valoripi", 15, 2);
            $table->decimal("aliqipi", 6, 2);
            $table->decimal("quantrec", 13, 3);
            $table->decimal("valdesc", 15, 2);
            $table->decimal("txembal", 5, 2);
            $table->decimal("txsubst", 5, 2);
            $table->decimal("descunit", 18, 5);
            $table->decimal("precobas", 18, 5);
            $table->decimal("valoricms", 15, 2);
            $table->decimal("aliqicms", 6, 2);
            $table->decimal("desccomer", 6, 2);
            $table->decimal("descfinan", 6, 2);
            $table->decimal("perdesc", 6, 2);
            $table->decimal("faconv", 15, 8);
            $table->decimal("quantcan", 13, 3);

            $table->double("PrecoLista", 18, 5)->nullable(true);
            $table->double("PrecoCusto", 18, 5)->nullable(true);
            $table->double("PRECOUNITFINAL", 18, 5)->nullable(true);
            $table->double("VALSUBSTRI", 15, 5)->nullable(true);
            $table->double("VALTRIBANTECIPADA", 15, 5)->nullable(true);
            $table->double("BASEICMS", 6, 2)->nullable(true);
            $table->double("PERCICMS", 6, 2)->nullable(true);
            $table->double("PERCSUBSTRI", 6, 2)->nullable(true);
            
              $table->unique(array('item', 'numped'));

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
        Schema::dropIfExists('itens_pedido_compra');
    }
};
