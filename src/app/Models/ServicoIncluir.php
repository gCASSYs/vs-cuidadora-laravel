<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicoIncluir extends Model{

    protected $table = 'tbl_servico_incluir';
    protected $primaryKey = 'id_servico_incluir';
    public $timestamps = false;

    protected $fillable = [
        'id_servico_ancora',
        'titulo_servico_incluir',
        'paragrafo1_servico_incluir',
        'paragrafo2_servico_incluir',
        'paragrafo3_servico_incluir',
        'status_servico_incluir'
    ];

    public function ServicoIncluir(){
        return $this-> hasOne(Servico::class, 'id_servico_ancora', 'id_servico_ancora');
    }
}