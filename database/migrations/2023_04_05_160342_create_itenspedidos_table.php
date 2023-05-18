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
        Schema::create('itens_pedido', function (Blueprint $table) {
            $table->id();
            $table->string('pedido_id', 100);
            $table->integer("item")->nullable(true);
            $table->integer("numped")->nullable(true);
            $table->unique(array('item', 'pedido_id'));

            $table->string("codpro", 5)->nullable(true);
            $table->string("dv", 1)->nullable(true);
            $table->decimal("quant")->nullable(true);
            $table->string("unid", 3)->nullable(true);
            $table->decimal("preco")->nullable(true);
            $table->decimal("valdesc")->nullable(true);
            $table->decimal("quantent")->nullable(true);
            $table->dateTime("dtprevent", 2)->nullable(true);
            $table->string("filial", 2)->nullable(true);
            $table->integer("numord")->nullable(true);
            $table->decimal("valoripi")->nullable(true);
            $table->decimal("aliqipi")->nullable(true);
            $table->string("ordprod", 5)->nullable(true);
            $table->decimal("descunit")->nullable(true);
            $table->string("obs", 5)->nullable(true);
            $table->integer("numpedfil")->nullable(true);
            $table->string("situacao", 2)->nullable(true);
            $table->string("filialcli", 2)->nullable(true);
            $table->string("tipoentr", 1)->nullable(true);
            $table->string("libquant", 5)->nullable(true);
            $table->string("reserva", 1)->nullable(true);
            $table->string("numcarga", 1)->nullable(true);
            $table->decimal("perdesc")->nullable(true);
            $table->decimal("pendest")->nullable(true);
            $table->decimal("libest")->nullable(true);
            $table->decimal("novquanent")->nullable(true);
            $table->decimal("qtddisplib")->nullable(true);
            $table->decimal("precostx")->nullable(true);
            $table->string("tpa_cod", 2)->nullable(true);
            $table->decimal("faconv")->nullable(true);
            $table->decimal("preconf")->nullable(true);
            $table->decimal("precocomp")->nullable(true);
            $table->decimal("quantdisp")->nullable(true);
            $table->decimal("quantped")->nullable(true);
            $table->decimal("descrate")->nullable(true);
            $table->decimal("quantcan")->nullable(true);
            $table->decimal("pendente")->nullable(true);
            $table->integer("itemrelacionado")->nullable(true);
            $table->integer("rcarenciaparcela")->nullable(true);
            $table->integer("rdocplano")->nullable(true);
            $table->integer("rdocentrada")->nullable(true);
            $table->decimal("fator1")->nullable(true);
            $table->decimal("fator2")->nullable(true);
            $table->integer("ITEMSERVICO")->nullable(true);
            $table->string("filialretirada", 2)->nullable(true);
            $table->string("filialtransferencia", 2)->nullable(true);
            $table->decimal("faturamentodireto")->nullable(true);
            $table->decimal("mostruario")->nullable(true);
            $table->decimal("PRECOCOMIS")->nullable(true);
            $table->decimal("PLANOSEMJUROS")->nullable(true);
            $table->string("CODVEND", 5)->nullable(true);
            $table->integer("NUMPEDFILIAL")->nullable(true);
            $table->decimal("valentrada")->nullable(true);
            $table->decimal("fatoraux")->nullable(true);
            $table->decimal("sitfat")->nullable(true);
            $table->integer("numordfat")->nullable(true);
            $table->integer("numordret")->nullable(true);
            $table->integer("numordtransf")->nullable(true);
            $table->decimal("itemselecionado")->nullable(true);
            $table->string("lotenf", 20)->nullable(true);
            $table->dateTime("validadenf")->nullable(true);
            $table->decimal("FlagEmit")->nullable(true);
            $table->decimal("garantiavenda")->nullable(true);
            $table->string("CMIPI", 2)->nullable(true);
            $table->decimal("QUANTSOLICITADA")->nullable(true);
            $table->decimal("PaginaOrdemSeparacao")->nullable(true);
            $table->string("SequenciaOrdemSeparacao", 1)->nullable(true);
            $table->decimal("TemSeguro")->nullable(true);
            $table->string("entregaexped", 1)->nullable(true);
            $table->decimal("flagoferta")->nullable(true);
            $table->string("ItemFat", 5)->nullable(true);
            $table->decimal("custoreposicao")->nullable(true);
            $table->decimal("PRECOTX")->nullable(true);
            $table->decimal("PRECOUNITORIG")->nullable(true);
            $table->integer("ID_CLIENTECENTROCUSTO")->nullable(true);
            $table->decimal("PRECOCOMICMS")->nullable(true);
            $table->decimal("VALORICMS")->nullable(true);
            $table->decimal("FLAGCOMFAIXA")->nullable(true);
            $table->decimal("PERCCOM")->nullable(true);
            $table->decimal("PERCFAIXADESC")->nullable(true);
            $table->decimal("PERCFAIXADESCONTO")->nullable(true);
            $table->integer("RCADASTROFAIXADESCONTO")->nullable(true);
            $table->decimal("PrecoOferta")->nullable(true);
            $table->decimal("VALORIPITX")->nullable(true);
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
        Schema::dropIfExists('itens_pedido');
    }
};
