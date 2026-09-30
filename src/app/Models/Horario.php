<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model{

    protected $table = 'tbl_horarios';
    protected $primaryKey = 'id_horarios';
    public $timestamps = false;

    public $fillable = [
        'telefone_horarios',        
        'formato_horarios',        
        'regiao_horarios',        
        'horario_horarios',        
        'status_horarios',             
    ];
}