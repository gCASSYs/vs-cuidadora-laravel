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
        Schema::create('tbl_servico_login', function (Blueprint $table) {
            $table->integer('id_servico_login', true);
            $table->text('servico_servico_login');
            $table->string('filtro_servico_login', 30);
            $table->text('observacao_servico_login');
            $table->string('status_servico_login', 7);
            $table->dateTime('data_criacao_servico_login')->useCurrent();
            $table->dateTime('data_atualizacao_servico_login')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_servico_login');
    }
};
