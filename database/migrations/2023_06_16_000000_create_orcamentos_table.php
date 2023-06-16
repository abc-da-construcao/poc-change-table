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
            $table->string('codigoAv', 18)->nullable(true);
            $table->string('cupom_id', 18)->nullable(true);
            $table->string('tipo_cupom_id', 18)->nullable(true);
            $table->string('nomeCupom', 18)->nullable(true);
            $table->string('qtdCupom', 18)->nullable(true);
            $table->string('cupomFreteGratis', 18)->nullable(true);
            $table->string('valorDescontoCupom', 18)->nullable(true);
            $table->string('tipoCupom', 18)->nullable(true);
            $table->string('tipoValidacaoCupom', 18)->nullable(true);
            $table->string('clientes_id', 18)->nullable(true);
            $table->string('oid_cliente', 18)->nullable(true);
            $table->string('oid_endereco', 18)->nullable(true);
            $table->string('oid_classificacao', 18)->nullable(true);
            $table->string('destinatario', 18)->nullable(true);
            $table->string('cep', 18)->nullable(true);
            $table->string('endereco', 18)->nullable(true);
            $table->string('numero', 18)->nullable(true);
            $table->string('complemento', 18)->nullable(true);
            $table->string('bairro', 18)->nullable(true);
            $table->string('cidade', 18)->nullable(true);
            $table->string('estado', 18)->nullable(true);
            $table->string('referencia', 18)->nullable(true);
            $table->string('tipo', 18)->nullable(true);
            $table->string('principal', 18)->nullable(true);
            $table->string('mesmo', 18)->nullable(true);
            $table->string('oid_cidade', 18)->nullable(true);
            $table->string('oid_estado', 18)->nullable(true);
            
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
