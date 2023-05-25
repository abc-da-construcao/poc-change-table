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
        Schema::create('base_cal_fats', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('id_basecalfat');
            $table->string('codpro',5)->nullable(true);
            $table->decimal('base_cont',10,4)->nullable(true);
            $table->decimal('bas_en_cont',10,4)->nullable(true);
            $table->string('cod_mensagem', 2);
            $table->decimal('aliq_cont',6,2)->nullable(true);
            $table->decimal('aliq_n_cont',6,2)->nullable(true);
            $table->decimal('perc_subtri',15,2)->nullable(true);
            $table->string('estado_origem',2);
            $table->string('estado_destino',2);
            $table->string('base_calc_produto', 1);
            $table->string('aliquota_produto',1);
            $table->string('tpo',30);
            $table->string('cfo',4);
            $table->integer('classificacao_ cliente')->nullable(true);
            $table->string('tipo_Cliente',1);
            $table->integer('perc_base_despesas')->nullable(true);
            $table->string('cffoncont',4)->nullable(true);
            $table->string('codmensncont',2)->nullable(true);
            $table->string('cf',4)->nullable(true);
            $table->decimal('alq_cred_icms_st',6,2)->nullable(true);
            $table->decimal('alq_deb_icms_st',6,2)->nullable(true);
            $table->integer('desconsto_icms_proprio_valor_st')->nullable(true);
            $table->integer('diferencial_aliquota_st')->nullable(true);
            $table->string('filial',2)->nullable(true);
            $table->string('tipo_subst_venda',1)->nullable(true);
            $table->string('tipo_tributacao',1);
            $table->string('aliquota_estado',1)->nullable(true);
            $table->decimal('base_cred_icms_st',8,4)->nullable(true);
            $table->decimal('base_deb_icms_st',8,4)->nullable(true);
            $table->string('carga_tributaria_media',1)->nullable(true);
            $table->string('manter_base_padrao_reducao',1)->nullable(true);
            $table->string('optante_simples',1)->nullable(true);
            $table->integer('base_cheia_difal')->nullable(true);
            $table->integer('perf_cp')->nullable(true);
            $table->integer('desoneracao_icms')->nullable(true);
            $table->string('mot_des_icms',2)->nullable(true);
            $table->string('cbenef',10)->nullable(true);
            $table->integer('carga_liquida')->nullable(true);
            $table->string('codigo_ce_st',14);
            $table->string('observacao',254)->nullable(true);
            $table->string('operation')->nullable(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            //unique
            $table->unique(['id_basecalfat']);
                    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('base_cal_fats');
    }
};
