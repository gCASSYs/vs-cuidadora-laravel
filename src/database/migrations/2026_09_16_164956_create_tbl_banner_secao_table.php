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
        Schema::create('tbl_banner_secao', function (Blueprint $table) {
            $table->integer('id_banner_secao', true);
            $table->string('titulo_banner_secao', 35);
            $table->string('subtitulo_banner_secao', 25);
            $table->string('img_banner_secao', 65);
            $table->string('status_banner_secao', 7)->default('0');
            $table->dateTime('data_criacao_banner_secao')->useCurrent();
            $table->dateTime('data_atualizacao_banner_secao')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_banner_secao');
    }
};
