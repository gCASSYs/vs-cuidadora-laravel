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
        Schema::table('tbl_chat', function (Blueprint $table) {
            $table->foreign(['id_conversa'], 'fk_chat_conversa')->references(['id_conversa'])->on('tbl_conversa')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_chat', function (Blueprint $table) {
            $table->dropForeign('fk_chat_conversa');
        });
    }
};
