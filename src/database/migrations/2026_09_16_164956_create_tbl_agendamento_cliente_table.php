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
        Schema::create('tbl_agendamento_cliente', function (Blueprint $table) {
            $table->integer('id_agendamento_cliente', true);
            $table->integer('id_cliente')->index('fk_agendamento_cliente_info_cliente');
            $table->integer('id_idoso')->index('fk_agendamento_cliente_info_idoso');
            $table->integer('id_servico_login')->index('fk_agendamento_cliente_servico_login');
            $table->date('dia_agendamento_cliente');
            $table->time('horario_agendamento_cliente');
            $table->string('status_agendamento_cliente', 10);
            $table->dateTime('data_criacao_agendamento_cliente')->useCurrent();
            $table->dateTime('data_atualizacao_agendamento_cliente')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_agendamento_cliente');
    }
};
