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
        Schema::create('enderecos_clientes', function (Blueprint $table) {
            $table->id();
            //------------------------------------------------------------------
            //ERP
            //------------------------------------------------------------------
            $table->string('cpf_cnpj', 18);
            $table->string('logradouro', 254)->nullable(true);
            $table->string('numero', 254)->nullable(true);
            $table->string('bairro', 254)->nullable(true);
            $table->string('cidade', 254)->nullable(true);
            $table->string('cep', 8)->nullable(true);
            $table->string('uf', 2)->nullable(true);
            $table->string('complemento', 254)->nullable(true);
            $table->string('contato', 254)->nullable(true);
            
            //------------------------------------------------------------------
            //PLATAFORMA
            //------------------------------------------------------------------
            $table->string('id_endereco_mdm', 254)->nullable(true);
            $table->integer('plataforma_clientes_id')->nullable(true);
            $table->integer('plataforma_oid_cliente')->nullable(true);
            $table->integer('plataforma_oid_endereco')->nullable(true);
            $table->integer('plataforma_oid_classificacao')->nullable(true);
            $table->text('plataforma_destinatario')->nullable(true);
            $table->string('plataforma_cep', 9)->nullable(true);
            $table->text('plataforma_endereco')->nullable(true);
            $table->string('plataforma_numero', 20)->nullable(true);
            $table->text('plataforma_complemento')->nullable(true);
            $table->string('plataforma_bairro', 70)->nullable(true);
            $table->string('plataforma_cidade', 100)->nullable(true);
            $table->string('plataforma_estado', 2)->nullable(true);
            $table->string('plataforma_referencia', 100)->nullable(true);
            $table->string('plataforma_tipo', 20)->nullable(true);
            $table->integer('plataforma_principal')->nullable(true);
            $table->smallInteger('plataforma_mesmo')->nullable(true);
            $table->string('plataforma_oid_cidade', 10)->nullable(true);
            $table->string('plataforma_oid_estado', 10)->nullable(true);
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            //unique
            $table->unique(['cpf_cnpj','cep','numero']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('enderecos_clientes');
    }
};
