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
        Schema::create('atributos_produtos', function (Blueprint $table) {
            $table->id();
            //------------------------------------------------------------------
            //API PRODUTOS
            //------------------------------------------------------------------
            $table->integer('id_atributos')->nullable(true);
            $table->string('referencia',8)->nullable(true);
            $table->string('nome',32)->nullable(true);
            $table->text('valor')->nullable(true);
            $table->integer('filtravel')->nullable(true);
            $table->integer('removido')->nullable(true);
            $table->string('slug_nome',32)->nullable(true);
            $table->text('slug_valor')->nullable(true);
            //------------------------------------------------------------------
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            //unique
            $table->unique(['id_atributos','referencia']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('atributos_produtos');
    }
};
