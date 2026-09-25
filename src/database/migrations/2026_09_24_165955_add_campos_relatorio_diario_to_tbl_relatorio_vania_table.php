<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona os campos que faltam pro relatório diário.
     */
    public function up(): void
    {
        Schema::table('tbl_relatorio_vania', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | DADOS DO ATENDIMENTO
            |--------------------------------------------------------------------------
            |
            | A data e o horário de início já existem na tabela,
            | então aqui só colocamos o que ainda estava faltando.
            |
            */

            // tipo do atendimento feito pela Vânia
            $table->string('tipo_atendimento_relatorio_vania', 75)
                ->nullable()
                ->after('id_idoso');

            // horário que o atendimento terminou
            $table->time('horario_fim_relatorio_vania')
                ->nullable()
                ->after('horario_relatorio_vania');


            /*
            |--------------------------------------------------------------------------
            | CHECKLIST DE CUIDADOS
            |--------------------------------------------------------------------------
            |
            | São boolean pq aqui só precisamos saber se o cuidado
            | foi realizado ou não.
            |
            */

            // medicação administrada
            $table->boolean('medicacao_relatorio_vania')
                ->default(false);

            // alimentação realizada
            $table->boolean('alimentacao_relatorio_vania')
                ->default(false);

            // hidratação adequada
            $table->boolean('hidratacao_relatorio_vania')
                ->default(false);

            // higiene realizada
            $table->boolean('higiene_relatorio_vania')
                ->default(false);

            // sono ou descanso
            $table->boolean('sono_relatorio_vania')
                ->default(false);

            // caminhada ou alguma atividade
            $table->boolean('atividade_relatorio_vania')
                ->default(false);

            // companhia ou conversa
            $table->boolean('companhia_relatorio_vania')
                ->default(false);

            // acompanhamento em consulta
            $table->boolean('consulta_relatorio_vania')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | CONDIÇÃO DO IDOSO
            |--------------------------------------------------------------------------
            |
            | Esses campos vão virar selects simples no formulário,
            | pra Vânia não precisar ficar digitando tudo.
            |
            */

            // como estava o humor do idoso
            $table->string('humor_relatorio_vania', 30)
                ->nullable();

            // como estava o apetite
            $table->string('apetite_relatorio_vania', 30)
                ->nullable();

            // como estava a mobilidade
            $table->string('mobilidade_relatorio_vania', 30)
                ->nullable();

            // como estava a comunicação
            $table->string('comunicacao_relatorio_vania', 30)
                ->nullable();

            // registra se teve dor ou desconforto
            $table->string('dor_relatorio_vania', 30)
                ->nullable();

            // campo livre caso a Vânia perceba algum sinal diferente
            $table->text('sinais_relatorio_vania')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | INFORMAÇÕES FINAIS
            |--------------------------------------------------------------------------
            */

            // observações extras do atendimento
            $table->text('observacoes_relatorio_vania')
                ->nullable();

            // alguma recomendação que a família precisa saber
            $table->text('recomendacoes_relatorio_vania')
                ->nullable();

            // queda, mal-estar, recusa de alimentação e outros problemas
            $table->text('intercorrencias_relatorio_vania')
                ->nullable();

            /*
             * O status tinha espaço pra só 7 caracteres.
             * Aumentamos pq "RASCUNHO" tem 8.
             */
            $table->string('status_relatorio_vania', 15)
                ->change();
        });
    }


    /**
     * Desfaz somente o que adicionamos aqui.
     */
    public function down(): void
    {
        Schema::table('tbl_relatorio_vania', function (Blueprint $table) {

            // remove os campos adicionados por essa migration
            $table->dropColumn([
                'tipo_atendimento_relatorio_vania',
                'horario_fim_relatorio_vania',

                'medicacao_relatorio_vania',
                'alimentacao_relatorio_vania',
                'hidratacao_relatorio_vania',
                'higiene_relatorio_vania',
                'sono_relatorio_vania',
                'atividade_relatorio_vania',
                'companhia_relatorio_vania',
                'consulta_relatorio_vania',

                'humor_relatorio_vania',
                'apetite_relatorio_vania',
                'mobilidade_relatorio_vania',
                'comunicacao_relatorio_vania',
                'dor_relatorio_vania',
                'sinais_relatorio_vania',

                'observacoes_relatorio_vania',
                'recomendacoes_relatorio_vania',
                'intercorrencias_relatorio_vania',
            ]);

            // volta o tamanho original do status
            $table->string('status_relatorio_vania', 7)
                ->change();
        });
    }
};