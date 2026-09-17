<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'tbl_banner';
    protected $primaryKey = 'id_banner';
    public $timestamps = false;

    protected $fillable = [
        'titulo_banner',
        'img_banner',
        'status_banner',
    ];
}
