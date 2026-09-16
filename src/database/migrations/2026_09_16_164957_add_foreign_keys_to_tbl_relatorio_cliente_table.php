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
        Schema::table('tbl_relatorio_cliente', function (Blueprint $table) {
            $table->foreign(['id_relatorio_vania'], 'fk_relatorio_cliente_relatorio_vania')->references(['id_relatorio_vania'])->on('tbl_relatorio_vania')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_relatorio_cliente', function (Blueprint $table) {
            $table->dropForeign('fk_relatorio_cliente_relatorio_vania');
        });
    }
};
