<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicoFuncional extends Model{
    
    protected $table = 'tbl_servico_funcionamento';
    protected $primaryKey = 'id_servico_funcionamento';
    public $timestamps = false;

    protected $fillable = [
        'id_servico_ancora',
        'icone_servico_funcionamento',
        'titulo_servico_funcionamento',
        'paragrafo_servico_funcionamento',
        'status_servico_funcionamento'
    ];

    public function ServicoFuncional(){
        return $this-> hasOne(Servico::class, 'id_servico_ancora', 'id_servico_ancora');
    }
}