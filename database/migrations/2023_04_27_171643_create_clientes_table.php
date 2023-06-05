<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            //------------------------------------------------------------------
            //ERP
            //------------------------------------------------------------------
            $table->string('cpf_cnpj', 18);
            $table->string('nome', 254)->nullable(true);
            $table->string('razao_social', 254)->nullable(true);
            $table->string('inscricao_estadual', 17)->nullable(true);
            $table->string('email', 254)->nullable(true);
            $table->string('celular', 50)->nullable(true);
            //------------------------------------------------------------------
            //PLATAFORMA
            //------------------------------------------------------------------
            $table->string('idClienteMDM', 18)->nullable(true);
            $table->string('idLeadMdm', 254)->nullable(true);
            $table->string('tipoRegistro', 7)->nullable(true);
            $table->integer('plataforma_oid')->nullable(true);
            $table->string('plataforma_documento', 20)->nullable(true);
            $table->string('plataforma_nome', 150)->nullable(true);
            $table->date('plataforma_nasc')->nullable(true);
            $table->string('plataforma_pessoa', 1)->nullable(true);
            $table->string('plataforma_email', 100)->nullable(true);
            $table->string('plataforma_telefone', 20)->nullable(true);
            $table->string('plataforma_celular', 20)->nullable(true);
            $table->string('plataforma_inscricao', 20)->nullable(true);
            $table->smallInteger('plataforma_contribuinte_icms')->nullable(true);
            $table->string('plataforma_contato', 100)->nullable(true);
            $table->integer('plataforma_etapa')->nullable(true);
            $table->integer('plataforma_user_id')->nullable(true);
            $table->integer('plataforma_origem_id')->nullable(true);
            $table->string('plataforma_possui_especificador', 1)->nullable(true);
            $table->string('plataforma_especificador_nome', 150)->nullable(true);
            $table->string('plataforma_especificador_telefone', 20)->nullable(true);
            $table->integer('plataforma_tipo_obra')->nullable(true);
            $table->string('NomeUserPv', 50)->nullable(true);
            $table->string('NomeOrigUserPv', 100)->nullable(true);
            $table->integer('filial_id_user_cad')->nullable(true);
            $table->string('filial_user_cad', 30)->nullable(true);
            $table->integer('idUserPv')->nullable(true);
            $table->string('idUserMu', 30)->nullable(true);
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            //unique
            $table->unique(['cpf_cnpj']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
