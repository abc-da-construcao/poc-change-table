<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->string('orcamento_id', 100);
            $table->string('idOrcamentoMdm', 100)->nullable(true);
            $table->string('idClienteMdm', 20)->nullable(true);
            $table->string('idLeadMdm', 150)->nullable(true);
            $table->integer('IdClientePlataforma')->nullable(true);
            $table->string('CLIENTE', 150)->nullable(true);
            $table->string('Documento', 20)->nullable(true);
            $table->string('email', 100)->nullable(true);
            $table->string('telefone', 20)->nullable(true);
            $table->string('celular', 20)->nullable(true);
            $table->string('inscricao', 20)->nullable(true);
            $table->tinyInteger('contribuinte_icms')->nullable(true);
            $table->string('tipoPedido', 20)->nullable(true);
            $table->integer('IdUserCadPedidoPlataforma')->nullable(true);
            $table->integer('idfilialCatPedido')->nullable(true);
            $table->string('nomeFilialPedido', 30)->nullable(true);
            $table->string('idFilialPedidoMU', 11)->nullable(true);
            $table->string('NomeUserFilialPedido', 50)->nullable(true);
            $table->string('NomeOrigUserFilialPedido', 100)->nullable(true);
            $table->integer('idPlataformaUserFilialPedido')->nullable(true);
            $table->string('idMuUserFilialPedido', 30)->nullable(true);
            $table->integer('idCatFilialOrigem')->nullable(true);
            $table->string('nomeFilialOrigemPedido', 30)->nullable(true);
            $table->string('idFilialOrigemMU', 11)->nullable(true);
            $table->string('nomeAv', 70)->nullable(true);
            $table->integer('canal_venda_id')->nullable(true);
            $table->text('descAv')->nullable(true);
            $table->string('codigoAv', 5)->nullable(true);
            $table->integer('cupom_id')->nullable(true);
            $table->integer('tipo_cupom_id')->nullable(true);
            $table->string('nomeCupom', 100)->nullable(true);
            $table->integer('qtdCupom')->nullable(true);
            $table->integer('cupomFreteGratis')->nullable(true);
            $table->float('valorDescontoCupom', 10,2)->nullable(true);
            $table->string('tipoCupom', 70)->nullable(true);
            $table->string('tipoValidacaoCupom', 80)->nullable(true);
            $table->integer('clientes_id')->nullable(true);
            $table->integer('oid_cliente')->nullable(true);
            $table->integer('oid_endereco')->nullable(true);
            $table->integer('oid_classificacao')->nullable(true);
            $table->string('destinatario', 255)->nullable(true);
            $table->string('cep', 9)->nullable(true);
            $table->text('endereco')->nullable(true);
            $table->string('numero', 20)->nullable(true);
            $table->string('complemento', 255)->nullable(true);
            $table->string('bairro', 70)->nullable(true);
            $table->string('cidade', 100)->nullable(true);
            $table->string('estado', 2)->nullable(true);
            $table->string('referencia', 100)->nullable(true);
            $table->string('tipo', 20)->nullable(true);
            $table->integer('principal')->nullable(true);
            $table->tinyInteger('mesmo')->nullable(true);
            $table->string('oid_cidade', 10)->nullable(true);
            $table->string('oid_estado', 10)->nullable(true);
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            
            //unique
            $table->unique(['orcamento_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orcamentos');
    }
};
