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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('numped')->nullable(true);
            $table->string('filial', 2)->nullable(true);
            $table->string('referencia', 100)->nullable(true);
            $table->integer('codclie')->nullable(true);
            $table->string('numorc', 5)->nullable(true);
            $table->string('codvend', 5)->nullable(true);
            $table->decimal('valped')->nullable(true);
            $table->decimal('valentrad')->nullable(true);
            $table->decimal('desconto')->nullable(true);
            $table->dateTime('dtprevent')->nullable(true);
            $table->integer('condpag')->nullable(true);
            $table->datetime('dtpripag')->nullable(true);
            $table->dateTime('dtpedido')->nullable(true);
            $table->string('obs', 30)->nullable(true);
            $table->integer('numord')->nullable(true);
            $table->char('tpo', 30)->nullable(true);
            $table->string('pedido_id', 100);
            $table->integer('moedcor')->nullable(true);
            $table->dateTime('dataatu')->nullable(true);
            $table->string('ordprod', 5)->nullable(true);
            $table->decimal('perfrete')->nullable(true);
            $table->decimal('valfrete')->nullable(true);
            $table->decimal('perseguro')->nullable(true);
            $table->decimal('valseguro')->nullable(true);
            $table->string('razaocli', 254)->nullable(true);
            $table->string('endercli', 254)->nullable(true);
            $table->string('bairrcli', 254)->nullable(true);
            $table->string('cidadcli', 254)->nullable(true);
            $table->string('cepcli', 8)->nullable(true);
            $table->string('cpf_cnpj', 18)->nullable(true);
            $table->string('inscli', 17)->nullable(true);
            $table->string('estcli', 2)->nullable(true);
            $table->string('tipnota', 1)->nullable(true);
            $table->string('codtran', 3)->nullable(true);
            $table->string('codtran2', 3)->nullable(true);
            $table->integer('codendent')->nullable(true);
            $table->integer('codendcob')->nullable(true);
            $table->string('observ', 254)->nullable(true);
            $table->string('filialcli', 2)->nullable(true);
            $table->string('respcli', 20)->nullable(true);
            $table->string('respfor', 20)->nullable(true);
            $table->string('tpoent', 30)->nullable(true);
            $table->string('situacao', 1)->nullable(true);
            $table->string('numpedfil', 5)->nullable(true);
            $table->decimal('atuarec')->nullable(true);
            $table->string('numrom', 6)->nullable(true);
            $table->string('pendente', 3)->nullable(true);
            $table->string('libdesc', 5)->nullable(true);
            $table->string('libcred', 5)->nullable(true);
            $table->string('liblimi', 5)->nullable(true);
            $table->string('libbloq', 5)->nullable(true);
            $table->string('libatra', 5)->nullable(true);
            $table->string('sitven', 1)->nullable(true);
            $table->string('naoaprov', 1)->nullable(true);
            $table->string('telecli', 50)->nullable(true);
            $table->string('horaped', 4)->nullable(true);
            $table->decimal('freteorc')->nullable(true);
            $table->string('numfrete', 10)->nullable(true);
            $table->string('usucred', 8)->nullable(true);
            $table->decimal('credito')->nullable(true);
            $table->string('libform', 5)->nullable(true);
            $table->integer('rformadepagar')->nullable(true);
            $table->string('codlis', 2)->nullable(true);
            $table->string('tipofrete', 1)->nullable(true);
            $table->string('codrote', 2)->nullable(true);
            $table->integer('SitConf')->nullable(true);
            $table->string('NumClie', 254)->nullable(true);
            $table->string('ContribClie', 1)->nullable(true);
            $table->string('FilialVend', 2)->nullable(true);
            $table->string('destino', 2)->nullable(true);
            $table->string('CodMens', 2)->nullable(true);
            $table->decimal('Tributado')->nullable(true);
            $table->string('inscsufracli', 20)->nullable(true);
            $table->string('COMPLCLI', 254)->nullable(true);
            $table->string('sitmanut', 1)->nullable(true);
            $table->integer('codforout')->nullable(true);
            $table->string('deporigem', 2)->nullable(true);
            $table->integer('tpooutraent')->nullable(true);
            $table->decimal('Cqualidade')->nullable(true);
            $table->string('Refqualidade', 10)->nullable(true);
            $table->integer('condpagposterior')->nullable(true);
            $table->decimal('Etapa')->nullable(true);
            $table->decimal('valorfat')->nullable(true);
            $table->decimal('valorrec')->nullable(true);
            $table->decimal('taxanf')->nullable(true);
            $table->string('receber', 1)->nullable(true);
            $table->string('tipovenda', 1)->nullable(true);
            $table->integer('oidrevenda')->nullable(true);
            $table->string('sitmon', 1)->nullable(true);
            $table->decimal('temconjunto')->nullable(true);
            $table->decimal('txrevenda')->nullable(true);
            $table->string('SitCred', 3)->nullable(true);
            $table->string('FlagEmit', 1)->nullable(true);
            $table->string('sitsaga', 1)->nullable(true);
            $table->dateTime('dtvalidade')->nullable(true);
            $table->integer('oidcontato')->nullable(true);
            $table->string('LIBTPDOC', 5)->nullable(true);
            $table->string('Apelido', 254)->nullable(true);
            $table->string('contato', 254)->nullable(true);
            $table->decimal('PerDescto')->nullable(true);
            $table->string('reservaconjunto', 1)->nullable(true);
            $table->decimal('viamont')->nullable(true);
            $table->decimal('TemSeguro')->nullable(true);
            $table->decimal('PLANOSEMJUROS')->nullable(true);
            $table->integer('rcarenciaparcela')->nullable(true);
            $table->integer('rdocplano')->nullable(true);
            $table->integer('rdocentrada')->nullable(true);
            $table->string('ARQUIVOCDL', 254)->nullable(true);
            $table->decimal('FatorEmpresa')->nullable(true);
            $table->integer('Urgente')->nullable(true);
            $table->decimal('PERCIPISEGURO')->nullable(true);
            $table->decimal('OUTRASDESPESASINCLUSAS')->nullable(true);
            $table->string('libmarkmin', 3)->nullable(true);
            $table->decimal('VIAORCAMENTO')->nullable(true);
            $table->decimal('ViaOrdemSeparacao')->nullable(true);
            $table->string('LIBPRAZOMEDIO', 3)->nullable(true);
            $table->string('LIBFRETE', 3)->nullable(true);
            $table->decimal('prazomedio')->nullable(true);
            $table->decimal('desmembrado')->nullable(true);
            $table->decimal('VALPEDTX')->nullable(true);
            $table->string('ORGAOPUBCLIE', 1)->nullable(true);
            $table->string('ENDERECOFATURA', 1)->nullable(true);
            $table->decimal('CONTRATO')->nullable(true);
            $table->decimal('EMPENHO')->nullable(true);
            $table->timestamps();

            $table->unique(array('pedido_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pedidos');
    }
};
