<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idoso extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABELA
    |--------------------------------------------------------------------------
    |
    | Aqui falamos qual tabela esse model representa.
    |
    */

    protected $table = 'tbl_info_idoso';

    // chave principal da tabela
    protected $primaryKey = 'id_idoso';

    /*
     * A tabela já tem os próprios campos de data,
     * então não usamos created_at e updated_at.
     */
    public $timestamps = false;


    /*
    |--------------------------------------------------------------------------
    | CAMPOS DA TABELA
    |--------------------------------------------------------------------------
    |
    | Esses campos já existem no banco.
    | Não estamos criando nada novo aqui.
    |
    */

    protected $fillable = [
        'id_cliente',
        'id_login_vania',
        'nome_idoso',
        'sexo_idoso',
        'telefone_idoso',
        'cpf_idoso',
        'endereco_idoso',
        'idade_idoso',
        'situacao_idoso',
        'ponto_principal_idoso',
        'status_idoso',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO COM O CLIENTE
    |--------------------------------------------------------------------------
    |
    | Cada idoso fica ligado a um cliente responsável.
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
}