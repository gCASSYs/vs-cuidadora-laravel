<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class FAQ extends Model {

    protected $table = 'tbl_faq';
    protected $primaryKey = 'id_faq';

    protected $fillable = [
        'titulo_faq',
        'pergunta_faq',
        'resposta_faq',
        'status_faq',
    ];

}