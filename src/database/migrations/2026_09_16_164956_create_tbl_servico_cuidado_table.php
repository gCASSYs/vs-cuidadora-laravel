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
        Schema::create('tbl_servico_cuidado', function (Blueprint $table) {
            $table->integer('id_servico_cuidado', true);
            $table->integer('id_servico_ancora')->index('fk_servico_cuidado_servico_ancora');
            $table->string('titulo_servico_cuidado', 120);
            $table->string('paragrafo1_servico_cuidado', 100);
            $table->string('paragrafo2_servico_cuidado', 100);
            $table->string('paragrafo3_servico_cuidado', 100);
            $table->string('status_servico_cuidado', 7);
            $table->dateTime('data_criacao_servico_cuidado')->useCurrent();
            $table->dateTime('data_atualizacao_servico_cuidado')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_servico_cuidado');
    }
};
