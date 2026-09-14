<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class SobreResumo extends Model {

    protected $table = 'tbl_sobre_resumo';
    protected $primaryKey = 'id_sobre_resumo';

    public $timestamps = false;

    protected $fillable = [
        'titulo_sobre_resumo',
        'texto_sobre_resumo',
        'status_sobre_resumo',
    ];

}