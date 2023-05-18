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
            $table->string('cpf_cnpj', 18);
            $table->string('nome', 254);
            $table->string('razao_social', 254)->nullable(true);
            $table->string('inscricao_estadual', 17)->nullable(true);
            $table->string('email', 254)->nullable(true);
            $table->string('celular', 50)->nullable(true);
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
