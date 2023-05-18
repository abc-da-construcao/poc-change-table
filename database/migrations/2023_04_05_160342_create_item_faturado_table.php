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
        Schema::create('itens_faturado', function (Blueprint $table) {
            $table->id('indice');
            $table->string("Usuario", 254)->nullable(true);
            $table->string("Estacao", 254)->nullable(true);
            $table->string("Filial", 2)->nullable(true);
            $table->string("Codpro", 5)->nullable(true);
            $table->string("SITMANUT", 1)->nullable(true);
            $table->string("DestinoRoteirizador", 254)->nullable(true);
            $table->string("USUARIOALTEROUSITMANUT", 100)->nullable(true);
            $table->string("ESTACAOALTEROUSITMANUT", 100)->nullable(true);
            $table->string("PROGRAMAALTEROUSITMANUT", 100)->nullable(true);

            $table->integer("Item");
            $table->integer("ID");
            $table->string('pedido_id', 100);
            $table->integer("Pedido")->nullable(true);
            $table->integer("NUMEROLISTA")->nullable(true);
            $table->integer("ORDEMENTREGA")->nullable(true);
            $table->integer("NUMORD")->nullable(true);
            $table->integer("NUMPEDTRANSFERENCIA")->nullable(true);
            $table->integer("NUMORDTRANSF")->nullable(true);
            $table->integer("ORDEMCARGA")->nullable(true);
            $table->integer("CARGAROTEIRIZADOR")->nullable(true);

            $table->decimal("ROTEIRIZADOR");
            $table->decimal("Quant")->nullable(true);
            $table->decimal("VIAORDEMSEPARACAO")->nullable(true);

            $table->dateTime("Reservado");
            $table->dateTime("Faturado")->nullable(true);
            $table->dateTime("Cancelado")->nullable(true);
            $table->dateTime("DataOrdemSeparacao")->nullable(true);
            $table->dateTime("DATAMONTAGEM")->nullable(true);
            $table->dateTime("DTINICIOSEPARACAO")->nullable(true);
            $table->dateTime("DTFIMSEPARACAO")->nullable(true);
            $table->dateTime("DATAALTEROUSITMANUT")->nullable(true);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->unique(array('Reservado','Item'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('itens_faturado');
    }
};
