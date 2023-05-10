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
            $table->bigInteger('numped');
            $table->string('filial', 2);
            $table->string('cpf_cnpj', 18);
            $table->string('logradouro', 150);
            $table->string('numero', 50);
            $table->string('bairro', 50);
            $table->string('cidade', 150);
            $table->string('cep', 8);
            $table->string('uf', 2);
            $table->string('complemento', 150);
            $table->string('contato', 150)->nullable(true);
            $table->timestamps();
            //unique
            $table->unique(['numped', 'filial', 'cpf_cnpj']);
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
