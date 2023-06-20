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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            // ------------------------------------------
            // PLATAFORMA
            // ------------TABELA PEDIDOS----------------------------------
            $table->string('plataforma_id_pedido_mdm',254)->nullable(true);
            $table->string('plataforma_id_cliente_mdm',254)->nullable(true);
            $table->integer('pd_orçamento_id')->nullable(true);
            $table->integer('plataforma_pd_pedidos_mu')->nullable(true);
            $table->decimal('plataforma_pd_total_pedido',10,2)->nullable(true);
            $table->string('idLeadMdm',150)->nullable(true);
            // ------------TABELA PAGAMENTO LOJA --------------------------
            $table->integer('plataforma_pglj_id')->nullable(true);
            $table->integer('pglj_orcamento_id')->nullable(true);
            $table->integer('plataforma_pglj_forma_id')->nullable(true);
            $table->integer('plataforma_pglj_tipo_id')->nullable(true);
            $table->integer('plataforma_pglj_parcela')->nullable(true);
            $table->integer('plataforma_pglj_entrada')->nullable(true);
            $table->string('plataforma_pglj_variavel',45)->nullable(true);
            $table->string('plataforma_pglj_tipo',45)->nullable(true);
            $table->string('plataforma_pglj_nome_tipo',45)->nullable(true);
            $table->decimal('plataforma_pglj_valor',10,2)->nullable(true);
            $table->integer('plataforma_pglj_edit_data')->nullable(true);
            $table->integer('plataforma_pglj_cartao')->nullable(true);
            $table->tinyInteger('plataforma_pglj_link_cielo')->nullable(true);
            $table->text('plataforma_pglj_image_qrcode_pix')->nullable(true);
            $table->text('plataforma_pglj_emv')->nullable(true);
            $table->string('plataforma_pglj_txid',254)->nullable(true);
            $table->string('plataforma_pglj_end_to_end_id',254)->nullable(true);
            $table->text('plataforma_pglj_link_boleto')->nullable(true);
            $table->integer('plataforma_pglj_boleto_tentativa')->nullable(true);
            $table->timestamp('plataforma_pglj_data_boleto')->nullable(true);
            $table->timestamp('plataforma_pglj_data_pagamento_boleto')->nullable(true);
            $table->timestamp('plataforma_pglj_data_pagamento_pix')->nullable(true);
            $table->string('plataforma_pglj_nsu',50)->nullable(true);
            $table->string('plataforma_pglj_tid',50)->nullable(true);
            $table->string('plataforma_pglj_item_nsu_mu',11)->nullable(true);
            $table->enum('plataforma_pglj_status', ['PENDENTE','PAGO'])->default('PENDENTE')->nullable(true);
            $table->enum('plataforma_pglj_origem', ['AUTOMATICO', 'MANUAL'])->nullable(true);
            $table->date('plataforma_pglj_data')->nullable(true);
            $table->date('plataforma_pglj_data_pix')->nullable(true);
            $table->json('plataforma_pglj_log_app_pagseguro')->nullable(true);
            $table->timestamp('plataforma_pglj_created_at')->nullable(true);
            $table->timestamp('plataforma_pglj_updated_at')->nullable(true);
            // ------------TABELA PAGAMENTO FINANCIAMENTO----------------------
            $table->integer('plataforma_pgfnc_id')->nullable(true);
            $table->integer('plataforma_pgfnc_orcamento_id')->nullable(true);
            $table->integer('plataforma_pgfnc_oid_plano')->nullable(true);
            $table->integer('plataforma_pgfnc_oid_documento')->nullable(true);
            $table->integer('plataforma_pgfnc_oid_entrada')->nullable(true);
            $table->integer('plataforma_pgfnc_parcelas')->nullable(true);
            $table->integer('plataforma_pgfnc_carencia')->nullable(true);
            $table->decimal('plataforma_pgfnc_valor',10,2)->nullable(true);
            $table->timestamp('plataforma_pgfnc_created_at')->nullable(true);
            // ------------TABELA TIPO DOCUMENTO ------------------------------
            $table->integer('plataforma_tpdoc_id')->nullable(true);
            $table->integer('plataforma_tpdoc_oid_forma_pagamento')->nullable(true);
            $table->integer('plataforma_tpdoc_oid_tipo_documento')->nullable(true);
            $table->string('plataforma_tpdoc_nome',45)->nullable(true);
            $table->integer('plataforma_tpdoc_entrada')->nullable(true);
            $table->timestamp('plataforma_tpdoc_created_at')->nullable(true);
            // ------------TABELA PEDIDOS---------------------------------------
            $table->timestamp('plataforma_pd_created_at')->nullable(true);
            $table->timestamp('plataforma_pd_updated_at')->nullable(true);
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
        Schema::dropIfExists('pagamentos');
    }
};
