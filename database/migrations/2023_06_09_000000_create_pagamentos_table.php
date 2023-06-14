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
        Schema::create('plataforma_pagamentos', function (Blueprint $table) {
            $table->id();
            // ------------------------------------------
            // PLATAFORMA
            // ------------TABELA PEDIDOS----------------------------------
            $table->string('id_pedido_mdm',254)->nullable(true);
            $table->string('id_cliente_mdm',254)->nullable(true);
            $table->integer('pd_orçamento_id')->nullable(true);
            $table->integer('pd_pedidos_mu')->nullable(true);
            $table->decimal('pd_total_pedido',10,2)->nullable(true);
            // ------------TABELA PAGAMENTO LOJA --------------------------
            $table->integer('pglj_id')->nullable(true);
            $table->integer('pglj_orcamento_id')->nullable(true);
            $table->integer('pglj_forma_id')->nullable(true);
            $table->integer('pglj_tipo_id')->nullable(true);
            $table->integer('pglj_parcela')->nullable(true);
            $table->integer('pglj_entrada')->nullable(true);
            $table->string('pglj_variavel',45)->nullable(true);
            $table->string('pglj_tipo',45)->nullable(true);
            $table->string('pglj_nome_tipo',45)->nullable(true);
            $table->decimal('pglj_valor',10,2)->nullable(true);
            $table->integer('pglj_edit_data')->nullable(true);
            $table->integer('pglj_cartao')->nullable(true);
            $table->tinyInteger('pglj_link_cielo')->nullable(true);
            $table->text('pglj_image_qrcode_pix')->nullable(true);
            $table->text('pglj_emv')->nullable(true);
            $table->string('pglj_txid',254)->nullable(true);
            $table->string('pglj_end_to_end_id',254)->nullable(true);
            $table->text('pglj_link_boleto')->nullable(true);
            $table->integer('pglj_boleto_tentativa')->nullable(true);
            $table->timestamp('pglj_data_boleto')->nullable(true);
            $table->timestamp('pglj_data_pagamento_boleto')->nullable(true);
            $table->timestamp('pglj_data_pagamento_pix')->nullable(true);
            $table->string('pglj_nsu',50)->nullable(true);
            $table->string('pglj_tid',50)->nullable(true);
            $table->string('pglj_item_nsu_mu',11)->nullable(true);
            $table->enum('pglj_status', ['PENDENTE','PAGO'])->default('PENDENTE')->nullable(true);
            $table->enum('pglj_origem', ['AUTOMATICO', 'MANUAL'])->nullable(true);
            $table->date('pglj_data')->nullable(true);
            $table->date('pglj_data_pix')->nullable(true);
            $table->json('pglj_log_app_pagseguro')->nullable(true);
            $table->timestamp('pglj_created_at')->nullable(true);
            $table->timestamp('pglj_updated_at')->nullable(true);
            // ------------TABELA PAGAMENTO FINANCIAMENTO----------------------
            $table->integer('pgfnc_id')->nullable(true);
            $table->integer('pgfnc_orcamento_id')->nullable(true);
            $table->integer('pgfnc_oid_plano')->nullable(true);
            $table->integer('pgfnc_oid_documento')->nullable(true);
            $table->integer('pgfnc_oid_entrada')->nullable(true);
            $table->integer('pgfnc_parcelas')->nullable(true);
            $table->integer('pgfnc_carencia')->nullable(true);
            $table->decimal('pgfnc_valor',10,2)->nullable(true);
            $table->timestamp('pgfnc_created_at')->nullable(true);
            // ------------TABELA TIPO DOCUMENTO ------------------------------
            $table->integer('tpdoc_id')->nullable(true);
            $table->integer('tpdoc_oid_forma_pagamento')->nullable(true);
            $table->integer('tpdoc_oid_tipo_documento')->nullable(true);
            $table->string('tpdoc_nome',45)->nullable(true);
            $table->integer('tpdoc_entrada')->nullable(true);
            $table->timestamp('tpdoc_created_at')->nullable(true);
            // ------------TABELA PEDIDOS---------------------------------------
            $table->timestamp('pd_created_at')->nullable(true);
            $table->timestamp('pd_updated_at')->nullable(true);
            //----------------DEFAULT ------------------------------------------
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            //unique
            $table->unique(['pd_orçamento_id', 'pglj_orcamento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('plataforma_pagamentos');
    }
};
