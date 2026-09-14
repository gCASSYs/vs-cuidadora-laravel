<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Cliente extends Model{
    protected $table = 'tbl_info_cliente';
    protected $primaryKey = 'id_info_cliente';
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'id_login',
        'id_login_vania',
        'nome_cliente',
        'telefone_cliente',
        'cpf_cliente',
        'endereco_cliente',
        'idade_cliente',
        'status_cliente',    
    ];

    public function ClienteAvalicao(){
        return $this-> belongsTo(Avaliacao::class, 'id_cliente', 'id_cliente');
    }

}