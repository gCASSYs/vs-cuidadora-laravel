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
        Schema::create('tbl_chat', function (Blueprint $table) {
            $table->integer('id_mensagem', true);
            $table->integer('id_conversa')->index('fk_chat_conversa');
            $table->text('mensagem_chat');
            $table->string('remetente_chat', 10);
            $table->string('visu_chat', 12);
            $table->dateTime('data_envio_chat');
            $table->dateTime('data_criacao_chat_vania')->useCurrent();
            $table->dateTime('data_atualizacao_chat_vania')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chat');
    }
};
