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
            $table->integer("numero_pedido");
            $table->string("codpro", 5);
            
            $table->string("dv", 1)->nullable(true);
            $table->string("unid", 3)->nullable(true);
            $table->string("filial", 2)->nullable(true);
            $table->string("referencia", 15)->nullable(true);
            $table->string("libprobloq", 3)->nullable(true);
            $table->text("TextoTecnico")->nullable(true);

            $table->dateTime("DTPREVFAT")->nullable(true);
            $table->dateTime("data_previsao_recebimento")->nullable(true);
            $table->dateTime("dtpedido")->nullable(true);

            $table->integer("numord")->nullable(true);
            $table->integer("ID")->nullable(true);
            $table->integer("RSITUACAO")->nullable(true);

            $table->decimal("quantidade", 13, 3)->nullable(true);
            $table->decimal("preco", 18, 5)->nullable(true);
            $table->decimal("valoripi", 15, 2)->nullable(true);
            $table->decimal("aliqipi", 6, 2)->nullable(true);
            $table->decimal("quantidade_recebida", 13, 3)->nullable(true);
            $table->decimal("valdesc", 15, 2)->nullable(true);
            $table->decimal("txembal", 5, 2)->nullable(true);
            $table->decimal("txsubst", 5, 2)->nullable(true);
            $table->decimal("descunit", 18, 5)->nullable(true);
            $table->decimal("precobas", 18, 5)->nullable(true);
            $table->decimal("valoricms", 15, 2)->nullable(true);
            $table->decimal("aliqicms", 6, 2)->nullable(true);
            $table->decimal("desccomer", 6, 2)->nullable(true);
            $table->decimal("descfinan", 6, 2)->nullable(true);
            $table->decimal("perdesc", 6, 2)->nullable(true);
            $table->decimal("faconv", 15, 8)->nullable(true);
            $table->decimal("quantcan", 13, 3)->nullable(true);

            $table->double("PrecoLista", 18, 5)->nullable(true);
            $table->double("PrecoCusto", 18, 5)->nullable(true);
            $table->double("PRECOUNITFINAL", 18, 5)->nullable(true);
            $table->double("VALSUBSTRI", 15, 5)->nullable(true);
            $table->double("VALTRIBANTECIPADA", 15, 5)->nullable(true);
            $table->double("BASEICMS", 6, 2)->nullable(true);
            $table->double("PERCICMS", 6, 2)->nullable(true);
            $table->double("PERCSUBSTRI", 6, 2)->nullable(true);
            $table->string("descr", 35)->nullable(true);
            $table->integer("codfor")->nullable(true);
            $table->string("FORNECEDOR", 254)->nullable(true);
            $table->string("DOCUMENTO", 20)->nullable(true);
            
            $table->string('last_operation', 1);
            $table->dateTime('last_commit_time');
            
              $table->unique(array('Item', 'numero_pedido', 'codpro'));

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
