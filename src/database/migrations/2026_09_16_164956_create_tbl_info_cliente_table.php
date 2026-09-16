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
        Schema::create('tbl_info_cliente', function (Blueprint $table) {
            $table->integer('id_cliente', true);
            $table->integer('id_login')->index('fk_info_cliente_login_usuario');
            $table->integer('id_login_vania')->index('fk_info_cliente_login_vania');
            $table->string('nome_cliente', 75);
            $table->string('telefone_cliente', 14);
            $table->string('cpf_cliente', 15);
            $table->text('endereco_cliente');
            $table->integer('idade_cliente');
            $table->string('status_cliente', 7)->default('0');
            $table->dateTime('data_criacao_cliente')->useCurrent();
            $table->dateTime('data_atualizacao_cliente')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_info_cliente');
    }
};
