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
        Schema::table('tbl_confirmacao_agendamento', function (Blueprint $table) {
            $table->foreign(['id_agendamento_cliente'], 'fk_confirmacao_agendamento_agendamento_cliente')->references(['id_agendamento_cliente'])->on('tbl_agendamento_cliente')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_confirmacao_agendamento', function (Blueprint $table) {
            $table->dropForeign('fk_confirmacao_agendamento_agendamento_cliente');
        });
    }
};
