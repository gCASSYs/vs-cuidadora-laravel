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
        Schema::create('tbl_contato', function (Blueprint $table) {
            $table->integer('id_contato', true);
            $table->text('redes_sociais_contato');
            $table->string('icones_redes_sociais_contato', 65);
            $table->text('endereco_contato');
            $table->integer('id_horarios')->index('fk_contato_horarios');
            $table->string('status_contato', 7);
            $table->dateTime('data_criacao_contato')->useCurrent();
            $table->dateTime('data_atualizacao_contato')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contato');
    }
};
