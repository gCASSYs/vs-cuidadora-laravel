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
        Schema::table('users', function (Blueprint $table) {

            // Alteração da Gabriele - nível de acesso do usuário
            $table->string('nivel', 30)
                ->default('ADMINISTRADOR')
                ->after('password');

            // Alteração da Gabriele - controla se o usuário pode acessar o painel
            $table->string('status', 7)
                ->default('ATIVO')
                ->after('nivel');

            // Alteração da Gabriele - foto do usuário administrativo
            $table->string('foto', 100)
                ->nullable()
                ->after('status');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'nivel',
                'status',
                'foto',
            ]);
        });
    }
};