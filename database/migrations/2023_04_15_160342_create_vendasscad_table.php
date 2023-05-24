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
        Schema::create('vendasscad', function (Blueprint $table) {
            $table->id();
            $table->string("filial", 2);
            $table->string("usuven", 8);
            $table->string("receber", 1);
            $table->string("numfrete", 10)->nullable(true);
            $table->string("codtran", 3)->nullable(true);
            $table->string("situacao", 1)->nullable(true);
            $table->string("TIPO", 3)->nullable(true);

            $table->double("totven");
            $table->double("freteorc")->nullable(true);
            $table->double("taxanf")->nullable(true);
            $table->double("OUTRASDESPESASINCLUSAS")->nullable(true);
            $table->double("TOTRECANTECIPADO")->nullable(true);
            $table->double("TROCO")->nullable(true);
            $table->double("VALORDOACAO")->nullable(true);

            $table->integer("numord");
            $table->integer("localporta");
            $table->string("pedido_id", 100);
            $table->integer("numped");
            $table->integer("oiddocdeorigem");
            $table->integer("condpagposterior");
            $table->integer("nordfrete")->nullable(true);
            $table->integer("PENDENTE")->nullable(true);
            $table->integer("MANUAL")->nullable(true);
            $table->integer("RDOCDOACAO")->nullable(true);

            $table->dateTime("dtven");
            $table->dateTime("dtentr")->nullable(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            
            $table->unique(array('numord'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('vendasscad');
    }
};
