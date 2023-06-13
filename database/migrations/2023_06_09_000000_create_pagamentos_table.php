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
        Schema::create('filiais', function (Blueprint $table) {
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
            $table->integer('pglj_link_cielo')->nullable(true);
            $table->string('pglj_image_qrcode_pix')->nullable(true);
            $table->string('pglj_emv')->nullable(true);
            $table->string('pglj_txid')->nullable(true);
            $table->string('pglj_end_to_end_id')->nullable(true);
            $table->string('pglj_link_boleto')->nullable(true);
            $table->string('pglj_boleto_tentativa')->nullable(true);
            $table->string('pglj_data_boleto')->nullable(true);
            $table->string('pglj_data_pagamento_boleto')->nullable(true);
            $table->string('pglj_data_pagamento_pix')->nullable(true);
            $table->string('pglj_nsu')->nullable(true);
            $table->string('pglj_tid')->nullable(true);
            $table->string('pglj_item_nsu_mu')->nullable(true);
            $table->string('pglj_status')->nullable(true);
            $table->string('pglj_origem')->nullable(true);
            $table->string('pglj_data')->nullable(true);
            $table->string('pglj_data_pix')->nullable(true);
            $table->string('pglj_log_app_pagseguro')->nullable(true);
            $table->timestamp('pglj_created_at')->nullable(true);
            $table->timestamp('pglj_updated_at')->nullable(true);
            // ------------TABELA PAGAMENTO FINANCIAMENTO----------------------
            $table->string('pgfnc_id')->nullable(true);
            $table->string('pgfnc_orcamento_id')->nullable(true);
            $table->string('pgfnc_oid_plano')->nullable(true);
            $table->string('pgfnc_oid_documento')->nullable(true);
            $table->string('pgfnc_oid_entrada')->nullable(true);
            $table->string('pgfnc_parcelas')->nullable(true);
            $table->string('pgfnc_carencia')->nullable(true);
            $table->string('pgfnc_valor')->nullable(true);
            $table->timestamp('pgfnc_created_at')->nullable(true);
            // ------------TABELA TIPO DOCUMENTO -------------------------------
            $table->string('tpdoc_id')->nullable(true);
            $table->string('tpdoc_oid_forma_pagamento')->nullable(true);
            $table->string('tpdoc_oid_tipo_documento')->nullable(true);
            $table->string('tpdoc_nome')->nullable(true);
            $table->string('tpdoc_entrada')->nullable(true);
            $table->timestamp('tpdoc_created_at')->nullable(true);
            $table->timestamp('pd_created_at')->nullable(true);
            $table->timestamp('pd_updated_at')->nullable(true);
            //------------------------------------------------------------------
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
        Schema::dropIfExists('filiais');
    }
};
