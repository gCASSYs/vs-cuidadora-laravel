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
        Schema::create('tbl_sobre_principal', function (Blueprint $table) {
            $table->integer('id_sobre', true);
            $table->string('titulo_sobre', 35);
            $table->string('subtitulo_sobre', 25);
            $table->text('texto_sobre');
            $table->string('img_sobre', 65);
            $table->integer('id_diferencial')->index('fk_sobre_principal_diferencial');
            $table->dateTime('data_criacao_sobre')->useCurrent();
            $table->dateTime('data_atualizacao_sobre')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sobre_principal');
    }
};
