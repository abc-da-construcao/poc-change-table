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
        Schema::create('produtos', function (Blueprint $table) {
                        $table->id()->unique();
                        //------------------------------------------------------------------
                        //ERP: PRODUTOS/COMPLEMENTO PRODUTOS/CLASSE
                        //------------------------------------------------------------------
                        $table->integer('codpro')->nullable(true);
                        $table->string('dv')->nullable(true);
                        $table->integer('id_fornecedor')->nullable(true);
                        $table->string('referencia', 17)->nullable(true);
                        $table->string('nome_original', 100)->nullable(true);
                        $table->string('ncm', 14)->nullable(true);
                        $table->string('modelo', 254)->nullable(true);
                        $table->integer('venda_minima')->nullable(true);
                        $table->string('codpro_fabricante', 25)->nullable(true);
                        $table->string('un1', 3)->nullable(true);
                        $table->string('un2', 3)->nullable(true);
                        $table->decimal("faconv",15,8)->nullable(true);
                        $table->integer('cod_disponibilidade')->nullable(true);
                        $table->string('disponibilidade', 254)->nullable(true);
                        $table->string('classe', 14)->nullable(true);
                        $table->string('cod_classe', 14)->nullable(true);
                        $table->string('n1', 25)->nullable(true);
                        $table->string('n2', 25)->nullable(true);
                        $table->string('n3', 25)->nullable(true);
                        $table->string('fornecedor')->nullable(true);
                        $table->string('estado_fornecedor_origem', 254)->nullable(true);
                        $table->double('altura', 9)->nullable(true);
                        $table->double('largura', 9)->nullable(true);
                        $table->double('peso', 8)->nullable(true);
                        $table->double('comprimento', 9)->nullable(true);
                        $table->double('custo_atual', 8)->nullable(true);
                        $table->double('icms_ultima_compra', 8)->nullable(true);
                        $table->string('data_ult_compra')->nullable(true)->nullable(true);
                        $table->double('custo_ult_pesq', 13)->nullable(true);
                        $table->double('qtd_min_compra', 9)->nullable(true);
                        $table->string('ean', 254)->nullable(true);
                        $table->string('cf', 4)->nullable(true);
                        $table->string('codigo_mens', 2)->nullable(true);
                        $table->string('tributacao_mg')->nullable(true);
                        $table->string('origem', 254)->nullable(true);
                        $table->string('ref_end', 17)->nullable(true);
                        $table->string('cod_interno_produtocad', 50)->nullable(true);
                        $table->string('codigo_externo_pesquisa', 50)->nullable(true);
                        $table->string('oid_pesquisa', 50)->nullable(true);
                        $table->double('valor_custo')->nullable(true);
                        $table->decimal("valor_subst_nf",20,4)->nullable(true);
                        $table->decimal("valor_subst_ant",15,5)->nullable(true);
                        $table->double('perc_icms_compra')->nullable(true);
                        $table->double('aliq_icms_compra')->nullable(true);
                        $table->double('icms_sem_despesas_nao_inclusas')->nullable(true);
                        //------------------------------------------------------------------
                        //API PRODUTOS: PRODUTOS
                        //------------------------------------------------------------------
                        $table->string('api_produtos_referencia',8)->nullable(true);
                        $table->string('api_produtos_modelo',254)->nullable(true);
                        $table->string('api_produtos_nome_original',254)->nullable(true);
                        $table->decimal('api_produtos_venda_minima',10,2)->nullable(true);
                        $table->text('api_produtos_descricao_amigavel')->nullable(true);
                        $table->string('api_produtos_nome_web',254)->nullable(true);
                        $table->text('ap_produtos_descricao_longa')->nullable(true);
                        $table->decimal('api_produtos_embalagem',10,2)->nullable(true);
                        $table->string('api_produtos_tags',254)->nullable(true);
                        $table->string('api_produtos_obs',254)->nullable(true);
                        $table->string('api_produtos_video',254)->nullable(true);
                        //------------------------------------------------------------------
                        $table->string('last_operation', 1)->nullable(true);
                        $table->dateTime('last_commit_time')->nullable(true);
                        $table->timestamp('created_at')->useCurrent();
                        $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
                        //unique
                        $table->unique(['codpro', 'dv', 'id_fornecedor', 'codigo_externo_pesquisa']);
                        $table->unique(['codpro', 'dv', 'id_fornecedor']);
                        $table->unique(['codpro']);
                    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('produtos');
    }
};
