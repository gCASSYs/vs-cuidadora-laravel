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
        Schema::create('tbl_servico_ancora', function (Blueprint $table) {
            $table->integer('id_servico_ancora', true);
            $table->string('titulo_servico_ancora', 35);
            $table->string('subtitulo_servico_ancora', 80)->nullable();
            $table->text('texto_servico_ancora')->nullable();
            $table->string('img_servico_ancora', 65);
            $table->dateTime('data_criacao_servico_ancora')->useCurrent();
            $table->dateTime('data_atualizacao_servico_ancora')->useCurrentOnUpdate()->useCurrent();
            $table->string('status_servico_ancora', 7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_servico_ancora');
    }
};
