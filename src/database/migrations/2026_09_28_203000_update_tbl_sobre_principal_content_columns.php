<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_sobre_principal', function (Blueprint $table) {
            // Derruba a index de id_diferencial antes de derrubar a coluna em si
            $table->dropIndex('fk_sobre_principal_diferencial');
            $table->dropColumn('id_diferencial');

            $table->renameColumn('img_sobre', 'img1_sobre');
        });

        Schema::table('tbl_sobre_principal', function (Blueprint $table) {
            $table->text('paragrafo1_sobre')->nullable();
            $table->text('paragrafo2_sobre')->nullable();
            $table->text('paragrafo3_sobre')->nullable();
            $table->string('titulo_secundario_sobre', 65)->nullable();
            $table->text('paragrafo1_secundario_sobre')->nullable();
            $table->text('paragrafo2_secundario_sobre')->nullable();
            $table->text('paragrafo3_secundario_sobre')->nullable();
            $table->string('img2_sobre', 65)->nullable();
        });

        //Adiciona valores válidos as colunas antes de definir como NOT NULL pra não quebrar
        DB::table('tbl_sobre_principal')->whereNull('paragrafo1_sobre')->update(['paragrafo1_sobre' => '']);
        DB::table('tbl_sobre_principal')->whereNull('titulo_secundario_sobre')->update(['titulo_secundario_sobre' => '']);
        DB::table('tbl_sobre_principal')->whereNull('paragrafo1_secundario_sobre')->update(['paragrafo1_secundario_sobre' => '']);
        DB::table('tbl_sobre_principal')->whereNull('img2_sobre')->update(['img2_sobre' => '']);

        Schema::table('tbl_sobre_principal', function (Blueprint $table) {
            $table->text('paragrafo1_sobre')->nullable(false)->change();
            $table->string('titulo_secundario_sobre', 65)->nullable(false)->change();
            $table->text('paragrafo1_secundario_sobre')->nullable(false)->change();
            $table->string('img2_sobre', 65)->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('tbl_sobre_principal', function (Blueprint $table) {
            $table->dropColumn([
                'paragrafo1_sobre',
                'paragrafo2_sobre',
                'paragrafo3_sobre',
                'titulo_secundario_sobre',
                'paragrafo1_secundario_sobre',
                'paragrafo2_secundario_sobre',
                'paragrafo3_secundario_sobre',
                'img2_sobre',
            ]);

            $table->renameColumn('img1_sobre', 'img_sobre');
            $table->integer('id_diferencial')->nullable()->index('fk_sobre_principal_diferencial');
        });
    }
};
