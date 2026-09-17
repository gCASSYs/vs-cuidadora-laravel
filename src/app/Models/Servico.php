<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model{
    protected $table = 'tbl_servico_ancora';
    protected $primaryKey = 'id_servico_ancora';
    public $timestamps = false;

    protected $fillable = [
        'titulo_servico_ancora',
        'subtitulo_servico_ancora',
        'texto_servico_ancora',
        'img_servico_ancora',
        'status_servico_ancora'
    ];

    public function FuncionalServico(){
        return $this->hasOne(ServicoFuncional::class, 'id_servico_ancora', 'id_servico_ancora');
    }

    public function IncluirServico(){
        return $this->hasOne(ServicoIncluir::class, 'id_servico_ancora', 'id_servico_ancora');
    }

    public function CuidadoServico(){
        return $this->hasOne(ServicoCuidado::class, 'id_servico_ancora', 'id_servico_ancora');
    }

    public function TopicoServico(){
        return $this->hasMany(ServicoTopico::class, 'id_servico_ancora', 'id_servico_ancora');
    }

 
}
