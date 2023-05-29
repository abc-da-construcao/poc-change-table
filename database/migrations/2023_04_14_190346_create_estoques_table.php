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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->integer('codpro');
            $table->string('dv');
            $table->smallInteger('filial');
            $table->string('referencia');
            $table->double('estoque_atual', 8, 3)->nullable(true);
            $table->double('estoque_futuro', 8, 3)->nullable(true);
            $table->smallInteger('compras_1')->nullable(true)->comment('compra 15 dias')->default(0);
            $table->smallInteger('compras_2')->nullable(true)->comment('compra 45 dias')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            //unique
            $table->unique(['codpro', 'dv', 'filial']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('estoques');
    }
};
