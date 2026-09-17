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
        'texto_sobre',
        'img_sobre',
        'id_diferencial',
    ];

}
