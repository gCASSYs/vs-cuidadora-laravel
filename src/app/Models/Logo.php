<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $table = 'tbl_logo';
    protected $primaryKey = 'id_logo';
    public $timestamps = false;

    protected $fillable = [
        'img_logo',
        'status_logo',
    ];
}
