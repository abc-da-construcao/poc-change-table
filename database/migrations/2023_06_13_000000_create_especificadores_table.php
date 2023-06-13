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
        Schema::create('especificadores', function (Blueprint $table) {
            $table->id();
            $table->string('idEspecificadorMdm', 18);
            $table->integer('idEspecificadorPlataforma')->nullable(true);
            $table->string('nomeEspecificador', 200)->nullable(true);
            $table->integer('maxIdClienteEspecificadorPlataforma')->nullable(true);
            $table->timestamp('plataforma_updated_at')->nullable(true);
            $table->string('inscEstadualEspecificador', 100)->nullable(true);
            $table->text('observacao')->nullable(true);
            $table->string('instagram', 60)->nullable(true);
            $table->string('titular', 1)->nullable(true);
            $table->string('nome_titular', 200)->nullable(true);
            $table->string('documento_titular', 20)->nullable(true);
            $table->string('conta_banco', 60)->nullable(true);
            $table->string('conta_agencia', 10)->nullable(true);
            $table->string('conta_tipo', 1)->nullable(true);
            $table->string('conta_numero', 20)->nullable(true);
            $table->string('nome', 150)->nullable(true);
            $table->string('portalUser', 150)->nullable(true);
            $table->string('aliassf', 150)->nullable(true);
            $table->integer('user_id')->nullable(true);
            $table->integer('filialReferencia')->nullable(true);
            $table->string('NomeUserPv', 50)->nullable(true);
            $table->string('NomeOrigUserPv', 100)->nullable(true);
            $table->integer('filial_id_user_cad')->nullable(true);
            $table->string('filial_user_cad', 30)->nullable(true);
            $table->string('idFilialMU', 11)->nullable(true);
            $table->integer('idUserPv')->nullable(true);
            $table->string('idUserMu', 30)->nullable(true);
 

            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            
            //unique
            $table->unique(['idEspecificadorMdm']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especificadores');
    }
};
