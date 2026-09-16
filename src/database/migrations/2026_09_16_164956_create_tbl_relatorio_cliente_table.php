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
        Schema::create('tbl_relatorio_cliente', function (Blueprint $table) {
            $table->integer('id_relatorio_cliente', true);
            $table->integer('id_relatorio_vania')->index('fk_relatorio_cliente_relatorio_vania');
            $table->text('responder_relatorio_cliente')->nullable();
            $table->string('confirmar_relatorio_cliente', 10);
            $table->string('status_relatorio_cliente', 7);
            $table->dateTime('data_criacao_relatorio_cliente')->useCurrent();
            $table->dateTime('data_atualizacao_relatorio_cliente')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_relatorio_cliente');
    }
};
