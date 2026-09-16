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
        Schema::table('tbl_servico', function (Blueprint $table) {
            $table->foreign(['id_servico_ancora'], 'fk_servico_servico_ancora')->references(['id_servico_ancora'])->on('tbl_servico_ancora')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_servico', function (Blueprint $table) {
            $table->dropForeign('fk_servico_servico_ancora');
        });
    }
};
