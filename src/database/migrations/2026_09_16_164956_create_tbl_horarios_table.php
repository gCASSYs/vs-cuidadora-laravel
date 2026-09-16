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
        Schema::create('tbl_horarios', function (Blueprint $table) {
            $table->integer('id_horarios', true);
            $table->string('telefone_horarios', 14);
            $table->string('formato_horarios', 150);
            $table->string('regiao_horarios', 150);
            $table->string('horario_horarios', 150);
            $table->string('status_horarios', 7);
            $table->dateTime('data_criacao_horarios')->useCurrent();
            $table->dateTime('data_atualizacao_horarios')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_horarios');
    }
};
