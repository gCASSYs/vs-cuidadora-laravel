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
        Schema::create('tbl_form', function (Blueprint $table) {
            $table->integer('id_form', true);
            $table->string('nome_form', 75);
            $table->string('telefone_form', 14);
            $table->string('email_form', 70);
            $table->text('mensagem_form');
            $table->string('status_form', 15);
            $table->dateTime('data_criacao_form')->useCurrent();
            $table->dateTime('data_atualizacao_form')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_form');
    }
};
