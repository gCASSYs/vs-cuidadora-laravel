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
        Schema::table('tbl_relatorio_vania', function (Blueprint $table) {
            $table->foreign(['id_cliente'], 'fk_relatorio_vania_info_cliente')->references(['id_cliente'])->on('tbl_info_cliente')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_idoso'], 'fk_relatorio_vania_info_idoso')->references(['id_idoso'])->on('tbl_info_idoso')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_relatorio_vania', function (Blueprint $table) {
            $table->dropForeign('fk_relatorio_vania_info_cliente');
            $table->dropForeign('fk_relatorio_vania_info_idoso');
        });
    }
};
