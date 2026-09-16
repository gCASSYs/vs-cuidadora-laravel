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
        Schema::create('tbl_servico_funcionamento', function (Blueprint $table) {
            $table->integer('id_servico_funcionamento', true);
            $table->integer('id_servico_ancora')->index('fk_servico_funcionamento_servico_ancora');
            $table->string('icone_servico_funcionamento', 65);
            $table->string('titulo_servico_funcionamento', 120);
            $table->text('paragrafo_servico_funcionamento');
            $table->string('status_servico_funcionamento', 7);
            $table->dateTime('data_criacao_servico_funcionamento')->useCurrent();
            $table->dateTime('data_atualizacao_servico_funcionamento')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_servico_funcionamento');
    }
};
