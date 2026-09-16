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
        Schema::create('tbl_servico_incluir', function (Blueprint $table) {
            $table->integer('id_servico_incluir', true);
            $table->integer('id_servico_ancora')->index('fk_servico_incluir_servico_ancora');
            $table->string('titulo_servico_incluir', 120);
            $table->string('paragrafo1_servico_incluir', 100);
            $table->string('paragrafo2_servico_incluir', 100);
            $table->string('paragrafo3_servico_incluir', 100);
            $table->string('status_servico_incluir', 7);
            $table->dateTime('data_criacao_servico_incluir')->useCurrent();
            $table->dateTime('data_atualizacao_servico_incluir')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_servico_incluir');
    }
};
