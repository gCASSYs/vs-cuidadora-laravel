<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;

class AgendamentoController extends Controller
{
    public function agendamento()
    {
        $listaAgendamento = Agendamento::orderByDesc('id_agendamento_cliente')
            ->get();
        return view('admin.agendamento.index', compact('listaAgendamento'));
    }
}
