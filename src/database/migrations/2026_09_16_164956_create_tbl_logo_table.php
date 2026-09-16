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
        Schema::create('tbl_logo', function (Blueprint $table) {
            $table->integer('id_logo', true);
            $table->string('img_logo', 65);
            $table->string('status_logo', 7)->default('0');
            $table->dateTime('data_criacao_logo')->useCurrent();
            $table->dateTime('data_atualizacao_logo')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_logo');
    }
};
