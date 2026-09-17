<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicoTopico extends Model{

    protected $table  = 'tbl_servico';
    protected $primaryKey = 'id_servico';
    public $timestamps = false;

    protected $fillable = [
        'id_servico_ancora',
        'fundo_servico',
        'icone_servico',
        'titulo_servico',
        'texto_servico',
        'botao_servico',
        'status_servico'
    ];

    public function ServicoTopico(){
        return $this->belongsTo(Servico::class, 'id_servico_ancora', 'id_servico_ancora');
    }

}
