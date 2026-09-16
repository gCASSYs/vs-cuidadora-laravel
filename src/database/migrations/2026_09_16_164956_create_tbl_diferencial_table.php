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
        Schema::create('tbl_diferencial', function (Blueprint $table) {
            $table->integer('id_diferencial', true);
            $table->string('titulo_diferencial', 35);
            $table->text('texto_diferencial');
            $table->string('icone_diferencial', 65);
            $table->string('status_diferencial', 7);
            $table->dateTime('data_criacao_diferencial')->useCurrent();
            $table->dateTime('data_atualizacao_diferencial')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_diferencial');
    }
};
