<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Diferencial extends Model{

    protected $table = 'tbl_diferencial';
    protected $primaryKey = 'id_diferencial';
    public $timestamps = false;
    protected $fillable = [
        'titulo_diferencial',          
        'texto_diferencial',
        'icone_diferencial',
        'status_diferencial',
    ];
  
}