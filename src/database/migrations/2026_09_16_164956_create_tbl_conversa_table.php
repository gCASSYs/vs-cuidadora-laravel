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
        Schema::create('tbl_conversa', function (Blueprint $table) {
            $table->integer('id_conversa', true);
            $table->integer('id_cliente')->index('fk_conversa_info_cliente');
            $table->integer('id_login_vania')->index('fk_conversa_login_vania');
            $table->string('status_conversa', 10)->default('0');
            $table->dateTime('data_criacao_conversa')->useCurrent();
            $table->dateTime('data_atualizacao_conversa')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_conversa');
    }
};
