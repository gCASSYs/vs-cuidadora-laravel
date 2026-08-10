<?php

namespace App\Models;

use Illuminate\database\Eloquent\Model;

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
        return $this-> belongsTo(ServicoFuncional::class, 'id_servico_ancora', 'id_servico_ancora');
    }

    public function IncluirServico(){
        return $this->belongsTo(ServicoIncluir::class, 'id_servico_ancora', 'id_servico_ancora');
    }

    public function CuidadoServico(){
        return $this->belongsTo(ServicoCuidado::class, 'id_servico_ancora', 'id_servico_ancora');
    }
}
