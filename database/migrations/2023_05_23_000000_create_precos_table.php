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
        Schema::create('precos', function (Blueprint $table) {
            $table->id();
            $table->string("referencia", 254)->nullable(true);
            $table->integer("rpromocao")->nullable(true);
            $table->decimal("oferta")->nullable(true);
            $table->integer("oid_produto_promocao")->nullable(true);
            $table->decimal("qtde_ofertada")->nullable(true);
            $table->decimal("qtde_reservada")->nullable(true);
            $table->integer("area_venda")->nullable(true);
            $table->timestamp('inicio')->nullable(true);
            $table->timestamp('termino')->nullable();
            $table->integer("rpessoa")->nullable(true);
            $table->string("filial", 2)->nullable(true);
            $table->string("filial_nome", 30)->nullable(true);
            $table->decimal("de")->nullable(true);
            $table->decimal("por")->nullable(true);
            $table->string("desc_area_venda", 40)->nullable(true);
                    
            
            $table->unique(array('referencia','filial'));

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('precos');
    }
};