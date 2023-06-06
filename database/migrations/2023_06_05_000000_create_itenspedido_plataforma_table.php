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
        Schema::create('itens_pedido_venda_plataforma', function (Blueprint $table) {
            $table->id();
            $table->integer('idItemPedidoPvMdm');
            $table->string('idPedidoMdm', 30)->nullable(true);
            $table->string('codpro', 10)->nullable(true);
            $table->string('referencia', 10)->nullable(true);
            $table->string('codigoClasse', 10)->nullable(true);
            $table->integer('pedidos_id')->nullable(true);
            $table->integer('pedido_id')->nullable(true);
            $table->integer('produtoid')->nullable(true);
            $table->integer('orcamento_id')->nullable(true);
            $table->integer('ambientes_id')->nullable(true);
            $table->string('referencia_item', 10)->nullable(true);
            $table->double('qtd')->nullable(true);
            $table->integer('caixa')->nullable(true);
            $table->string('quebras', 1)->nullable(true);
            $table->decimal('preco', 10, 2)->nullable(true);
            $table->decimal('total_desconto', 10, 2)->nullable(true);
            $table->decimal('preco_unitario', 10, 2)->nullable(true);
            $table->decimal('de', 10, 2)->nullable(true);
            $table->decimal('por', 10, 2)->nullable(true);
            $table->decimal('preco_desconto', 10, 2)->nullable(true);
            $table->decimal('desconto', 10,2)->nullable(true);
            $table->integer('codigo_cor_erp')->nullable(true);
            $table->integer('codigo_cor_fabricante')->nullable(true);
            $table->string('cor_codigo_leque', 50)->nullable(true);
            $table->string('cor_nome_leque', 150)->nullable(true);
            $table->date('data_prevista')->nullable(true);
            $table->integer('id_rota')->nullable(true);
            $table->integer('ambiente_id')->nullable(true);
            $table->string('ambiente_nome', 100)->nullable(true);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            //unique
            $table->unique(['idItemPedidoPvMdm']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('itens_pedido_venda_plataforma');
    }
};
