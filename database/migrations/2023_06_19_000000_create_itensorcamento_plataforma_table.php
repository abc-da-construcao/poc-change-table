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
        Schema::create('itens_orcamento', function (Blueprint $table) {
            $table->id();
            $table->string('orcamento_id', 100);
            $table->string('idOrcamentoMdm', 100)->nullable(true);
            $table->integer('status')->nullable(true);
            $table->integer('prazo')->nullable(true);
            $table->integer('cupom_id')->nullable(true);
            $table->text('motivo_perdido')->nullable(true);
            $table->float('extra', 10, 2)->nullable(true);
            $table->float('total_pedido', 18, 2)->nullable(true);
            $table->text('obs')->nullable(true);
            $table->text('info_adicionais')->nullable(true);
            $table->integer('origem_id')->nullable(true);
            $table->integer('orcamento_original')->nullable(true);
            $table->integer('area_venda_id')->nullable(true);
            $table->integer('ie_produtor_rural_id')->nullable(true);
            $table->integer('neurotech_status')->nullable(true);
            $table->integer('neurotech_user_id')->nullable(true);
            $table->dateTime('neurotech_data_acao')->nullable(true);
            $table->datetime('neurotech_data_duplicata')->nullable(true);
            $table->tinyInteger('neurotech_restricao_cadastral')->nullable(true);
            $table->tinyInteger('neurotech_restricao_externa')->nullable(true);
            $table->tinyInteger('neurotech_restricao_receita')->nullable(true);
            $table->float('neurotech_vencidos', 10, 2)->nullable(true);
            $table->float('neurotech_compras', 10, 2)->nullable(true);
            $table->float('neurotech_vencer', 10, 2)->nullable(true);
            $table->timestamp('orcamento_created_at')->nullable(true);
            $table->timestamp('orcamento_updated_at')->nullable(true);
            $table->integer('users_id')->nullable(true);
            $table->integer('cliente_id')->nullable(true);
            $table->integer('ambientes_id')->nullable(true);
            $table->string('referencia', 10)->nullable(true);
            $table->integer('produto_id')->nullable(true);
            $table->float('qtd')->nullable(true);
            $table->integer('caixa')->nullable(true);
            $table->float('de', 10, 2)->nullable(true);
            $table->float('preco', 10, 2)->nullable(true);
            $table->float('preco_desconto', 10, 2)->nullable(true);
            $table->float('desconto', 10, 2)->nullable(true);
            $table->float('total_desconto', 10, 2)->nullable(true);
            $table->float('peso_unitario', 10, 2)->nullable(true);
            $table->integer('cupomid')->nullable(true);
            $table->integer('codigo_cupom_id')->nullable(true);
            $table->integer('frete_id')->nullable(true);
            $table->string('transportadora', 45)->nullable(true);
            $table->float('frete', 10,2)->nullable(true);
            $table->string('cep', 10)->nullable(true);
            $table->string('estado', 2)->nullable(true);
            $table->string('cidade', 75)->nullable(true);
            $table->integer('produto_gratis')->nullable(true);
            $table->integer('produto_tintometrico')->nullable(true);
            $table->integer('codigo_cor_erp')->nullable(true);
            $table->integer('codigo_cor_fabricante')->nullable(true);
            $table->string('cor_codigo_leque', 50)->nullable(true);
            $table->string('cor_nome_leque', 150)->nullable(true);
            $table->date('data_prevista')->nullable(true);
            $table->integer('id_rota')->nullable(true);
            $table->string('nome_ambiente', 100)->nullable(true);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            //unique
            $table->unique(['orcamento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('itens_orcamento');
    }
};
