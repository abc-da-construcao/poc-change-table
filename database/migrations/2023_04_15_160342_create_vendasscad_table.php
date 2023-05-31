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
            $table->string("filial", 2)->nullable(true);
            $table->string("usuven", 8)->nullable(true);
            $table->string("receber", 1)->nullable(true);
            $table->string("numfrete", 10)->nullable(true);
            $table->string("codtran", 3)->nullable(true);
            $table->string("situacao", 1)->nullable(true);
            $table->string("TIPO", 3)->nullable(true);

            $table->decimal("totven",15,2)->nullable(true);
            $table->decimal("freteorc",15,2)->nullable(true);
            $table->decimal("taxanf",15,2)->nullable(true);
            $table->decimal("OUTRASDESPESASINCLUSAS",15,2)->nullable(true);
            $table->double("TOTRECANTECIPADO")->nullable(true);
            $table->double("TROCO")->nullable(true);
            $table->double("VALORDOACAO")->nullable(true);

            $table->integer("numord");
            $table->integer("localporta")->nullable(true);
            $table->string("pedido_id", 100)->nullable(true);
            $table->integer("numped")->nullable(true);
            $table->integer("oiddocdeorigem")->nullable(true);
            $table->integer("condpagposterior")->nullable(true);
            $table->integer("nordfrete")->nullable(true);
            $table->integer("PENDENTE")->nullable(true);
            $table->integer("MANUAL")->nullable(true);
            $table->integer("RDOCDOACAO")->nullable(true);

            $table->dateTime("dtven")->nullable(true);
            $table->dateTime("dtentr")->nullable(true);
            $table->string('last_operation', 1);
            $table->dateTime('last_commit_time');
            
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
