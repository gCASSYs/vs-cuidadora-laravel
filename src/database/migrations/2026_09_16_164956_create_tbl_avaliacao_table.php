<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_avaliacao', function (Blueprint $table) {
            $table->integer('id_avaliacao', true);
            $table->integer('id_cliente')->index('fk_avaliacao_info_cliente');
            $table->string('titulo_avaliacao', 35);
            $table->string('img_avaliacao', 65);
            $table->string('mensagem_avaliacao', 125);
            $table->integer('estrela_avaliacao');
            $table->string('status_avaliacao', 7)->default('0');
            $table->dateTime('data_criacao_avaliacao')->useCurrent();
            $table->dateTime('data_atualizacao_avaliacao')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_avaliacao');
    }
};
