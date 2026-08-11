<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class Sobre extends Model {

    protected $table = 'tbl_sobre_principal';
    protected $primaryKey = 'id_sobre';

    public $timestamps = false;

    protected $fillable = [
        'titulo_sobre',
        'subtitulo_sobre',
        'paragrafo1_sobre',
        'paragrafo2_sobre',
        'paragrafo3_sobre',
        'img1_sobre',
        'titulo_secundario_sobre',
        'paragrafo1_secundario_sobre',
        'paragrafo2_secundario_sobre',
        'paragrafo3_secundario_sobre',
        'img2_sobre',
        'status_sobre',
    ];

}