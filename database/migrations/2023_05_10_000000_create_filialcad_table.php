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

            $table->string("nome", 30)->nullable(true);
            $table->string("codempresa", 2)->nullable(true);
            $table->string("filial", 2)->nullable(true);
            $table->string("cgc", 20)->nullable(true);

            $table->integer("oidempresa")->nullable(true);
            $table->integer("oid");
            //------------------------------------------------------------------
            //PLATAFORMA
            //------------------------------------------------------------------
            $table->integer('plataforma_are_venda_id')->nullable(true);
            $table->integer('plataforma_tipo_loja_id')->nullable(true);
            $table->string('plataforma_empresa', 11)->nullable(true);
            $table->string('plataforma_filial', 11)->nullable(true);
            $table->string('plataforma_nome', 30)->nullable(true);
            $table->string('plataforma_nome_amigavel', 70)->nullable(true);
            $table->string('plataforma_cgc', 30)->nullable(true);
            $table->string('plataforma_oid_empresa', 20)->nullable(true);
            $table->integer('plataforma_filial_virtual')->nullable(true);
            $table->smallInteger('plataforma_filial_ativo')->nullable(true);
            $table->integer('plataforma_dash')->nullable(true);
            $table->integer('plataforma_ponto_retirada')->nullable(true);
            $table->string('plataforma_conta_gerencial', 40)->nullable(true);
            $table->string('plataforma_cnpj_franquia', 30)->nullable(true);
            $table->integer('plataforma_filial_id')->nullable(true);
            $table->string('plataforma_transfer', 20)->nullable(true);
            $table->integer('plataforma_virtual')->nullable(true);
            $table->smallInteger('plataforma_margem')->nullable(true);
            $table->smallInteger('plataforma_operador_logistico')->nullable(true);
            $table->smallInteger('plataforma_loja_fisica')->nullable(true);
            $table->smallInteger('plataforma_retirar_loja')->nullable(true);
            $table->smallInteger('plataforma_franquia')->nullable(true);
            $table->integer('plataforma_loja_propria')->nullable(true);
            $table->integer('plataforma_prazo_entrega')->nullable(true);
            $table->integer('plataforma_prazo_maximo_retirada')->nullable(true);
            $table->text('plataforma_latitude')->nullable(true);
            $table->text('plataforma_longitude')->nullable(true);
            $table->integer('plataforma_tray')->nullable(true);
            $table->string('plataforma_cep', 9)->nullable(true);
            $table->text('plataforma_endereco')->nullable(true);
            $table->text('plataforma_bairro')->nullable(true);
            $table->text('plataforma_complemento')->nullable(true);
            $table->text('plataforma_numero')->nullable(true);
            $table->text('plataforma_cidade')->nullable(true);
            $table->string('plataforma_estado', 2)->nullable(true);
            $table->text('plataforma_contato')->nullable(true);
            $table->smallInteger('plataforma_endereco_ativo')->nullable(true);
            //------------------------------------------------------------------
            $table->string('last_operation', 1)->nullable(true);
            $table->dateTime('last_commit_time')->nullable(true);

            $table->unique(array('oid'));
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
        Schema::dropIfExists('filiais');
    }
};
