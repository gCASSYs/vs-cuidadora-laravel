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
        Schema::create('tbl_info_idoso', function (Blueprint $table) {
            $table->integer('id_idoso', true);
            $table->integer('id_cliente')->index('fk_info_idoso_info_cliente');
            $table->integer('id_login_vania')->index('fk_info_idoso_login_vania');
            $table->string('nome_idoso', 75);
            $table->string('sexo_idoso', 15);
            $table->string('telefone_idoso', 14);
            $table->string('cpf_idoso', 15);
            $table->text('endereco_idoso');
            $table->integer('idade_idoso');
            $table->text('situacao_idoso');
            $table->text('ponto_principal_idoso');
            $table->string('status_idoso', 7)->default('0');
            $table->dateTime('data_criacao_idoso')->useCurrent();
            $table->dateTime('data_atualizacao_idoso')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_info_idoso');
    }
};
