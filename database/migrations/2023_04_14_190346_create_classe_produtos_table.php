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
        Schema::create('classes', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('clasprod',14)->nullable(true);
            $table->string('descr',25)->nullable(true);
            $table->decimal('anal',5)->nullable(true);
            $table->decimal('sainalista',5)->nullable(true);
            $table->decimal('participacfem',5)->nullable(true);
            $table->decimal('percentualcfem',5, 2)->nullable(true);
            $table->integer('ativa')->nullable(true);
            $table->decimal('pagacomissaoindoferta',5)->nullable(true);
            $table->decimal('perccomissao',5, 2)->nullable(true);
            $table->decimal('percdescmaximogerente',5, 2)->nullable(true);
            $table->decimal('percdescmaximovendedor',5, 2)->nullable(true);
            $table->integer('similaridade')->nullable(true);
            $table->string('descrdetalhada',60)->nullable(true);
            $table->decimal('prioridadeentrega',5)->nullable(true);
            $table->integer('id_erp')->nullable(true);
            $table->dateTime('atualizadoem')->nullable(true);
            $table->integer('codigo_gnre')->nullable(true);
            $table->string('operation')->nullable(true);
            $table->timestamps();
            //unique
            $table->unique(['clasprod']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('classes');
    }
};
