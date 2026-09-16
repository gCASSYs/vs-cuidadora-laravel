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
        Schema::create('tbl_confirmacao_agendamento', function (Blueprint $table) {
            $table->integer('id_confirmacao_vania', true);
            $table->integer('id_agendamento_cliente')->index('fk_confirmacao_agendamento_agendamento_cliente');
            $table->string('confirmar_confirmacao_vania', 10);
            $table->dateTime('data_criacao_confirmacao_vania')->useCurrent();
            $table->dateTime('data_atualizacao_confirmacao_vania')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_confirmacao_agendamento');
    }
};
