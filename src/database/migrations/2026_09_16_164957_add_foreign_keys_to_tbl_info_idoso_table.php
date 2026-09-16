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
        Schema::table('tbl_info_idoso', function (Blueprint $table) {
            $table->foreign(['id_cliente'], 'fk_info_idoso_info_cliente')->references(['id_cliente'])->on('tbl_info_cliente')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_login_vania'], 'fk_info_idoso_login_vania')->references(['id_login_vania'])->on('tbl_login_vania')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_info_idoso', function (Blueprint $table) {
            $table->dropForeign('fk_info_idoso_info_cliente');
            $table->dropForeign('fk_info_idoso_login_vania');
        });
    }
};
