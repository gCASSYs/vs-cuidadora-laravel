<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'tbl_agendamento_cliente';
    protected $primaryKey = 'id_agendamento_cliente';
    public $timestamps = false;
    protected $fillable = [
        'id_cliente',
        'id_idoso',
        'id_servico_login',
        'dia_agendamento_cliente',
        'horario_agendamento_cliente',
        'status_agendamento_cliente',
    ];

    public function AgendamentoCliente()
    {
        return $this->BelongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function idoso()
    {
        return $this->belongsTo(Idoso::class, 'id_idoso', 'id_idoso');
    }

    public function servicoAgendamento()
    {
        return $this->belongsTo(ServicoLogin::class, 'id_servico_login', 'id_servico_login');
    }
}
