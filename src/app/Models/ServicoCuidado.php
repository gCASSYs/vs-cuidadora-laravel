<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicoCuidado extends Model{

    protected $table = 'tbl_servico_cuidado';
    protected $primaryKey = 'id_servico_cuidado';
    public $timestamps = false;

    protected $fillable = [
        'id_servico_ancora',
        'titulo_servico_cuidado',
        'paragrafo1_servico_cuidado',
        'paragrafo2_servico_cuidado',
        'paragrafo3_servico_cuidado',
        'status_servico_cuidado'      
    ];

    public function ServicoCuidado(){
        return $this-> hasOne(Servico::class, 'id_servico_ancora', 'id_servico_ancora');
    }
}