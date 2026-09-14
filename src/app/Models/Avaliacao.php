<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model{

    protected $table ='tbl_avaliacao';
    protected $primaryKey ='id_avaliacao';
    public $timestamps = false;
    protected $fillable = [
        'id_cliente',
        'titulo_avalicao',
        'img_avalicao',
        'mensagem_avalicao',
        'estrela_avalicao',
        'status_avalicao',
    ];
      
    public function AvaliacaoCliente(){
        return $this->hasMany(Cliente::class, 'id_cliente', 'id_cliente');
    }
}