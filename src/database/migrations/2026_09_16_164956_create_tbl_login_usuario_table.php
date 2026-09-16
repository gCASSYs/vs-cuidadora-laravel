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
        Schema::create('tbl_login_usuario', function (Blueprint $table) {
            $table->integer('id_login_usuario', true);
            $table->integer('id_login_vania')->index('fk_login_usuario_login_vania');
            $table->string('email_login', 70);
            $table->text('senha_login');
            $table->string('tipo_login', 10);
            $table->string('status_login', 7);
            $table->dateTime('data_criacao_login')->useCurrent();
            $table->dateTime('data_atualizacao_login')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_login_usuario');
    }
};
