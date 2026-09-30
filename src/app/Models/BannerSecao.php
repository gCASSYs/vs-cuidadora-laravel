<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSecao extends Model{
    protected  $table = 'tbl_banner_secao';
    protected $primaryKey = 'id_banner_secao';
    public  $timestamps = false;

    protected $fillable = [
        'titulo_banner_secao',
        'subtitulo_banner_secao',
        'img_banner_secao',
        'status_banner_secao',

    ];
}
