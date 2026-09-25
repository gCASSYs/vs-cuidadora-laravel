<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatorioVania extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABELA
    |--------------------------------------------------------------------------
    |
    | Aqui falamos pro Laravel qual tabela esse model usa.
    |
    */

    protected $table = 'tbl_relatorio_vania';

    // chave principal da tabela
    protected $primaryKey = 'id_relatorio_vania';

    /*
     * A tabela já tem os campos próprios de data,
     * então não precisamos do created_at e updated_at do Laravel.
     */
    public $timestamps = false;


    /*
    |--------------------------------------------------------------------------
    | CAMPOS QUE PODEM SER SALVOS
    |--------------------------------------------------------------------------
    |
    | Esses são os campos que vamos receber do formulário.
    |
    */

    protected $fillable = [

        // cliente e idoso ligados ao relatório
        'id_cliente',
        'id_idoso',

        // informações principais do relatório
        'nome_relatorio_vania',
        'tipo_atendimento_relatorio_vania',
        'texto_relatorio_vania',
        'data_relatorio_vania',
        'horario_relatorio_vania',
        'horario_fim_relatorio_vania',

        /*
         * Checklist de cuidados
         * ficam separados pq depois fica fácil saber oq foi feito
         */
        'medicacao_relatorio_vania',
        'alimentacao_relatorio_vania',
        'hidratacao_relatorio_vania',
        'higiene_relatorio_vania',
        'sono_relatorio_vania',
        'atividade_relatorio_vania',
        'companhia_relatorio_vania',
        'consulta_relatorio_vania',

        // condição do idoso durante o atendimento
        'humor_relatorio_vania',
        'apetite_relatorio_vania',
        'mobilidade_relatorio_vania',
        'comunicacao_relatorio_vania',
        'dor_relatorio_vania',
        'sinais_relatorio_vania',

        // informações finais
        'observacoes_relatorio_vania',
        'recomendacoes_relatorio_vania',
        'intercorrencias_relatorio_vania',

        // controle do relatório
        'status_relatorio_vania',
        'visu_relatorio',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO COM O CLIENTE
    |--------------------------------------------------------------------------
    |
    | Cada relatório pertence a um cliente responsável.
    |
    */

    public function cliente()
    {
        return $this->belongsTo(
            Cliente::class,
            'id_cliente',
            'id_cliente'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO COM O IDOSO
    |--------------------------------------------------------------------------
    |
    | Cada relatório pertence a um idoso.
    |
    | O model Idoso ainda não existe no projeto.
    | Vamos criar ele no próximo passo pq o relatório precisa dele.
    |
    */

    public function idoso()
    {
        return $this->belongsTo(
            Idoso::class,
            'id_idoso',
            'id_idoso'
        );
    }
}