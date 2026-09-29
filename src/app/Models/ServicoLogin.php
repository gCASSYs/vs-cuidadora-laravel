<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicoLogin extends Model
{
    protected $table = 'tbl_servico_login';
    protected $primaryKey = 'id_servico_login';
    public $timestamps = false;

    protected $fillable = [
        'servico_servico_login',
        'filtro_servico_login',
        'observacao_servico_login',
        'status_servico_login',
    ];

    public function AgendamentoServico()
    {
        return $this->hasMany(Agendamento::class, 'id_servico_login', 'id_servico_login');
    }
}
