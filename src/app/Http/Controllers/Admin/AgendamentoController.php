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

    public function status(int $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->status_agendamento_cliente =
            $agendamento->status_agendamento_cliente === 'ATIVO' ? 'INATIVO' : 'ATIVO';
        $agendamento->save();

        return redirect()
            ->route('admin.agendamento.index')
            ->with('sucesso', 'Status do agendamento atualizado com sucesso!');
    }
}
