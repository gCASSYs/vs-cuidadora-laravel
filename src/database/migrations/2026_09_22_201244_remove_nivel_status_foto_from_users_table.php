<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Alteração da Gabriele - remove os campos que não serão mais usados
            $table->dropColumn([
                'nivel',
                'status',
                'foto',
            ]);

        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('nivel', 30)
                ->default('ADMINISTRADOR')
                ->after('password');

            $table->string('status', 7)
                ->default('ATIVO')
                ->after('nivel');

            $table->string('foto', 100)
                ->nullable()
                ->after('status');

        });
    }
};