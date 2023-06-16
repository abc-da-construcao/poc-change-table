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
        Schema::create('estoque_industrias', function (Blueprint $table) {
                        $table->id()->unique();
                        //------------------------------------------------------------------
                        //API PRODUTOS: ESTOQUE INDUSTRIA
                        //------------------------------------------------------------------
                        $table->string('apiProd_referencia',8)->nullable(true);
                        $table->string('apiProd_disponibilidade',16)->nullable(true);
                        $table->decimal('apiProd_estoque_industria_plan',10,3)->nullable(true);
                        $table->integer('apiProd_lead_time_plan')->nullable(true);
                        $table->string('apiProd_fornecedor',32)->nullable(true);
                        $table->string('apiProd_codpro_fab',35)->nullable(true);
                        $table->timestamp('apiProd_updated_at')->nullable(true);
                        //------------------------------------------------------------------
                        $table->timestamp('created_at')->useCurrent();
                        $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
                        //unique
                        $table->unique(['apiProd_referencia', 'apiProd_codpro_fab']);
                    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('estoque_industrias');
    }
};
