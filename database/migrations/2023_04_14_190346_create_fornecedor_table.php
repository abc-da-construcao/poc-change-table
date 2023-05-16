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
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('oid')->nullable(true);
            $table->integer('rescopo')->nullable(true);
            $table->string('nome',254)->nullable(true);
            $table->string('razao_social',254)->nullable(true);
            $table->string('identificador',254)->nullable(true);
            $table->string('codigo',254)->nullable(true);
            $table->dateTime('atualizado_em')->nullable(true);
            $table->dateTime('criado_em')->nullable(true);
            $table->integer('atualizado_por')->nullable(true);
            $table->integer('criado_por')->nullable(true);
            $table->string('cid')->nullable(true);
            $table->string('observacao',254)->nullable(true);
            $table->integer('excluido')->nullable(true);
            $table->string('operation')->nullable(true);
            $table->timestamps();
            //unique
            $table->unique(['oid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('fornecedores');
    }
};
