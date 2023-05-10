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
            $table->string('cpf_cnpj', 18);
            $table->string('logradouro', 254)->nullable(true);
            $table->string('numero', 254)->nullable(true);
            $table->string('bairro', 254)->nullable(true);
            $table->string('cidade', 254)->nullable(true);
            $table->string('cep', 8)->nullable(true);
            $table->string('uf', 2)->nullable(true);
            $table->string('complemento', 254)->nullable(true);
            $table->string('contato', 254)->nullable(true);
            $table->timestamps();
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
