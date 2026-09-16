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
        Schema::create('tbl_sobre_resumo', function (Blueprint $table) {
            $table->integer('id_sobre_resumo', true);
            $table->string('titulo_sobre_resumo', 35);
            $table->text('texto_sobre_resumo');
            $table->string('status_sobre_resumo', 7);
            $table->dateTime('data_criacao_sobre_resumo')->useCurrent();
            $table->dateTime('data_atualizacao_sobre_resumo')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sobre_resumo');
    }
};
