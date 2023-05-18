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
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();

            $table->string("nome", 30);
            $table->string("codempresa", 2)->nullable(true);
            $table->string("filial", 2)->nullable(true);
            $table->string("cgc", 20)->nullable(true);

            $table->integer("oidempresa");
            $table->integer("oid");

            $table->unique(array('oid'));
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
        Schema::dropIfExists('filiais');
    }
};
