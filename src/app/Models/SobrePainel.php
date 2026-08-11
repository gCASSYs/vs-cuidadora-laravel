<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class SobrePainel extends Model {

    protected $table = 'tbl_sobre_painel';
    protected $primaryKey = 'id_sobre_painel';

    public $timestamps = false;

    protected $fillable = [
        'titulo_sobre_painel',
        'subtitulo_sobre_painel',
        'primeiro_ponto_sobre_painel',
        'segundo_ponto_sobre_painel',
        'terceiro_ponto_sobre_painel',
        'status_sobre_painel',
    ];

}