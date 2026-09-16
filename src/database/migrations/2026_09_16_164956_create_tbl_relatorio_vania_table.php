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
        Schema::create('tbl_relatorio_vania', function (Blueprint $table) {
            $table->integer('id_relatorio_vania', true);
            $table->integer('id_cliente')->index('fk_relatorio_vania_info_cliente');
            $table->integer('id_idoso')->index('fk_relatorio_vania_info_idoso');
            $table->string('nome_relatorio_vania', 75);
            $table->text('texto_relatorio_vania');
            $table->date('data_relatorio_vania');
            $table->time('horario_relatorio_vania');
            $table->string('status_relatorio_vania', 7);
            $table->string('visu_relatorio', 12);
            $table->dateTime('data_criacao_relatorio_vania')->useCurrent();
            $table->dateTime('data_atualizacao_relatorio_vania')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_relatorio_vania');
    }
};
