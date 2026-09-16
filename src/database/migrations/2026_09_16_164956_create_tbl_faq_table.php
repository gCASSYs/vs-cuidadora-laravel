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
        Schema::create('tbl_faq', function (Blueprint $table) {
            $table->integer('id_faq', true);
            $table->string('fundo_faq', 65);
            $table->string('titulo_faq', 35);
            $table->string('titulo_duvida', 35);
            $table->string('resposta_duvida', 60);
            $table->string('status_faq', 7)->default('0');
            $table->dateTime('data_criacao_faq')->useCurrent();
            $table->dateTime('data_atualizacao_faq')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_faq');
    }
};
