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
            $table->integer("numped");
            $table->integer("item");
            $table->unique(array('item', 'numped'));
            
            $table->string("codpro", 5);
            $table->string("dv", 1);
            $table->decimal("quant");
            $table->string("unid", 3);
            $table->decimal("preco")->nullable(true);
            $table->decimal("valdesc");
            $table->decimal("quantent");
            $table->dateTime("dtprevent", 2)->nullable(true);
            $table->string("filial", 2);
            $table->integer("numord");
            $table->decimal("valoripi");
            $table->decimal("aliqipi");
            $table->string("ordprod", 5)->nullable(true);
            $table->decimal("descunit");
            $table->string("obs", 5)->nullable(true);
            $table->integer("numpedfil")->nullable(true);
            $table->string("situacao", 2)->nullable(true);
            $table->string("filialcli", 2)->nullable(true);
            $table->string("tipoentr", 1);
            $table->string("libquant", 5)->nullable(true);
            $table->string("reserva", 1);
            $table->string("numcarga", 1);
            $table->decimal("perdesc");
            $table->decimal("pendest")->nullable(true);
            $table->decimal("libest");
            $table->decimal("novquanent");
            $table->decimal("qtddisplib");
            $table->decimal("precostx")->nullable(true);
            $table->string("tpa_cod", 2)->nullable(true);
            $table->decimal("faconv");
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
            $table->decimal("fator1");
            $table->decimal("fator2");
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
            $table->decimal("TemSeguro");
            $table->string("entregaexped", 1)->nullable(true);
            $table->decimal("flagoferta")->nullable(true);
            $table->string("ItemFat", 5);
            $table->decimal("custoreposicao")->nullable(true);
            $table->decimal("PRECOTX")->nullable(true);
            $table->decimal("PRECOUNITORIG")->nullable(true);
            $table->integer("ID_CLIENTECENTROCUSTO");
            $table->decimal("PRECOCOMICMS")->nullable(true);
            $table->decimal("VALORICMS")->nullable(true);
            $table->decimal("FLAGCOMFAIXA");
            $table->decimal("PERCCOM");
            $table->decimal("PERCFAIXADESC");
            $table->decimal("PERCFAIXADESCONTO");
            $table->integer("RCADASTROFAIXADESCONTO");
            $table->decimal("PrecoOferta");
            $table->decimal("VALORIPITX")->nullable(true);
            $table->timestamps();
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
