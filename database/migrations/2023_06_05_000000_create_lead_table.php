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
        Schema::create('lead', function (Blueprint $table) {
            $table->id();
            $table->string('idLeadMdm', 150)->nullable(true);
            $table->integer('oid')->nullable(true);
            $table->string('nome', 150)->nullable(true);
            $table->date('nasc')->nullable(true);
            $table->string('pessoa', 1)->nullable(true);
            $table->string('email', 100)->nullable(true);
            $table->string('telefone', 20)->nullable(true);
            $table->string('celular', 20)->nullable(true);
            $table->string('inscricao', 20)->nullable(true);
            $table->smallInteger('contribuinte_icms')->nullable(true);
            $table->string('contato', 100)->nullable(true);
            $table->integer('etapa')->nullable(true);
            $table->integer('user_id')->nullable(true);
            $table->integer('origem_id')->nullable(true);
            $table->string('possui_especificador', 1)->nullable(true);
            $table->string('especificador_nome', 150)->nullable(true);
            $table->string('especificador_telefone', 20)->nullable(true);
            $table->integer('tipo_obra')->nullable(true);

            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            
            //unique
            $table->unique(['idLeadMdm']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead');
    }
};
