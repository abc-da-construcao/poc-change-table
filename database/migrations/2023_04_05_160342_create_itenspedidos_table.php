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
            $table->double("quant")->nullable(true);
            $table->string("unid", 3)->nullable(true);
            $table->double("preco")->nullable(true);
            $table->double("valdesc")->nullable(true);
            $table->double("quantent")->nullable(true);
            $table->dateTime("dtprevent", 2)->nullable(true);
            $table->string("filial", 2)->nullable(true);
            $table->integer("numord")->nullable(true);
            $table->double("valoripi")->nullable(true);
            $table->double("aliqipi")->nullable(true);
            $table->string("ordprod", 5)->nullable(true);
            $table->double("descunit")->nullable(true);
            $table->string("obs", 5)->nullable(true);
            $table->integer("numpedfil")->nullable(true);
            $table->string("situacao", 2)->nullable(true);
            $table->string("filialcli", 2)->nullable(true);
            $table->string("tipoentr", 1)->nullable(true);
            $table->string("libquant", 5)->nullable(true);
            $table->string("reserva", 1)->nullable(true);
            $table->string("numcarga", 1)->nullable(true);
            $table->double("perdesc")->nullable(true);
            $table->double("pendest")->nullable(true);
            $table->double("libest")->nullable(true);
            $table->double("novquanent")->nullable(true);
            $table->double("qtddisplib")->nullable(true);
            $table->double("precostx")->nullable(true);
            $table->string("tpa_cod", 2)->nullable(true);
            $table->double("faconv")->nullable(true);
            $table->double("preconf")->nullable(true);
            $table->double("precocomp")->nullable(true);
            $table->double("quantdisp")->nullable(true);
            $table->double("quantped")->nullable(true);
            $table->double("descrate")->nullable(true);
            $table->double("quantcan")->nullable(true);
            $table->double("pendente")->nullable(true);
            $table->integer("itemrelacionado")->nullable(true);
            $table->integer("rcarenciaparcela")->nullable(true);
            $table->integer("rdocplano")->nullable(true);
            $table->integer("rdocentrada")->nullable(true);
            $table->double("fator1")->nullable(true);
            $table->double("fator2")->nullable(true);
            $table->integer("ITEMSERVICO")->nullable(true);
            $table->string("filialretirada", 2)->nullable(true);
            $table->string("filialtransferencia", 2)->nullable(true);
            $table->double("faturamentodireto")->nullable(true);
            $table->double("mostruario")->nullable(true);
            $table->double("PRECOCOMIS")->nullable(true);
            $table->double("PLANOSEMJUROS")->nullable(true);
            $table->string("CODVEND", 5)->nullable(true);
            $table->integer("NUMPEDFILIAL")->nullable(true);
            $table->double("valentrada")->nullable(true);
            $table->double("fatoraux")->nullable(true);
            $table->double("sitfat")->nullable(true);
            $table->integer("numordfat")->nullable(true);
            $table->integer("numordret")->nullable(true);
            $table->integer("numordtransf")->nullable(true);
            $table->double("itemselecionado")->nullable(true);
            $table->string("lotenf", 20)->nullable(true);
            $table->dateTime("validadenf")->nullable(true);
            $table->double("FlagEmit")->nullable(true);
            $table->double("garantiavenda")->nullable(true);
            $table->string("CMIPI", 2)->nullable(true);
            $table->double("QUANTSOLICITADA")->nullable(true);
            $table->double("PaginaOrdemSeparacao")->nullable(true);
            $table->string("SequenciaOrdemSeparacao", 1)->nullable(true);
            $table->double("TemSeguro")->nullable(true);
            $table->string("entregaexped", 1)->nullable(true);
            $table->double("flagoferta")->nullable(true);
            $table->string("ItemFat", 5)->nullable(true);
            $table->double("custoreposicao")->nullable(true);
            $table->double("PRECOTX")->nullable(true);
            $table->double("PRECOUNITORIG")->nullable(true);
            $table->integer("ID_CLIENTECENTROCUSTO")->nullable(true);
            $table->double("PRECOCOMICMS")->nullable(true);
            $table->double("VALORICMS")->nullable(true);
            $table->double("FLAGCOMFAIXA")->nullable(true);
            $table->double("PERCCOM")->nullable(true);
            $table->double("PERCFAIXADESC")->nullable(true);
            $table->double("PERCFAIXADESCONTO")->nullable(true);
            $table->integer("RCADASTROFAIXADESCONTO")->nullable(true);
            $table->double("PrecoOferta")->nullable(true);
            $table->double("VALORIPITX")->nullable(true);
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
