<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class FAQ extends Model {

    protected $table = 'tbl_faq';
    protected $primaryKey = 'id_faq';
    public $timestamps = false;

    protected $fillable = [
        'fundo_faq',
        'titulo_faq',
        'titulo_duvida',
        'resposta_duvida',
        'status_faq',
    ];

}
