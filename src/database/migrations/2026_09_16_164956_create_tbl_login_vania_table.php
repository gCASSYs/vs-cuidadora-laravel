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
        Schema::create('tbl_login_vania', function (Blueprint $table) {
            $table->integer('id_login_vania', true);
            $table->string('email_login_vania', 70);
            $table->text('senha_login_vania');
            $table->string('tipo_login_vania', 10);
            $table->string('status_login_vania', 7);
            $table->dateTime('data_criacao_login_vania')->useCurrent();
            $table->dateTime('data_atualizacao_login_vania')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_login_vania');
    }
};
