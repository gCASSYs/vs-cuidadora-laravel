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
        Schema::create('tbl_servico', function (Blueprint $table) {
            $table->integer('id_servico', true);
            $table->integer('id_servico_ancora')->index('fk_servico_servico_ancora');
            $table->string('fundo_servico', 65);
            $table->string('icone_servico', 65);
            $table->string('titulo_servico', 35);
            $table->text('texto_servico');
            $table->string('botao_servico', 50);
            $table->string('status_servico', 7)->default('0');
            $table->dateTime('data_criacao_servico')->useCurrent();
            $table->dateTime('data_atualizacao_servico')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_servico');
    }
};
