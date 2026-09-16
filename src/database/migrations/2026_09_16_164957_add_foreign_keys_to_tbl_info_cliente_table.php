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
        Schema::table('tbl_info_cliente', function (Blueprint $table) {
            $table->foreign(['id_login'], 'fk_info_cliente_login_usuario')->references(['id_login_usuario'])->on('tbl_login_usuario')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_login_vania'], 'fk_info_cliente_login_vania')->references(['id_login_vania'])->on('tbl_login_vania')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_info_cliente', function (Blueprint $table) {
            $table->dropForeign('fk_info_cliente_login_usuario');
            $table->dropForeign('fk_info_cliente_login_vania');
        });
    }
};
